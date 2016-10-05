<?php
namespace NS\NsProtectSite\Controller;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * SettingsController
 */
class SettingsController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * settingsRepository
     *
     * @var \NS\NsProtectSite\Domain\Repository\SettingsRepository
     * @inject
     */
    protected $settingsRepository = NULL;
    
    /**
     * action list
     *
     * @param NS\NsProtectSite\Domain\Model\Settings
     * @return void
     */
    public function listAction()
    {
        $settings = $this->settingsRepository->findAll()->toArray();
        $this->view->assign('settings', $settings[0]);
        if (count($settings) > 0) {
            if ($settings[0]->getPassword() != '') {
                $this->view->assign('isRequired', 0);
            } else {
                $this->view->assign('isRequired', 1);
            }
        } else {
            $this->view->assign('isRequired', 1);
        }
    }
    
    /**
     * action save
     *
     * @param \NS\NsProtectSite\Domain\Model\Settings $settings
     * @return void
     */
    public function saveAction(\NS\NsProtectSite\Domain\Model\Settings $settings)
    {
        $unsaltedPassword = $settings->getPassword();
        $settings->setPassword(md5($unsaltedPassword));
        if ($this->settingsRepository->findAll()->count() > 0) {
            $this->settingsRepository->update($settings);
        } else {
            $this->settingsRepository->add($settings);
        }
        if ($settings->getStatus() == 1) {
            $file = fopen(PATH_site . 'robots.txt', 'w');
            $content = "User-agent: * \n";
            $content .= 'Disallow: /';
            fwrite($file, $content);
            fclose($file);
        } else {
            unlink(PATH_site . 'robots.txt');
        }
        $this->addFlashMessage('Settings were updated', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->view->assign('settings', $settings);
        $this->redirect('list');
    }
    
    /**
     * action login
     *
     * @param NS\NsProtectSite\Domain\Model\Settings
     * @return void
     */
    public function loginAction()
    {
        
    }
    
    /**
     * action attempt
     *
     * @param NS\NsProtectSite\Domain\Model\Settings
     * @return void
     */
    public function attemptAction(\NS\NsProtectSite\Domain\Model\Settings $settings)
    {
        $unhashPassword = $settings->getPassword();
        $sql = 'select * from tx_nsprotectsite_domain_model_settings where hidden!=1 and deleted!=1';
        $res = $GLOBALS['TYPO3_DB']->sql_query($sql);
        $dbSettings = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
        if ($dbSettings != NULL) {
            if (md5($unhashPassword) == $dbSettings['password']) {
                @session_start();
                $_SESSION['isProtectedUserLoggedIn'] = 1;
                $this->redirectToUri($this->request->getBaseUri());
            }
        }
        $this->addFlashMessage('Entered password is incorrect, please contact your website administrator.', 'Error', \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR);
        $this->redirect('login');
    }

}
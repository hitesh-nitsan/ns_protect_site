<?php
namespace NS\NsProtectSite\TypoScript;
/**
 * IsProtectedCondition condition
 */
class IsProtectedCondition extends \TYPO3\CMS\Core\Configuration\TypoScript\ConditionMatching\AbstractCondition {

    /**
     * Evaluate condition
     *
     * @param array $conditionParameters
     * @return bool
     */
    public function matchCondition(array $conditionParameters) {
        if ($GLOBALS['TSFE']->beUserLogin === TRUE) {
          return FALSE;
        }
        $sql = "select * from tx_nsprotectsite_domain_model_settings where hidden!=1 and deleted!=1";
        $res = $GLOBALS['TYPO3_DB']->sql_query($sql);
        $settings = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
        if($settings!=NULL){
          if($settings['status'] == 0){
            return FALSE;
          }elseif($settings['status'] == 1){
            @session_start();
            if($_SESSION['isProtectedUserLoggedIn'] === 1){
              return FALSE;
            }
            return TRUE;
          }
        }
        return FALSE;
    }
}

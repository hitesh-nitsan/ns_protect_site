<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'NS.' . $_EXTKEY,
	'Login',
	'Login'
);

if (TYPO3_MODE === 'BE') {

	/**
	 * Registers a Backend Module
	 */
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
		'NS.' . $_EXTKEY,
		'tools',	 // Make module a submodule of 'tools'
		'protector',	// Submodule key
		'',						// Position
		array(
			'Settings' => 'list, save, login, attempt',
		),
		array(
			'access' => 'user,group',
			'icon'   => 'EXT:' . $_EXTKEY . '/ext_icon.gif',
			'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_protector.xlf',
		)
	);

}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Nitsan Site Protector');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_nsprotectsite_domain_model_settings', 'EXT:ns_protect_site/Resources/Private/Language/locallang_csh_tx_nsprotectsite_domain_model_settings.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_nsprotectsite_domain_model_settings');

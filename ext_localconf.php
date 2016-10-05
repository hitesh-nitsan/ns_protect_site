<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'NS.' . $_EXTKEY,
	'Login',
	array(
		'Settings' => 'list, login, attempt',
		
	),
	// non-cacheable actions
	array(
		'Settings' => 'login',
		
	)
);

/** @var \TYPO3\CMS\Extbase\SignalSlot\Dispatcher $signalSlotDispatcher */
$signalSlotDispatcher = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\SignalSlot\Dispatcher::class);
$signalSlotDispatcher->connect(
  \TYPO3\CMS\Extensionmanager\Utility\InstallUtility::class,  // Signal class name
  'afterExtensionUninstall',                                  // Signal name
  \NS\NsProtectSite\SignalSlot\InstallUtility::class,        // Slot class name
  'afterExtensionUninstall'                               // Slot name
);

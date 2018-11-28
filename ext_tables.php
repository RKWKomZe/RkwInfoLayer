<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}



// Add page TSConfig
$pageTsConfig = \TYPO3\CMS\Core\Utility\GeneralUtility::getUrl(
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY)
	. 'Configuration/TSconfig/pageTSconfig.t3s'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig($pageTsConfig);


\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'RKW.' . $_EXTKEY,
	'Infolayer',
	'RKW Info Layer'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'RKW Info Layer');


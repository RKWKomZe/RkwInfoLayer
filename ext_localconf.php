<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'RKW.' . $_EXTKEY,
	'Infolayer',
	array(
		'Infolayer' => 'show, content, cookie, dismiss',
		
	),
	// non-cacheable actions
	array(
		'Infolayer' => 'content, cookie, dismiss',
		
	)
);

//=================================================================
// Add tables
//=================================================================
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_rkwinfolayer_domain_model_infolayer', 'EXT:rkw_info_layer/Resources/Private/Language/locallang_csh_tx_rkwinfolayer_domain_model_infolayer.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_rkwinfolayer_domain_model_infolayer');
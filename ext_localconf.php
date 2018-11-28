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

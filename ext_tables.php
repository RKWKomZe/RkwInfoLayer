<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function($extKey)
    {

        //=================================================================
        // Register Plugin
        //=================================================================
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'RKW.' . $extKey,
            'Infolayer',
            'RKW Info Layer'
        );

        //=================================================================
        // Add TsConfig
        //=================================================================
        $pageTsConfig = \TYPO3\CMS\Core\Utility\GeneralUtility::getUrl(
            \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($extKey) . 'Configuration/TSconfig/pageTSconfig.t3s'
        );
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig($pageTsConfig);


        //=================================================================
        // Add TypoScript
        //=================================================================
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
            $extKey,
            'Configuration/TypoScript',
            'RKW Info Layer'
        );


    },
    $_EXTKEY
);



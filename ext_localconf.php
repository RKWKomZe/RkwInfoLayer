<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function($extKey)
    {

        //=================================================================
        // Configure Plugin
        //=================================================================
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'RKW.' . $extKey,
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
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages(
            'tx_rkwinfolayer_domain_model_infolayer'
        );
    },
    $_EXTKEY
);




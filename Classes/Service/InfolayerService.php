<?php

namespace RKW\RkwInfoLayer\Service;

use TYPO3\CMS\Core\SingletonInterface;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

/**
 * InfolayerService
 *
 * @author Steffen Kroggel <developer@steffenkroggel.de>
 * @author Jeffrey Nellissen <nellissen@bergisch-media.de>
 * @copyright RKW Kompetenzzentrum
 * @package RKW_RkwInfoLayer
 * @licence http://www.gnu.org/copyleft/gpl.htm GNU General Public License, version 2 or later
 */
class InfolayerService implements SingletonInterface
{


    /**
     * Checks if layer has to be displayed or not
     *
     * @param integer $initialShow
     * @param integer $recallShow
     * @return boolean
     */
    public function check($initialShow, $recallShow)
    {

        /**  @var $feAuth \TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication */
        if ($feAuth = $GLOBALS['TSFE']->fe_user) {

            // Create new infolayer cookie if not already exists: timestamp + first => true
            if (!$this->getInitialCheck()) {

                // Set the relevant keys in cookie
                $feAuth->setKey('ses', 'rkw_infolayer_last_check_timestamp', time());
                $feAuth->setKey('ses', 'rkw_infolayer_first_check', false);
                $feAuth->setKey('ses', 'rkw_infolayer_initial_check', true);

                return false;
                //===
            }

            // check if layer is to show for the first time
            if (!$this->getFirstCheck()) {
                if ((intval($this->getLastCheckTimestamp()) + intval($initialShow)) < time()) {
                    return true;
                }
                //===

                // check if layer is to be shown again
            } else {

                if ((intval($this->getLastCheckTimestamp()) + intval($recallShow)) < time()) {
                    return true;
                }
                //===
            }
        }

        return false;
        //===
    }


    /**
     * Dismiss layer and prepare for next show up
     *
     * @return integer
     */
    public function dismiss()
    {

        /**  @var $feAuth \TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication */
        if ($feAuth = $GLOBALS['TSFE']->fe_user) {

            if (!$this->getFirstCheck()) {
                $feAuth->setKey('ses', 'rkw_infolayer_first_check', true);
            }

            $feAuth->setKey('ses', 'rkw_infolayer_last_check_timestamp', time());
        }
    }


    /**
     * Get timestamp of last check
     *
     * @return integer
     */
    public function getLastCheckTimestamp()
    {

        /**  @var $feAuth \TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication */
        if ($feAuth = $GLOBALS['TSFE']->fe_user) {
            return intval($feAuth->getKey('ses', 'rkw_infolayer_last_check_timestamp'));
        }

        //===

        return 0;
        //===
    }


    /**
     * Check if first check key exists, means: if layer has been displayed already
     *
     * @return boolean
     */
    public function getFirstCheck()
    {

        /**  @var $feAuth \TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication */
        if ($feAuth = $GLOBALS['TSFE']->fe_user) {
            return (boolean)$feAuth->getKey('ses', 'rkw_infolayer_first_check');
        }

        //===

        return false;
        //===
    }


    /**
     * Checks if initial check exists in cookie
     *
     * @return boolean
     */
    public function getInitialCheck()
    {

        /**  @var $feAuth \TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication */
        if ($feAuth = $GLOBALS['TSFE']->fe_user) {
            return (boolean)$feAuth->getKey('ses', 'rkw_infolayer_initial_check');
        }

        //===

        return false;
        //===
    }
}
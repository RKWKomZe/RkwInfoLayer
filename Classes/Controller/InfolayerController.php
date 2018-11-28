<?php

namespace RKW\RkwInfoLayer\Controller;


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
 * Class InfolayerController
 *
 * @author Steffen Kroggel <developer@steffenkroggel.de>
 * @author Jeffrey Nellissen <nellissen@bergisch-media.de>
 * @copyright RKW Kompetenzzentrum
 * @package RKW_RkwInfoLayer
 * @licence http://www.gnu.org/copyleft/gpl.htm GNU General Public License, version 2 or later
 */
class InfolayerController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * @var \RKW\RkwInfoLayer\Service\InfolayerService
     * @inject
     */
    protected $infolayerService;

    /**
     * infolayerRepository
     *
     * @var \RKW\RkwInfoLayer\Domain\Repository\InfolayerRepository
     * @inject
     */
    protected $infolayerRepository;


    /**
     * action list
     *
     * @return void
     */
    public function showAction()
    {

        // just do initial check
        if ($this->settings['displayType'] == 1) {
            $this->infolayerService->check($this->settings['initialShow'], $this->settings['recallShow']);
        }

        $this->view->assign('languageUid', intval($GLOBALS['TSFE']->sys_language_uid));
    }

    /**
     * action check
     *
     * @param integer $cookie
     * @return string
     */
    public function contentAction($cookie = 0)
    {

        // check for cookie agreement
        if (!$cookie) {
            $this->forward('cookie');
        }

        $showContent = false;
        if ($this->settings['displayType'] == 1) {
            $showContent = $this->infolayerService->check($this->settings['initialShow'], $this->settings['recallShow']);
        } else {
            $randomMax = ($this->settings['randomShow']) ? intval($this->settings['randomShow']) : 3;
            if (mt_rand(1, $randomMax) == 1) {
                $showContent = true;
            }
        }

        $content = '';
        if (
            ($showContent)
            && ($infolayerContent = $this->infolayerRepository->findRandom())
        ) {

            $this->view->assign('content', $infolayerContent);
            $content = $this->view->render();


            // if displayType = 1 we directly dismiss the layer here in case the user simply ignores it
            /* @toDo: Not working
             * if ($this->settings['displayType'] == 1) {
             * $this->infolayerService->dismiss();
             * }
             */
        }

        return json_encode(
            array(
                'data' => str_replace(array("\n", "\r", "\t"), '', $content),
            )
        );
        //===
    }

    /**
     * action cookie
     *
     * @return string
     */
    public function cookieAction()
    {

        $this->view->assign('termsPid', intval($this->settings['termsPid']));
        $this->view->assign('imprintPid', intval($this->settings['imprintPid']));
        $content = $this->view->render();

        return json_encode(
            array(
                'data' => str_replace(array("\n", "\r", "\t"), '', $content),
            )
        );
        //===
    }


    /**
     * action dismiss
     */
    public function dismissAction()
    {

        if ($this->settings['displayType'] == 1) {
            $this->infolayerService->dismiss();
        }

        return json_encode(array('success' => true));
        //===
    }

}
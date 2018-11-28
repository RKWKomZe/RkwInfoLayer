<?php

namespace RKW\RkwInfoLayer\Domain\Model;

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
 * Infolayer
 *
 * @author Steffen Kroggel <developer@steffenkroggel.de>
 * @author Jeffrey Nellissen <nellissen@bergisch-media.de>
 * @copyright RKW Kompetenzzentrum
 * @package RKW_RkwInfoLayer
 * @licence http://www.gnu.org/copyleft/gpl.htm GNU General Public License, version 2 or later
 */
class Infolayer extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * text
     *
     * @var string
     */
    protected $text = '';

    /**
     * Returns the text
     *
     * @return string $text
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Sets the text
     *
     * @param string $text
     * @return void
     */
    public function setText($text)
    {
        $this->text = $text;
    }

}
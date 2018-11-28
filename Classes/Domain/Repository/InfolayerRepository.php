<?php

namespace RKW\RkwInfoLayer\Domain\Repository;

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
 * InfolayerRepository
 *
 * @author Steffen Kroggel <developer@steffenkroggel.de>
 * @author Jeffrey Nellissen <nellissen@bergisch-media.de>
 * @copyright RKW Kompetenzzentrum
 * @package RKW_RkwInfoLayer
 * @licence http://www.gnu.org/copyleft/gpl.htm GNU General Public License, version 2 or later
 */
class InfolayerRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    /**
     * Get a random object
     *
     * @return \RKW\RkwInfoLayer\Domain\Model\Infolayer|array
     */
    public function findRandom()
    {

        $rows = $this->createQuery()->execute()->count();
        $rowNumber = mt_rand(0, max(0, ($rows - 1)));

        return $this->createQuery()->setOffset($rowNumber)->setLimit(1)->execute()->getFirst();
        //===
    }
}
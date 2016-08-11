<?php

/**
 * ConfigurationRepository
 */

namespace HDNET\OnpageIntegration\Domain\Repository;

/**
 * Class ConfigurationRepository
 */
class ConfigurationRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    /**
     * Find next Record
     *
     * @param integer $uid
     *
     * @return object
     */
    public function findRecord($uid)
    {
        $query = $this->findByUid($uid);

        if ($query) {
            return $query;
        } else {
            $uid++;
            return $this->findRecord($uid);
        }
    }
}

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
     * @param int $uid
     *
     * @return object
     */
    public function findByUid($uid)
    {
        return parent::findByUid($uid);
    }
}

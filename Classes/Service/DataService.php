<?php
/**
 * Class DataService
 */

namespace HDNET\OnpageIntegration\Service;

use HDNET\OnpageIntegration\Provider\Configuration;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class DataService
 */
class DataService extends AbstractService
{

    public function getSingleApiCall()
    {
        $configuration = GeneralUtility::makeInstance(Configuration::class);
        return $configuration->buildAuthentication();
    }

    public function getSeoAspects()
    {
        
    }
}

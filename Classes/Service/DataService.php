<?php
/**
 * Class DataService
 */

namespace HDNET\OnpageIntegration\Service;

use HDNET\Autoloader\Exception;
use HDNET\OnpageIntegration\Provider\Configuration;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class DataService
 */
class DataService extends AbstractService
{

    /**
     * Returns a test api call
     *
     * @return array
     * @throws Exception
     */
    public function getApiCalls()
    {
        $configuration = GeneralUtility::makeInstance(Configuration::class);

        if (!$configuration->buildAuthentication()) {
            throw new Exception("Can't build Authentication!");
        }
        $testIdentifier = $configuration->buildAuthentication();

        return $testIdentifier['zoom']['last_crawl'];
    }

    /**
     * todo build an identifier for a single call
     */
    public function buildIdentifier()
    {
        $identifier = 'zoom_seo_aspects_table';
        $identifierArray = explode($identifier, '_');

    }
}

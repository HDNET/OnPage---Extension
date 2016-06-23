<?php
/**
 * Class ApiResultLoader
 */
namespace HDNET\OnpageIntegration\Loader;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use HDNET\OnpageIntegration\Service\DataService;
use HDNET\OnpageIntegration\Persister\ApiResultToCachePersister;
use TYPO3\CMS\Core\Cache\CacheManager;

/**
 * Class ApiResultLoader
 */
class ApiResultLoader
{
    /**
     * @var DataService
     */
    protected $dataService;

    /**
     * @var ApiResultToCachePersister
     */
    protected $persister;

    public function __construct()
    {
        $this->dataService = GeneralUtility::makeInstance(DataService::class);
        $this->persister   = GeneralUtility::makeInstance(ApiResultToCachePersister::class);
    }

    /**
     * @param string $key
     * @return array
     */
    public function load($key)
    {
        $cacheId = $this->persister->getIdentifier($key);

        $entry = GeneralUtility::makeInstance(CacheManager::class)->getCache('onpage_extension')->get(
            $cacheId
        );

        if ($entry === false) {
            $entry = $this->dataService->getApiResult($key);
            $this->persister->persist($entry, $key);
        }

        return json_decode($entry, true);
    }
}

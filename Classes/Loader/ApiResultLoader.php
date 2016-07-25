<?php
/**
 * Class ApiResultLoader
 */
namespace HDNET\OnpageIntegration\Loader;

use HDNET\OnpageIntegration\Exception\ApiErrorException;
use HDNET\OnpageIntegration\Persister\ApiResultToCachePersister;
use HDNET\OnpageIntegration\Service\DataService;
use TYPO3\CMS\Core\Cache\CacheManager;
use TYPO3\CMS\Core\Utility\GeneralUtility;

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
        $this->persister = GeneralUtility::makeInstance(ApiResultToCachePersister::class);
    }

    /**
     * @param string $key
     *
     * @return array
     */
    public function load($key)
    {
        $cacheId = $this->persister->getIdentifier($key);

        $entry = GeneralUtility::makeInstance(CacheManager::class)
            ->getCache('onpage_extension')
            ->get($cacheId);

        if ($entry === false) {
            try {
                $entry = $this->dataService->getApiResult($key);
            } catch (ApiErrorException $e) {
            }
            $this->persister->persist($entry, $key);
        }

        return json_decode($entry, true);
    }
}

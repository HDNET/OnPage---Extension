<?php

namespace HDNET\OnpageIntegration\Persister;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Cache\CacheManager;

class ApiResultToCachePersister
{

    const TAG             = 'onpage_extension_deprecated';
    const CACHE_ID_PREFIX = 'HDNET_onpage_extension';
    const CACHE_LIFETIME  = 86400;

    protected $tags = [self::TAG];

    /**
     * @param string $data
     * @param string $key
     */
    public function persist($data, $key)
    {
        /** @var CacheManager $cacheManager */
        $cacheManager = GeneralUtility::makeInstance(CacheManager::class);
        $cache        = $cacheManager->getCache('onpage_extension');
        $cache->set($this->getIdentifier($key), json_encode($data), $this->tags, self::CACHE_LIFETIME);
    }

    /**
     * @param string $key
     * @return string
     */
    public function getIdentifier($key)
    {
        $id = sha1(self::CACHE_ID_PREFIX . $key);
        return $id;
    }
}

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
     * @param string $identifier
     */
    public function persist($data)
    {
        /** @var CacheManager $cacheManager */
        $cacheManager = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Cache\\CacheManager');
        $cache        = $cacheManager->getCache('onpage_extension');
        $cache->set($this->getIdentifier($data), $data, $this->tags, self::CACHE_LIFETIME);
    }

    /**
     * @param string $data
     * @return string
     */
    protected function getIdentifier($data)
    {
        $id = sha1(self::CACHE_ID_PREFIX . $data);
        return $id;
    }
}




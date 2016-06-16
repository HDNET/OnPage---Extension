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

    // Formel für identifier: $data + module_name + headline + index + [graph|table]
    // Oder anders: $data + alle Array-Keys des API-Calls
    // darüber sha1

    /**
     * @param string $data
     * @param string $identifier
     */
    public function persist($data, $identifier)
    {
        /** @var CacheManager $cacheManager */
        $cacheManager = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Cache\\CacheManager');
        $cache        = $cacheManager->getCache('onpage_extension');
        $cache->set($this->getIdentifier($identifier), $data, $this->tags, self::CACHE_LIFETIME);
    }

    /**
     * @param string $identifier
     * @return string
     */
    protected function getIdentifier($data)
    {
        return sha1(self::CACHE_ID_PREFIX . $data);
    }
}




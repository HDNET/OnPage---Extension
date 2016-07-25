<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\HDNET\Autoloader\Loader::extLocalconf('HDNET', 'onpage_integration', [
    'SmartObjects',
    'TcaFiles',
    'CommandController'
]);


TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin('HDNET.' . $_EXTKEY, 'onpage_integration', []);

// Caching

if (!is_array($GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['onpage_extension'])) {
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['onpage_extension'] = [
        'frontend' => \TYPO3\CMS\Core\Cache\Frontend\StringFrontend::class,
        'groups'   => ['onpage'],
        'options' => [
            'defaultLifetime' => \HDNET\OnpageIntegration\Persister\ApiResultToCachePersister::DEFAULT_CACHE_LIFETIME,
        ],
    ];
}

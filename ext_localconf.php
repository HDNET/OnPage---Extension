<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\HDNET\Autoloader\Loader::extLocalconf('HDNET', 'onpage_integration', [
    'SmartObjects',
    'TcaFiles'
]);


TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'HDNET.'.$_EXTKEY,
    'onpage_integration',
    array()
);

// Caching

if (!is_array($TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['onpage_extension'])) {
    $TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['onpage_extension'] = array();
}

if (!isset($TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['onpage_extension']['backend'])) {
    $TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['onpage_extension']['backend'] = 'TYPO3\\CMS\\Core\\Cache\\Backend\\SimpleFileBackend';
}

if (!isset($TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['onpage_extension']['frontend'])) {
    $TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['onpage_extension']['frontend'] = 'TYPO3\\CMS\\Core\\Cache\\Frontend\\StringFrontend';
}

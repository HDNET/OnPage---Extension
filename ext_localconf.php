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


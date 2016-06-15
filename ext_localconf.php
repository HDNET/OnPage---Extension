<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}
TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'HDNET.'.$_EXTKEY,
    'onpage_integration',
    array()
);


<?php
<<<<<<< 5851fedfe7b02562c0bb0e52a45b9344b357a91b
if (!defined ('TYPO3_MODE')) die ('Access denied.');

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    $_EXTKEY
);
=======
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}
TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'HDNET.'.$_EXTKEY,
    'Onpage',
    array()
);
>>>>>>> Added BE Module

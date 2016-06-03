<?php
if (TYPO3_MODE === 'BE') {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        $_EXTKEY,
        'web',          // Main area
        'mod1',         // Name of the module
        '',             // Position of the module
        array(          // Allowed controller action combinations
        ),
        array(          // Additional configuration
                        'access'    => 'user,group',
                        'icon'      => '',
                        'labels'    => 'OnPage.org',
        )
    );
}
<?php

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'HDNET.'.$_EXTKEY,
    'Onpage',
    'OnPage - SEO Tool'
);

if (TYPO3_MODE === 'BE') {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        'HDNET.'.$_EXTKEY,
        'web',             // Position of the module
        'management',               // module name
        '',
        array(          // Allowed controller action combinations
                        'Backend' => 'index',
        ),
        array(          // Additional configuration
                           'access' => 'user,group',
                           'icon'   => '',
                           'labels' => 'OnPage.org',
        ));
}
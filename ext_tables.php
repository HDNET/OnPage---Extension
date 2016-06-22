<?php

\HDNET\Autoloader\Loader::extTables('HDNET', 'onpage_integration', [
    'SmartObjects',
    'TcaFiles'
]);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'HDNET.'.$_EXTKEY,
    'onpage_integration',
    'OnPage - SEO Tool'
);

if (TYPO3_MODE === 'BE') {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        'HDNET.'.$_EXTKEY,
        'web',             // Position of the module
        'management',               // module name
        '',
        array(          // Allowed controller action combinations
                        'Backend' => 'index,seo,content,technical,keyword,detail',
        ),
        array(          // Additional configuration
                           'access' => 'user,group',
                           'icon'   => 'EXT:onpage_integration/ext_icon.png',
                           'labels' => 'LLL:EXT:onpage_integration/Resources/Private/Language/locallang_mod.xlf',
        )
    );
}

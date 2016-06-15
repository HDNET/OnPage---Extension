<?php
$EM_CONF[$_EXTKEY] = array(
    'title' => 'OnPage Integration',
    'description' => 'Show editors important information about their SEO process',
    'category' => 'plugin',
    'author' => 'René Backhaus',
    'author_company' => 'HDNET GmbH & Co. KG',
    'author_email' => 'rene.backhaus@hdnet.de',
    'dependencies' => 'extbase,fluid',
    'state' => 'alpha',
    'clearCacheOnLoad' => '1',
    'version' => '0.0.1',
    'constraints' => array(
        'depends' => array(
            'typo3'      => '6.2.0-7.6.99',
        )
    )
);

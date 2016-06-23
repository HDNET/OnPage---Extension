<?php

/**
 * Base TCA generation for the model HDNET\\OnpageIntegration\\Domain\\Model\\Configuration
 */

$base = \HDNET\Autoloader\Utility\ModelUtility::getTcaInformation(HDNET\OnpageIntegration\Domain\Model\Configuration::class);

$custom = [
    'columns' => [
        'hide_fields' => [
            'config' => [
                'type'    => 'text',
                'default' => implode("\n", \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(',',
                    \HDNET\OnpageIntegration\Domain\Model\Configuration::DEFAULT_HIDE_FIELDS, true)),
            ],

        ],
    ]
];


return \HDNET\Autoloader\Utility\ArrayUtility::mergeRecursiveDistinct($base, $custom);

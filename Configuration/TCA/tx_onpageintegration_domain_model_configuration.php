<?php

/**
 * Base TCA generation for the model HDNET\\OnpageIntegration\\Domain\\Model\\Configuration
 */

$base = \HDNET\Autoloader\Utility\ModelUtility::getTcaInformation(HDNET\OnpageIntegration\Domain\Model\Configuration::class);

$custom = [];


return \HDNET\Autoloader\Utility\ArrayUtility::mergeRecursiveDistinct($base, $custom);

<?php

/**
 * Base TCA generation for the model HDNET\\OnpageIntegration\\Domain\\Model\\Configuration
 */

$base = \HDNET\Autoloader\Utility\ModelUtility::getTcaInformation('HDNET\\OnpageIntegration\\Domain\\Model\\Configuration');

$custom = array();

return \HDNET\Autoloader\Utility\ArrayUtility::mergeRecursiveDistinct($base, $custom);
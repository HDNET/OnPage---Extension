<?php
/**
 * Class ArrayUtility
 */
namespace HDNET\OnpageIntegration\Utility;

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class ArrayUtility
 */
class ArrayUtility
{

    /**
     * Append the errors of an api call to
     * metaDataArray
     *
     * @param $metaDataArray
     * @param $section
     */
    public static function buildIndexActionArray(&$metaDataArray, $section)
    {
        $loader = GeneralUtility::makeInstance(\HDNET\OnpageIntegration\Loader\ApiResultLoader::class);
        for ($i = 0; $i < count($metaDataArray[0]); $i++) {
            $metaDataArray[0][$i]['errors'] = $loader->load('zoom_' . $section . '_' . $i . '_graph');
        }
    }
}

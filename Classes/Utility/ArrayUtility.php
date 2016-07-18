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
            $graphDataArray = $loader->load('zoom_' . $section . '_' . $i . '_graph');

            $metaDataArray[0][$i]['errors'] = self::getErrors($graphDataArray, $metaDataArray[0][$i]['errors']);
            $metaDataArray[0][$i]['test'] = $graphDataArray;
        }
    }

    /**
     * Set the errors report into the array ...
     *
     * @param $array
     * @param $value
     *
     */
    protected static function getErrors($array, $value) {
        if($value == 'sum') {
            $total = 0;
            foreach($array as $element) {
                $total += $element['count'];
            }
            return $total;
        }
        foreach ($array as $element) {
            if (in_array($value, $element)) {
                return $element['count'];
            }
        }
    }
}

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
     * @param $metaDataArray
     * @param $section
     */
    static public function buildIndexActionArray(&$metaDataArray, $section)
    {
        $loader = GeneralUtility::makeInstance(\HDNET\OnpageIntegration\Loader\ApiResultLoader::class);
        for ($i = 0; $i < count($metaDataArray[0]); $i++) {
            $metaDataArray[0][$i]['errors'] = $loader->load('zoom_' . $section . '_' . $i . '_graph');
        }
    }
}

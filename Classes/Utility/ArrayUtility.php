<?php
/**
 * Class ArrayUtility
 */
namespace HDNET\OnpageIntegration\Utility;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

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
            $errorReportyKey = $metaDataArray[0][$i]['errors'];

            DebuggerUtility::var_dump($errorReportyKey,'errorReportKey');
            $metaDataArray[0][$i]['errors'] = self::errorReport($graphDataArray, $errorReportyKey);
            $metaDataArray[0][$i]['test'] = $graphDataArray;
        }
    }

    /**
     * Determine the error report of an aspect
     *
     * @param $graphApiCallResult
     * @param $errorReportKey
     *
     * @return int
     */
    protected static function errorReport($graphApiCallResult,$errorReportKey) {
        $totalErrors = 0;
        foreach($graphApiCallResult as $element) {
            DebuggerUtility::var_dump($element,'element');
            if(in_array('sum', $errorReportKey)) {
                if(in_array($errorReportKey['hidden'], $element)) {
                    continue;
                }
                $totalErrors += $element['count'];
            }
            if(in_array($errorReportKey['show'], $graphApiCallResult)) {
                $totalErrors += $element['count'];
            }
        }
        return $totalErrors;
    }
}

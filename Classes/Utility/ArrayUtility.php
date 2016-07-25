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
            $errorReportyKey = $metaDataArray[0][$i]['errors'];

            $metaDataArray[0][$i]['errors'] = self::errorReport($graphDataArray, $errorReportyKey);
            //todo remove
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
    protected static function errorReport($graphApiCallResult, $errorReportKey)
    {
        $totalErrors = 0;

        foreach ($graphApiCallResult as $element) {

            if (in_array('sum', $errorReportKey)) {
                if (in_array($errorReportKey['hidden'], $element)) {
                    continue;
                }
                $totalErrors += $element['count'];
            }

            if (in_array($errorReportKey['show'], $element)) {
                $totalErrors += $element['count'];
            }
        }
        return $totalErrors;
    }

    /**
     * Fitted $tableApiCallResult by the elements of
     * $showTableKey
     *
     * @param array $tableApiCallResult
     * @param array $showTableKey
     *
     * @return array
     */
    public static function showTable(array $tableApiCallResult, array $showTableKey)
    {
        $fittedTablesRecords = [];
        foreach ($tableApiCallResult as $singleCallElement) {

            foreach ($showTableKey as $key) {
                if (array_key_exists($key, $singleCallElement)) {
                    $singleRecordArray[$key] = $singleCallElement[$key];
                }
            }
            $fittedTablesRecords[] = $singleRecordArray;
        }
        return $fittedTablesRecords;
    }
}

<?php
/**
 * Class ArrayUtility
 */
namespace HDNET\OnpageIntegration\Utility;

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class ApiCallUtility
 */
class ApiCallUtility
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
        $i = 0;
        foreach ($metaDataArray[0] as $element) {
            $graphDataArray = $loader->load('zoom_' . $section . '_' . $i . '_graph');
            $errorReportyKey = $element['errors'];
            $element['errors'] = self::errorReport($graphDataArray, $errorReportyKey);
            $i++;
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
    public static function showColumns(array $tableApiCallResult, array $showTableKey)
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

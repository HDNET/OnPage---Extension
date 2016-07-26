<?php
/**
 *
 */

namespace HDNET\OnpageIntegration\Service;


use HDNET\OnpageIntegration\Loader\ApiResultLoader;

class OnPageService extends AbstractService
{

    /**
     * OnPageService constructor.
     *
     * @param ApiResultLoader $loader
     */
    public function __construct(ApiResultLoader $loader)
    {
        $this->loader = $loader;
    }

    /**
     * So that you get the error report of an
     * api call you have to crawl the graph api call
     * from a filter.
     *
     * In the next the you load the error report keys and
     * commit it into the errorReport function.
     *
     * errorReport generates the error report and afterwards
     * its stores in the field 'errors'.
     * '     *
     *
     * @param array           $metaDataArray
     * @param string          $section
     * @param ApiResultLoader $loader
     */
    public function build(array $buildData, $section)
    {
        $i = 0;
        foreach ($buildData as $element) {
            $graphDataArray = $this->loader->load('zoom_' . $section . '_' . $i . '_graph');
            $errorReportKey = $element['errors'];
            $element['errors'] = $this->errorReport($graphDataArray, $errorReportKey);
            $i++;
        }
        return $buildData;
    }

    /**
     * Generates the error report key of an api call and
     * return the result.
     *
     * @param array $graphApiCallResult
     * @param mixed $errorReportKey
     *
     * @return int
     */
    protected function errorReport(array $graphApiCallResult, $errorReportKey)
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
     * @param string $apiCall
     * @param array  $showTableKey
     *
     * @return array
     */
    public function showColumns($apiCall, array $showTableKey)
    {
        $apiCallResult = $this->loader($apiCall);

        $fittedTablesRecords = [];
        foreach ($apiCallResult as $singleCallElement) {
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

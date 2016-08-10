<?php
/**
 * Class ArrayTransformViewHelper
 */

namespace HDNET\OnpageIntegration\ViewHelpers;

/**
 * Class ArrayTransformViewHelper
 */
class ArrayTransformViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

    /**
     * @var array
     */
    protected $transformedLastCrawl = [
        'working_page' => false,
        'working_external_link' => false,
        'working_asset' => false,
        'working_image' => false,
        'broken_page' => false,
        'broken_external_link' => false,
        'broken_asset' => false,
        'broken_image' => false
    ];

    /**
     * Transformed the numeric last crawl array into a associative array
     *
     * @param mixed $lastCrawl
     *
     * @return array
     */
    public function render($lastCrawl)
    {
        foreach($lastCrawl as $lastCrawlElement) {
            foreach($this->transformedLastCrawl as $key => $element) {
                if($lastCrawlElement['inventory_group'] === $key) {
                    $this->transformedLastCrawl[$key] = $lastCrawlElement['count'];
                }
            }
        }
        return $this->transformedLastCrawl;
    }
}

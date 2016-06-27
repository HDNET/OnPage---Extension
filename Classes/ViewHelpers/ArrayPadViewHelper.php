<?php
/**
 * Class ArrayPadViewHelper
 */

namespace HDNET\OnpageIntegration\ViewHelpers;

/**
 * Class ArrayPadViewHelper
 */
class ArrayPadViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

    /**
     * Generates a array by the given size
     *
     * @param string $size
     *
     * @return array
     */
    public function render($size)
    {
        $emptyArray  = [];
        $emptyArray = array_pad($emptyArray, $size, '');
        return $emptyArray;
    }
}

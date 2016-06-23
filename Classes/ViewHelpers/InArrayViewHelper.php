<?php

/**
 * Class InArrayViewHelper
 */

namespace HDNET\OnpageIntegration\ViewHelpers;

use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * Class InArrayViewHelper
 */
class InArrayViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

    /**
     * @param array  $array
     * @param string $value
     * @param string $key
     * @param int $negate
     */
    public function render($array, $value, $key, $negate = 0)
    {
        if (in_array($key, $array)) {
            return '';
        }
        return $value;
    }
}

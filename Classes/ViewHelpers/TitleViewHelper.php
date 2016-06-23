<?php

/**
 * Class TitleViewHelper
 */

namespace HDNET\OnpageIntegration\ViewHelpers;

/**
 * Class TitleViewHelper
 */
class TitleViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

    /**
     * Removed the underscore and
     * uppercase the first character
     * of a snake case string
     *
     * @param string $title
     *
     * @return string
     */
    public function render($title)
    {
        $titleArray = explode('_', $title);

        $UpperTitle = array_map(function ($value) {
            return ucfirst($value);
        }, $titleArray);

        return implode(' ', $UpperTitle);
    }
}

<?php
/**
 * Class PriorityViewHelper
 */

namespace HDNET\OnpageIntegration\ViewHelpers;

/**
 * Class PriorityViewHelper
 */
class PriorityViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

    /**
     * Generates the html output for
     * the priority ranking
     *
     * @param string $priority
     *
     * @return null|string
     */
    public function render($priority)
    {
        $html = null;
        // @todo ggf. im Template bauen. Wenn Iteration zu kompliziert, nur die Iteration hier vorbereiten
        for ($i = 0; $i < $priority; $i++) {
            $html .= "&#8226;&bull;";
        }
        return $html;
    }
}

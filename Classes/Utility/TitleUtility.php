<?php

/**
 * Class TitleUtility
 */

namespace HDNET\OnpageIntegration\Utility;

/**
 * Class TitleUtility
 */
class TitleUtility
{

    /**
     * Generate the $moduleName for the
     * detail template
     *
     * @param $section
     *
     * @return null|string
     */
    public static function makeSubTitle($section)
    {
        switch ($section) {
            case 'seoaspects':
                return 'SEO Aspekte';
                break;
            case 'contentaspects':
                return 'Technische Aspekte';
                break;
            case 'technicalaspects':
                return 'Technische Aspekte';
                break;
            default:
                return null;
                break;
        }
    }
}

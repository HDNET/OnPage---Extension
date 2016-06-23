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
     * @param $section
     *
     * @return string
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
        }
    }
}

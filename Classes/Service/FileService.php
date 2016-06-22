<?php

/**
 * Class FileService
 */

namespace HDNET\OnpageIntegration\Service;

use HDNET\Autoloader\Exception;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class FileService
 */
class FileService extends AbstractService
{

    /**
     * Returns file content
     *
     * @return string
     */
    public function readFile($filePath)
    {
        if (!is_file($filePath)) {
            throw new Exception("File not found!");
        }

        return GeneralUtility::getUrl($filePath);
    }
}

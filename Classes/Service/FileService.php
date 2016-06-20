<?php

/**
 * Class FileService
 */

namespace HDNET\OnpageIntegration\Service;

use HDNET\Autoloader\Exception;

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
        if (!file_exists($filePath)) {
            throw new Exception("File not found!");
        }

        return file_get_contents($filePath);
    }
}

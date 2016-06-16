<?php

/**
 * Class FileService
 */

namespace HDNET\OnpageIntegration\Service;

/**
 * Class FileService
 */
class FileService extends AbstractService
{

    /**
     * Retuns file content
     *
     * @return string
     */
    public function readFile($filePath)
    {
        return file_get_contents($filePath);
    }
}

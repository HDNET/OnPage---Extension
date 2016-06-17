<?php

/**
 * Class Configuration
 */

namespace HDNET\OnpageIntegration\Provider;

use HDNET\OnpageIntegration\Service\FileService;
use HDNET\OnpageIntegration\Exception\UnknownApiCallException;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class Configuration
 */
class Configuration extends AbstractProvider
{
    /**
     * @var \HDNET\OnpageIntegration\Service\FileService
     */
    protected $fileService;

    /**
     * Replace the authentication key with
     * api-key information
     *
     * @param string $apiCallKey
     * @return array
     * @throws \HDNET\Autoloader\Exception
     */
    public function get($apiCallKey)
    {
        $this->fileService = GeneralUtility::makeInstance(FileService::class);
        $apiCallData      = $this->fileService->readFile(
            '/var/www/docroot/typo3conf/ext/onpage_integration/Configuration/ApiCalls.json'
        );
        $apiCallsArray    = json_decode($apiCallData, true);
        $apiCallArrayKeys = $this->getApiCallArrayKeys($apiCallKey);

        return $this->findMatchingApiCall($apiCallsArray, $apiCallArrayKeys);
    }

    /**
     * @param array $apiCalls
     * @param array $apiCallArrayKeys
     * @return string
     * @throws \HDNET\OnpageIntegration\Exception\UnknownApiCallException
     */
    protected function findMatchingApiCall(array $apiCalls, array $apiCallArrayKeys)
    {
        $apiCall = $apiCalls;

        foreach ($apiCallArrayKeys as $key) {
            if (!isset($apiCall[$key])) {
                throw new UnknownApiCallException('Unknown API Call.');
            } else {
                $apiCall = $apiCall[$key];
            }
        }

        return $apiCall;
    }

    /**
     * @param string $apiCallKey
     * @return array
     */
    protected function getApiCallArrayKeys($apiCallKey)
    {
        return explode('_', $apiCallKey);
    }
}

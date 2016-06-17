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
    public function getSingleConfiguration($apiCallKey)
    {
        $apiCallsArray    = $this->getApiCallsArray();
        $apiCallArrayKeys = $this->getApiCallArrayKeys($apiCallKey);

        return $this->findMatchingApiCall($apiCallsArray, $apiCallArrayKeys);
    }

    /**
     * @return array
     */
    public function getAllConfigurationData(){
        return $this->getApiCallsArray();
    }

    /**
     * @return array
     */
    protected function getApiCallsArray(){
        $this->fileService = GeneralUtility::makeInstance(FileService::class);
        $apiCallData      = $this->fileService->readFile(
           PATH_site . 'typo3conf/ext/onpage_integration/Configuration/ApiCalls.json'
        );

        return json_decode($apiCallData, true);
    }

    /**
     * @param array $apiCalls
     * @param array $apiCallArrayKeys
     * @return array
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

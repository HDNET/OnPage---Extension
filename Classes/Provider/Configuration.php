<?php

/**
 * Class Configuration
 */

namespace HDNET\OnpageIntegration\Provider;

use GeorgRinger\News\Service\FileService;
use HDNET\OnpageIntegration\Exception\UnknownApiCallException;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class Configuration
 */
class Configuration extends AbstractProvider
{
    /**
     * @inject
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
        $apiCall = '';

        foreach ($apiCallArrayKeys as $key) {
            if (!isset($apiCalls[$key])) {
                throw new UnknownApiCallException('Unknown API Call.');
            } else {
                $apiCall = $apiCalls[$key];
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

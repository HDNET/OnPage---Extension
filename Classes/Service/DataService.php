<?php
/**
 * Class DataService
 */

namespace HDNET\OnpageIntegration\Service;

use HDNET\OnpageIntegration\Exception\ApiErrorException;
use HDNET\OnpageIntegration\Provider\AuthenticationProvider;
use HDNET\OnpageIntegration\Provider\ConfigurationProvider;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class DataService
 */
class DataService extends AbstractService
{

    /**
     * @var \HDNET\OnpageIntegration\Provider\ConfigurationProvider
     */
    protected $configurationProvider;

    /**
     * @var \HDNET\OnpageIntegration\Service\ArrayService
     */
    protected $arrayService;

    /**
     * @var \HDNET\OnpageIntegration\Provider\AuthenticationProvider
     */
    protected $authenticationProvider;

    /**
     * @var \HDNET\OnpageIntegration\Service\ApiCallService
     */
    protected $apiCallService;

    /**
     * DataService constructor.
     *
     * @param ConfigurationProvider  $configurationProvider
     * @param AuthenticationProvider $authenticationProvider
     * @param ArrayService           $arrayService
     * @param ApiCallService         $apiCallService
     */
    public function __construct(ConfigurationProvider $configurationProvider, AuthenticationProvider $authenticationProvider, ArrayService $arrayService, ApiCallService $apiCallService)
    {
        $this->configurationProvider = $configurationProvider;
        $this->authenticationProvider = $authenticationProvider;
        $this->arrayService = $arrayService;
        $this->apiCallService = $apiCallService;
    }

    /**
     * @param string $key
     *
     * @return array
     * @throws ApiErrorException
     */
    public function getApiResult($key)
    {
        $apiCall = $this->getApiCall($key);
        $result = $this->makeApiCall($apiCall);
        $result = json_decode($result, true);

        if (!isset($result['status']) || $result['status'] != 'success' || !isset($result['result'])) {
            throw new ApiErrorException('There has been a negative result for your request.');
        }

        return $result['result'];
    }

    /**
     * @return array
     * @throws ApiErrorException
     */
    public function getAllResults()
    {
        $results = [];
        $configData = $this->configurationProvider->getAllConfigurationData();
        $keys = $this->arrayService->findByContainedKey($configData, 'authentication');

        foreach ($keys as $key) {
            try {
                $results[$key] = $this->getApiResult($key);
            } catch (ApiErrorException $e) {
                continue;
            }
        }

        return $results;
    }

    /**
     * @param array $apiCall
     *
     * @return string
     */
    protected function makeApiCall(array $apiCall)
    {
        $json = json_encode($apiCall);
        return $this->apiCallService->makeCall($json);
    }

    /**
     * @param string $apiCallKey
     *
     * @return array
     */
    protected function getApiCall($apiCallKey)
    {
        $authenticationData = $this->authenticationProvider->get();
        $configurationData = $this->configurationProvider->getSingleConfiguration($apiCallKey);

        return $this->arrayService->replaceRecursiveByKey($configurationData, $authenticationData, 'authentication');
    }
}

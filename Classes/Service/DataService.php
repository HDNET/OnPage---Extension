<?php
/**
 * Class DataService
 */

namespace HDNET\OnpageIntegration\Service;

use HDNET\OnpageIntegration\Exception\ApiErrorException;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use HDNET\OnpageIntegration\Provider\Configuration;
use HDNET\OnpageIntegration\Provider\Authentication;
use HDNET\OnpageIntegration\Service\ArrayService;
use HDNET\OnpageIntegration\Service\ApiCallService;

/**
 * Class DataService
 */
class DataService extends AbstractService
{
    /**
     * @var \HDNET\OnpageIntegration\Provider\Configuration
     */
    protected $configurationProvider;
    /**
     * @var \HDNET\OnpageIntegration\Service\ArrayService
     */
    protected $arrayService;
    /**
     * @var \HDNET\OnpageIntegration\Provider\Authentication
     */
    protected $authenticationProvider;
    /**
     * @var \HDNET\OnpageIntegration\Service\ApiCallService
     */
    protected $apiCallService;

    public function __construct(){
        $this->configurationProvider = GeneralUtility::makeInstance(Configuration::class);
        $this->authenticationProvider = GeneralUtility::makeInstance(Authentication::class);
        $this->arrayService = GeneralUtility::makeInstance(ArrayService::class);
        $this->apiCallService = GeneralUtility::makeInstance(ApiCallService::class);
    }

    /**
     * @param string $key
     * @return string
     */
    public function getApiResult($key)
    {
        $apiCall = $this->getApiCall($key);
        $result  = $this->makeApiCall($apiCall);
        $result = json_decode($result, true);

        if (!isset($result['status']) || $result['status'] != 'success' || !isset($result['result'])){
            throw new ApiErrorException('There has been a negative result for your request.');
        }

        return $result['result'];
    }

    /**
     * @return array
     */
    public function getAllResults(){
        $results = [];
        $configData = $this->configurationProvider->getAllConfigurationData();
        $keys = $this->arrayService->findByContainedKey($configData, 'authentication');

        foreach ($keys as $key){
            $results[$key] = $this->getApiResult($key);
        }

        return $results;
    }

    /**
     * @param array $apiCall
     * @return string
     */
    protected function makeApiCall(array $apiCall)
    {
        $json = json_encode($apiCall);
        return $this->apiCallService->makeCall($json);
    }

    /**
     * @param string $apiCallKey
     * @return array
     */
    protected function getApiCall($apiCallKey)
    {
        $authenticationData = $this->authenticationProvider->get();
        $configurationData  = $this->configurationProvider->getSingleConfiguration($apiCallKey);

        return $this->arrayService->replaceRecursiveByKey($configurationData, $authenticationData, 'authentication');
    }
}

<?php
/**
 * Class DataService
 */

namespace HDNET\OnpageIntegration\Service;

use HDNET\Autoloader\Exception;
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
     * @inject
     */
    protected $configurationProvider;
    /**
     * @var \HDNET\OnpageIntegration\Service\ArrayService
     * @inject
     */
    protected $arrayService;
    /**
     * @var \HDNET\OnpageIntegration\Provider\Authentication
     * @inject
     */
    protected $authenticationProvider;
    /**
     * @var \HDNET\OnpageIntegration\Service\ApiCallService
     * @inject
     */
    protected $apiCallService;

    /**
     * @param string $key
     * @return string
     */
    public function getApiResult($key)
    {
        $this->configurationProvider = GeneralUtility::makeInstance(Configuration::class);
        $this->authenticationProvider = GeneralUtility::makeInstance(Authentication::class);
        $this->arrayService = GeneralUtility::makeInstance(ArrayService::class);
        $this->apiCallService = GeneralUtility::makeInstance(ApiCallService::class);

        $apiCall = $this->getApiCall($key);
        $result  = $this->makeApiCall($apiCall);

        return json_decode($result);
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
        $configurationData  = $this->configurationProvider->get($apiCallKey);

        return $this->arrayService->replaceRecursiveByKey($configurationData, $authenticationData, 'authentication');
    }
}

<?php

namespace HDNET\OnpageIntegration\Provider;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use HDNET\OnpageIntegration\Service\ArrayService;


class MetaDataProvider
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
     * MetaDataProvider constructor.
     *
     * @param ConfigurationProvider $configurationProvider
     * @param ArrayService          $arrayService
     */
    public function __construct(ConfigurationProvider $configurationProvider, ArrayService $arrayService)
    {
        $this->configurationProvider = $configurationProvider;
        $this->arrayService          = $arrayService;
    }

    /**
     * @param string $key
     * @return array
     */
    public function getMetaData($key)
    {
        $configData = $this->configurationProvider->getAllConfigurationData();
        $searchKeys = ['description', 'priority', 'errors', 'show'];

        $elements = $this->arrayService->findElement($configData, $key);

        return $this->buildData($elements, $searchKeys);
    }

    /**
     * @param array $array
     * @param array $searchKeys
     * @return array
     */
    protected function buildData(array $array, array $searchKeys)
    {
        $tmp = [];

        foreach ($array as $key => $element) {
            $tmp[$key] = $this->filter($element, $searchKeys);
        }

        return $tmp;
    }

    /**
     * @param array $array
     * @param array $searchKeys
     * @return array
     */
    protected function filter(array $array, array $searchKeys)
    {
        $tmp = [];

        foreach ($array as $key => $element) {
            if (in_array($key, $searchKeys)) {
                $tmp[$key] = $element;
            }
        }

        return $tmp;
    }
}

<?php

namespace HDNET\OnpageIntegration\Provider;

use HDNET\OnpageIntegration\Service\ArrayService;
use HDNET\OnpageIntegration\Service\OnPageService;

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
     * @var \HDNET\OnpageIntegration\Service\OnPageService
     */
    protected $onPageService;

    /**
     * MetaDataProvider constructor.
     *
     * @param ConfigurationProvider $configurationProvider
     * @param ArrayService          $arrayService
     */
    public function __construct(
        ConfigurationProvider $configurationProvider,
        ArrayService $arrayService,
        OnPageService $onPageService
    ) {
        $this->configurationProvider = $configurationProvider;
        $this->arrayService = $arrayService;
        $this->onPageService = $onPageService;
    }

    /**
     * @param string $key
     *
     * @return array
     */
    public function getMetaData($key)
    {
        $configData = $this->configurationProvider->getAllConfigurationData();
        $searchKeys = ['description', 'priority', 'errors', 'show'];

        $elements = $this->arrayService->findElement($configData, $key);
        $buildData = $this->buildData($elements, $searchKeys);

        return $this->onPageService->build($buildData, $key);
    }

    /**
     * @param array $array
     * @param array $searchKeys
     *
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
     *
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

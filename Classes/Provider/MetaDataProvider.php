<?php

namespace HDNET\OnpageIntegration\Provider;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use HDNET\OnpageIntegration\Service\ArrayService;

class MetaDataProvider
{

    /**
     * @var ConfigurationProvider
     */
    protected $configurationProvider;
    /**
     * @var ArrayService
     */
    protected $arrayService;

    public function __construct()
    {
        $this->configurationProvider = GeneralUtility::makeInstance(ConfigurationProvider::class);
        $this->arrayService          = GeneralUtility::makeInstance(ArrayService::class);
    }

    /**
     * @param string $key
     * @return array
     */
    public function getMetaData($key)
    {
        $configData = $this->configurationProvider->getAllConfigurationData();
        $searchKeys = ['description', 'priority'];

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

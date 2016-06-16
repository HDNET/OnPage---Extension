<?php

/**
 * Class Configuration
 */

namespace HDNET\OnpageIntegration\Provider;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;

/**
 * Class Configuration
 */
class Configuration extends AbstractProvider
{

    /**
     * @return mixed
     */
    public function buildAuthentication()
    {

        $objectManager = new ObjectManager();
        $auth = $objectManager->get(Authentication::class);
        $authData = $auth->buildAuthenticationArray();

        $fileService = GeneralUtility::makeInstance(\HDNET\OnpageIntegration\Service\FileService::class);
        $apiCallsArray = json_decode($fileService->readFile('/var/www/docroot/typo3conf/ext/onpage_integration/Configuration/ApiCalls.json'), true);

        $arrayService = GeneralUtility::makeInstance(\HDNET\OnpageIntegration\Service\ArrayService::class);
        $apiCallsArray = $arrayService->replaceRecursiveByKey($apiCallsArray, $authData, 'authentication');

        return $apiCallsArray;
    }
}

<?php

namespace HDNET\OnpageIntegration\Controller;

use HDNET\OnpageIntegration\Service\DataService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class BackendController extends ActionController
{

    /**
     * Represent the index page
     */
    public function workOnAction()
    {
        $dataService = GeneralUtility::makeInstance(DataService::class);

        $result = $dataService->getApiResult('zoom_seoaspects_0_graph');
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($result);
    }
}

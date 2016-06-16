<?php

namespace HDNET\OnpageIntegration\Controller;

use HDNET\OnpageIntegration\Service\DataService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class BackendController extends ActionController
{

    public function indexAction()
    {
        $dataService = GeneralUtility::makeInstance(DataService::class);
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($dataService->getSingleApiCall());
    }
}

<?php

namespace HDNET\OnpageIntegration\Controller;

use HDNET\OnpageIntegration\Service\ApiCallService;
use HDNET\OnpageIntegration\Service\DataService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class BackendController extends ActionController
{

    /**
     * Represent the index page
     */
    public function indexAction()
    {
        $seoAspects = '';
        $contentAspects = '';
        $technicalAspects = '';

        $apiCallService = GeneralUtility::makeInstance(ApiCallService::class);

        $lastCrawlResult = $apiCallService->makeCall($latestCrawl);
        $seoAspectsResult = $apiCallService->makeCall($seoAspects);
        $contentAspectsResult = $apiCallService->makeCall($contentAspects);
        $technicalAspectsResult = $apiCallService->makeCall($technicalAspects);

        $this->view->assignMultiple([
            'lastCrawl'        => $latestCrawl,
            'seoAspects'       => $seoAspects,
            'contentAspects'   => $contentAspects,
            'technicalAspects' => $technicalAspects,
        ]);
    }

    public function detailAction()
    {
        $apiCallService = GeneralUtility::makeInstance(ApiCallService::class);

        $graph = $apiCallService->makeCall($graphApi);
        $table = $apiCallService->makeCall($tableApi);

        $this->view->assignMultiple([
            'graph' => $graph,
            'table' => $table
        ]);
    }

    /**
     *
     */
    public function keywordAction()
    {
        $dataService = GeneralUtility::makeInstance(DataService::class);

        $result = $dataService->getApiResult('zoom_seoaspects_0_graph');
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($result);
    }
}

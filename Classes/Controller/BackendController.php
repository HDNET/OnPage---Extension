<?php

namespace HDNET\OnpageIntegration\Controller;

use HDNET\OnpageIntegration\Service\ApiCallService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class BackendController extends ActionController
{

    /**
     * Represent the index page
     */
    public function indexAction()
    {
        $latestCrawl = '';
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
}

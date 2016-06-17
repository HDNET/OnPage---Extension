<?php

namespace HDNET\OnpageIntegration\Controller;

use HDNET\OnpageIntegration\Service\DataService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class BackendController extends ActionController
{

    /**
     * Represent the index page
     */
    public function indexAction()
    {
        $dataService = GeneralUtility::makeInstance(DataService::class);
        $seoAspects = $dataService->getApiResult('zoom_lastcrawl');
        DebuggerUtility::var_dump($seoAspects);

        $this->view->assignMultiple([
            'lastCrawl'        => $latestCrawl,
            'seoAspects'       => $seoAspects,
            'contentAspects'   => $contentAspects,
            'technicalAspects' => $technicalAspects,
        ]);
    }

    public function detailAction($detailId)
    {
        $dataService = GeneralUtility::makeInstance(DataService::class);
        $graph = $dataService->getApiResult($detailId . '_graph');
        $table = $dataService->getApiResult($detailId . '_table');

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

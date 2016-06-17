<?php

namespace HDNET\OnpageIntegration\Controller;

use HDNET\OnpageIntegration\Service\DataService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use HDNET\OnpageIntegration\Provider\MetaDataProvider;

class BackendController extends ActionController
{
    /**
     * @var \HDNET\OnpageIntegration\Loader\ApiResultLoader
     * @inject
     */
    protected $loader;

    /**
     * Represent the index page
     */
    public function indexAction()
    {/** @var MetaDataProvider $meta */
        $meta = GeneralUtility::makeInstance(MetaDataProvider::class);
        $data = $meta->getMetaData('seoaspects');




        $dataService = GeneralUtility::makeInstance(DataService::class);
        $latestCrawl = $dataService->getApiResult('zoom_lastcrawl');

        $seoAspects = $dataService->getApiResult('zoom_seoaspects');
        $result = $this->loader->load('zoom_seoaspects_0_graph');
        $this->view->assignMultiple([
            'lastCrawl'        => $latestCrawl,
            'seoAspects'       => $seoAspects,
            'contentAspects'   => $contentAspects,
            'technicalAspects' => $technicalAspects,
        ]);
    }

    /**
     * @param $detailId
     *
     * @throws \HDNET\OnpageIntegration\Exception\ApiErrorException
     */
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
     * @throws \HDNET\OnpageIntegration\Exception\ApiErrorException
     */
    public function keywordAction()
    {
        $dataService = GeneralUtility::makeInstance(DataService::class);

        $result = $dataService->getApiResult('zoom_seoaspects_0_graph');
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($result);
    }
}

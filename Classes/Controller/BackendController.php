<?php

namespace HDNET\OnpageIntegration\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use HDNET\OnpageIntegration\Service\ProgressService;

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
    {
        $lastCrawl = $this->loader->load('zoom_lastcrawl');

        $progressService =GeneralUtility::makeInstance(ProgressService::class);
        $progressService->makeProgress($lastCrawl);

        $this->view->assignMultiple([
            'lastCrawl' => $lastCrawl
        ]);
    }

    /**
     * Detail Page
     *
     * @param string $call
     */
    public function SeoAction($call)
    {
        $apiCallString = 'zoom_' . $call .'_table';

        $table = $this->loader->load($apiCallString);
        $this->view->assignMultiple([
            'table' => $table,
        ]);
    }

    /**
     * @param string $call
     */
    public function ContentAction($call)
    {
        $apiCallString = 'zoom_' . $call .'_table';

        $table = $this->loader->load($apiCallString);
        $this->view->assignMultiple([
            'table' => $table,
        ]);
    }

    /**
     * @param $call
     */
    public function TechnicalAction($call)
    {
        $apiCallString = 'zoom_' . $call . '_table';

        $table = $this->loader->load($apiCallString);
        $this->view->assignMultiple([
            'table' => $table,
        ]);
    }

    /**
     *
     */
    public function keywordAction()
    {
    }
}

<?php

namespace HDNET\OnpageIntegration\Controller;

use HDNET\OnpageIntegration\Provider\MetaDataProvider;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

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
        $metaDataProvider = GeneralUtility::makeInstance(MetaDataProvider::class);

        $this->view->assignMultiple([
            'lastCrawl'         => $this->loader->load('zoom_lastcrawl'),
            'seoMetaData'       => $metaDataProvider->getMetaData('seoaspects'),
            'contentMetaData'   => $metaDataProvider->getMetaData('contentaspects'),
            'technicalMetaData' => $metaDataProvider->getMetaData('technicalaspects'),
            'moduleName'        => 'Zoom Module'
        ]);
    }

    /**
     * Detail Page
     *
     * @param string $call
     */
    public function SeoAction($call)
    {
        $apiCallString = 'zoom_' . $call . '_table';

        $table = $this->loader->load($apiCallString);
        $this->view->assignMultiple([
            'table'      => $table,
            'moduleName' => 'SEO Aspekte'
        ]);
    }

    /**
     * @param string $call
     */
    public function ContentAction($call)
    {
        $apiCallString = 'zoom_' . $call . '_table';

        $table = $this->loader->load($apiCallString);
        $this->view->assignMultiple([
            'table'      => $table,
            'moduleName' => 'Inhaltliche Aspekte'
        ]);
    }

    /**
     * @param string $call
     */
    public function TechnicalAction($call)
    {
        $apiCallString = 'zoom_' . $call . '_table';

        $table = $this->loader->load($apiCallString);
        $this->view->assignMultiple([
            'table'      => $table,
            'moduleName' => 'Technische Aspekte'
        ]);
    }

    /**
     *
     */
    public function keywordAction()
    {
        $this->view->assignMultiple([
            'moduleName' => 'Keyword'
        ]);
    }
}

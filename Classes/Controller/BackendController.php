<?php

/**
 * Class BackendController
 */

namespace HDNET\OnpageIntegration\Controller;

use HDNET\OnpageIntegration\Provider\MetaDataProvider;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Class BackendController
 */
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
     * Handle the detail pages
     *
     * @param $section
     * @param $call
     */
    public function detailAction($section, $call)
    {
        $apiCallString = 'zoom_' . $section . '_' . $call . '_table';
        $table = $this->loader->load($apiCallString);

        $layout = ucfirst(str_replace('aspects', '', $section));

        $this->view->assignMultiple([
            'table'      => $table,
            'layout'     => $layout
        ]);
    }

    /**
     * Empty Keyword Page
     */
    public function keywordAction()
    {
        $this->view->assignMultiple([
            'moduleName' => 'Keyword'
        ]);
    }
}

<?php

/**
 * Class BackendController
 */

namespace HDNET\OnpageIntegration\Controller;

use HDNET\OnpageIntegration\Exception\UnavailableAccessDataException;
use HDNET\OnpageIntegration\Utility\TitleUtility;
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
     * @var \HDNET\OnpageIntegration\Provider\MetaDataProvider
     * @inject
     */
    protected $metaDataProvider;

    /**
     * @var \HDNET\OnpageIntegration\Domain\Repository\ConfigurationRepository
     * @inject
     */
    protected $configurationRepository;

    /**
     * @var \HDNET\OnpageIntegration\Service\OnPageService
     * @inject
     */
    protected $onpPageService;

    /**
     * Load all filter options and show them on the index page
     */
    public function indexAction()
    {
        try {
            $this->view->assignMultiple([
                'lastCrawl'         => $this->loader->load('zoom_lastcrawl'),
                'seoMetaData'       => $this->metaDataProvider->getMetaData('seoaspects'),
                'contentMetaData'   => $this->metaDataProvider->getMetaData('contentaspects'),
                'technicalMetaData' => $this->metaDataProvider->getMetaData('technicalaspects'),
                'moduleName'        => 'Zoom Module'
            ]);
        } catch (UnavailableAccessDataException $e) {
            return "Bitte tragen Sie Ihre Zugangsdaten ein.";
        }
    }

    /**
     * Show the details of an api call
     *
     * @param string $section
     * @param string $call
     */
    public function detailAction($section, $call)
    {
        $metaDataResult = $this->metaDataProvider->getMetaData($section);

        $showTableKey = $metaDataResult[$call]['show'];
        // todo fix
        if (!$showTableKey) {
            $showTableKey = [];
        }

        $apiCallTable = 'zoom_' . $section . '_' . $call . '_table';
        $this->view->assignMultiple([
            'moduleName' => TitleUtility::makeSubTitle($section),
            'table'      => $this->onpPageService->showColumns($apiCallTable, $showTableKey),
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

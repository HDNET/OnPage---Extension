<?php

/**
 * Class BackendController
 */

namespace HDNET\OnpageIntegration\Controller;

use HDNET\OnpageIntegration\Domain\Repository\ConfigurationRepository;
use HDNET\OnpageIntegration\Utility\TitleUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use HDNET\OnpageIntegration\Provider\MetaDataProvider;
use HDNET\OnpageIntegration\Utility\ArrayUtility;
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
        $seoMetaData[] = $metaDataProvider->getMetaData('seoaspects');
        $contentMetaData[] = $metaDataProvider->getMetaData('contentaspects');
        $technicalMetaData[] = $metaDataProvider->getMetaData('technicalaspects');

        ArrayUtility::buildIndexActionArray($seoMetaData, 'seoaspects');
        ArrayUtility::buildIndexActionArray($technicalMetaData, 'technicalaspects');


        $this->view->assignMultiple([
            'lastCrawl'         => $this->loader->load('zoom_lastcrawl'),
            'seoMetaData'       => $seoMetaData,
            'contentMetaData'   => $contentMetaData,
            'technicalMetaData' => $technicalMetaData,
            'moduleName'        => 'Zoom Module'
        ]);
    }

    /**
     * Handle the detail pages
     *
     * @param string $section
     * @param string $call
     */
    public function detailAction($section, $call)
    {
        $objectManager = new ObjectManager();
        $configurationRepository = $objectManager->get(ConfigurationRepository::class);

        /** @var \HDNET\OnpageIntegration\Domain\Model\Configuration $configuration */
        $configuration = $configurationRepository->findByUid(1);


        $apiCallTable = 'zoom_' . $section . '_' . $call . '_table';
        $apiCallGraph = 'zoom_' . $section . '_' . $call . '_graph';

        $this->view->assignMultiple([
            'moduleName' => TitleUtility::makeSubTitle($section),
            'configuration' => $configuration,
            'table'  => $this->loader->load($apiCallTable),
            'graph'  => $this->loader->load($apiCallGraph),
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

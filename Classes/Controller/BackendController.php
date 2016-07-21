<?php

/**
 * Class BackendController
 */

namespace HDNET\OnpageIntegration\Controller;

use HDNET\OnpageIntegration\Exception\UnavailableAccessDataException;
use HDNET\OnpageIntegration\Utility\ArrayUtility;
use HDNET\OnpageIntegration\Utility\TitleUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

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
     * Represent the index page
     */
    public function indexAction()
    {
        try {
            $seoMetaData[] = $this->metaDataProvider->getMetaData('seoaspects');
            $contentMetaData[] = $this->metaDataProvider->getMetaData('contentaspects');
            $technicalMetaData[] = $this->metaDataProvider->getMetaData('technicalaspects');

            ArrayUtility::buildIndexActionArray($seoMetaData, 'seoaspects');
            ArrayUtility::buildIndexActionArray($technicalMetaData, 'technicalaspects');
            ArrayUtility::buildIndexActionArray($contentMetaData, 'contentaspects');


            $this->view->assignMultiple([
                'lastCrawl'         => $this->loader->load('zoom_lastcrawl'),
                'seoMetaData'       => $seoMetaData,
                'contentMetaData'   => $contentMetaData,
                'technicalMetaData' => $technicalMetaData,
                'moduleName'        => 'Zoom Module'
            ]);

        } catch (UnavailableAccessDataException $e) {
            return "Bitte tragen Sie Ihre Zugangsdaten ein.";
        }
    }

        /**
         * Handle the detail pages
         *
         * @param string $section
         * @param string $call
         */
        public function detailAction($section, $call)
        {
            /** @var \HDNET\OnpageIntegration\Domain\Model\Configuration $configuration */
            $configuration = $this->configurationRepository->findRecord(1);

            $metaDataProvider = $this->metaDataProvider->getMetaData($section);

            $showTableKey = $metaDataProvider[$call]['show'];
            $apiCallTable = 'zoom_' . $section . '_' . $call . '_table';

            $table = $this->loader->load($apiCallTable);
            #$table = ArrayUtility::showTable($this->loader->load($apiCallTable), $showTableKey);

            $this->view->assignMultiple([
                'moduleName'    => TitleUtility::makeSubTitle($section),
                'configuration' => $configuration,
                'table'         => $table,
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

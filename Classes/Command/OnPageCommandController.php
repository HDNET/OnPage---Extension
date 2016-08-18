<?php

/**
 * Class OnPageCommandController
 */

namespace HDNET\OnpageIntegration\Command;

use HDNET\OnpageIntegration\Persister\ApiResultToCachePersister;
use HDNET\OnpageIntegration\Service\DataService;
use TYPO3\CMS\Extbase\Mvc\Controller\CommandController;

/**
 * Class OnPageCommandController
 */
class OnPageCommandController extends CommandController
{

    /**
     * @var DataService
     */
    protected $dataService;

    /**
     * @var ApiResultToCachePersister
     */
    protected $persister;

    /**
     * OnPageCommandController constructor.
     *
     * @param DataService               $dataService
     * @param ApiResultToCachePersister $persister
     */
    public function __construct(DataService $dataService, ApiResultToCachePersister $persister)
    {
        $this->dataService = $dataService;
        $this->persister = $persister;
    }

    /**
     * Fill the caches
     */
    public function fillCacheCommand()
    {
        $results = $this->dataService->getAllResults();

        foreach ($results as $key => $result) {
            $this->persister->persist($result, $key);
        }
    }
}

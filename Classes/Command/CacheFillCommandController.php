<?php

/**
 * Class CacheFillCommandController
 */

namespace HDNET\OnpageIntegration\Command;

use TYPO3\CMS\Extbase\Mvc\Controller\CommandController;

/**
 * Class CacheFillCommandController
 */
class CacheFillCommandController extends CommandController
{

    /**
     * @var \HDNET\OnpageIntegration\Service\DataService
     * @inject
     */
    protected $dataService;

    /**
     * @var \HDNET\OnpageIntegration\Persister\ApiResultToCachePersister
     * @inject
     */
    protected $persister;

    public function fillCacheCommand()
    {
        $results = $this->dataService->getAllResults();

        foreach ($results as $key => $result) {
            $this->persister->persist($result, $key);
        }
    }
}

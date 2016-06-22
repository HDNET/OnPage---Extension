<?php

namespace HDNET\OnpageIntegration\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\CommandController;

/**
 * Class CacheFillController
 * @todo falscher ORT. Command-Ordner
 * @todo Registrierung ändern (ggf. über autoloader)
 */
class CacheFillController extends CommandController
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

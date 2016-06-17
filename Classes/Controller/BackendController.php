<?php

namespace HDNET\OnpageIntegration\Controller;

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
    }

    /**
     * Detail Page
     *
     * @param string $call
     */
    public function detailSeoAction($call)
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
    public function detailContentAction($call)
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
    public function detailTechnicalAction($call)
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

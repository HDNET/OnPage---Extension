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

    public function indexAction()
    {
        $result = $this->loader->load('zoom_seoaspects_0_graph');
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($result);
    }

}

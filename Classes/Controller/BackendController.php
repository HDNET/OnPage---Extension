<?php

namespace HDNET\OnpageIntegration\Controller;

use HDNET\OnpageIntegration\Provider\Configuration;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class BackendController extends ActionController
{

    public function indexAction()
    {
        $conf = GeneralUtility::makeInstance(Configuration::class);
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($conf->buildAuthentication());
    }
}

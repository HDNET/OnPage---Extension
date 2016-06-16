<?php
/**
 *
 */

namespace HDNET\OnpageIntegration\Provider;

use HDNET\Hdnet\Configuration;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use HDNET\OnpageIntegration\Domain\Repository\ConfigurationRepository;

class Authentication extends AbstractProvider
{

    /**
     * configurationRepository
     *
     * @var \HDNET\OnpageIntegration\Domain\Repository\ConfigurationRepository
     * @inject
     */
    protected $configurationRepository;

    /**
     * Build the authentication index for an api call
     *
     * @return array
     */
    public function get()
    {
        $this->configurationRepository = GeneralUtility::makeInstance(ConfigurationRepository::class);
        /** @var \HDNET\OnpageIntegration\Domain\Model\Configuration $configuration */
        $configuration = $this->configurationRepository->findByUid(1);

        $buildAuth = [

            'api_key'    => $configuration->getApiKey(),
            'project_id' => $configuration->getProjectId(),

        ];

        return $buildAuth;
    }
}

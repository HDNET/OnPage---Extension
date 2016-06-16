<?php
/**
 *
 */

namespace HDNET\OnpageIntegration\Provider;

use HDNET\OnpageIntegration\Domain\Repository\ConfigurationRepository;
use TYPO3\CMS\Extbase\Object\ObjectManager;

class Authentication extends AbstractProvider
{

    /**
     * Build the authentication index for an api call
     *
     * @return array
     */
    public function get()
    {
        $objectManager = new ObjectManager();
        $configurationRepository = $objectManager->get(ConfigurationRepository::class);

        /** @var \HDNET\OnpageIntegration\Domain\Model\Configuration $configuration */
        $configuration = $configurationRepository->findByUid(1);

        $buildAuth = [

            'api_key'    => $configuration->getApiKey(),
            'project' => $configuration->getProjectId(),

        ];

        return $buildAuth;
    }
}

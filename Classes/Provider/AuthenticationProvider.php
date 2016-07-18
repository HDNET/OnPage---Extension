<?php

/**
 * Class AuthenticationProvider
 */

namespace HDNET\OnpageIntegration\Provider;

use HDNET\OnpageIntegration\Domain\Repository\ConfigurationRepository;
use HDNET\OnpageIntegration\Exception\UnavailableAccessDataException;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * Class AuthenticationProvider
 */
class AuthenticationProvider extends AbstractProvider
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
        $configuration = $configurationRepository->findRecord(1);

        if (!$configuration) {
            throw new UnavailableAccessDataException;
        }

        $buildAuth = [
            'api_key' => $configuration->getApiKey(),
            'project' => $configuration->getProjectId(),
        ];

        return $buildAuth;
    }
}

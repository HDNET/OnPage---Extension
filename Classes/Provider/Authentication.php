<?php
/**
 *
 */

namespace HDNET\OnpageIntegration\Provider;

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
    public function buildAuthenticationArray()
    {
        /** @var \HDNET\OnpageIntegration\Domain\Model\Configuration $configuration */
        $configuration = $this->configurationRepository->findByUid(1);

        $buildAuth = [

            'api_key'    => $configuration->getApiKey(),
            'project_id' => $configuration->getProjectId(),

        ];

        return $buildAuth;
    }
}

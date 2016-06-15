<?php

/**
 * File ApiKey
 */

namespace  HDNET\OnpageIntegration\Domain\Model;

/**
 * Class ApiKey
 *
 * @db
 */
class Configuration extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * api_key
     *
     * @db
     * @var string
     */
    protected $apiKey;

    /**
     * project_id
     *
     * @db
     * @var string
     */
    protected $projectId;

    /**
     * Returns the project id
     *
     * @return string
     */
    public function getProjectId()
    {
        return $this->projectId;
    }

    /**
     * Sets the projects id
     *
     * @param string $projectId
     */
    public function setProjectId($projectId)
    {
        $this->projectId = $projectId;
    }

    /**
     * Returns the api key
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * Sets the api key
     *
     * @param string $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }
}

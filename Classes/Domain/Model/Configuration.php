<?php

/**
 * File ApiKey
 */

namespace HDNET\OnpageIntegration\Domain\Model;

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class ApiKey
 *
 * @db
 */
class Configuration extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    // @todo hide fields hier eintragen
    const DEFAULT_HIDE_FIELDS = 'is_local,
                                 passes_juice_to_url,
                                 is_indexable,
                                 mime,
                                 header_status,
                                 country,
                                 mime_error,
                                 hash,
                                 language,
                                 redirect_category,
                                 redirect_to_mime_error,
                                 redirect_type_group,
                                 redirect_to_hash,
                                 redirect_to_mime,
                                 redirect_to_language,
                                 redirect_to_is_local,
                                 redirect_to_header_status,
                                 redirect_to_country,
                                 twitter_description,
                                 twitter_title,
                                 twitter_image,
                                 og_country,
                                 og_language,
                                 og_image,
                                 meta_title,
                                 meta_description,
                                 og_url,
                                 og_title,
                                 og_description,
                                 compression_type,';

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
     * @var string
     * @db
     */
    protected $hideFields;

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

    /**
     * @return string
     */
    public function getHideFields()
    {
        return $this->hideFields;
    }

    /**
     * @return array
     */
    public function getHideFieldsAsArray()
    {
        return GeneralUtility::trimExplode("\n", $this->getHideFields(), true);
    }

    /**
     * @param string $hideFields
     */
    public function setHideFields($hideFields)
    {
        $this->hideFields = $hideFields;
    }

}

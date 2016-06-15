<?php

/**
 * Class Configuration
 */

namespace HDNET\OnpageIntegration\Provider;

/**
 * Class Configuration
 */
class Configuration
{

    /**
     * build for testing
     */
    public function buildJson()
    {
        $json = [
            'action'         => 'list',
            'authentication' => [
                'api_key' => '5075a56ab20757eb73cc032ccf00443b',
                'project' => 'www.cts-reisen.de',
            ],
            'pagination'     => [
                'limit'  => 1000,
                'offset' => 0,
            ],
            'group'          => [
                0 => 'inventory_group',
            ],
            'sorting'        => [
                0 => [
                    'attribute' => 'count',
                    'direction' => 'DESC',
                ],
            ],
            'functions'      => [
                0 => [
                    'name'       => 'count',
                    'method'     => 'count',
                    'parameters' => [
                        0 => [
                            'attribute' => 'url',
                        ],
                    ],
                ],
            ],
        ];
    }
}

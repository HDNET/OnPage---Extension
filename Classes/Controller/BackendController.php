<?php

namespace HDNET\Onpage\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class BackendController extends ActionController
{

    public function indexAction()
    {
        /**********************************************************************
         *    CURL-less Example to get Status Code Data from OnPage.org Zoom API
         **********************************************************************/

        /***
         *    OnPage.org API Endpoint and Zoom Route
         ***/

        $apiEndpoint = 'https://api.onpage.org';
        $zoomRoute = '/zoom/json';

        $requestUrl = $apiEndpoint . $zoomRoute;


        /***
         *    JSON Request copied from OnPage.org Zoom Interface
         *    This example will retrieve the Status Code Overview of the project
         *    (Number of 2xx, 3xx,301,302,4xx,5xx)
         *    Tipp: Use the Zoom Interface to "click + play" the data you need, afterwards copy the API call and insert it here.
         ***/

        $postBody = '{
    "action": "aggregate",
    "authentication": {
    },
    "pagination": {
        "limit": 100,
        "offset": 0
    },
    "group": [
        "indexability_group"
    ],
    "functions": [
        {
            "name": "count",
            "method": "count",
            "parameters": [
                {
                    "attribute": "url"
                }
            ]
        }
    ],
    "filter": {
        "AND": [
            {
                "field": "is_local",
                "operator": "==",
                "value": true
            }
        ]
    }
}';

        $options = array(
            'http' => array(
                'header'  => 'Content-Type: text/json',
                'method'  => 'POST',
                'content' => $postBody,
            ),
        );

        $context = stream_context_create($options);

        $result = file_get_contents($requestUrl, false, $context);

        /***
         * Handle HTTP error
         ***/

        if ($result === false) {

            echo "Something went wrong";

        } else {

            /***
             * Print Result
             ***/

            echo "Result:\n";
            $jsonResult = json_decode($result, true);
            echo "<pre>";
            print_r($jsonResult);
            echo "</pre>";

        }
    }
}

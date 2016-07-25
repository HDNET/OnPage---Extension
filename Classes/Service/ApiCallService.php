<?php
/**
 * Class ApiCallService
 */

namespace HDNET\OnpageIntegration\Service;

use HDNET\OnpageIntegration\Exception\UnavailableException;

/**
 * Class ApiCallService
 */
class ApiCallService
{

    private $url = 'https://api.onpage.org/zoom/json';

    /**
     * Start the api call
     *
     * @param string $json
     *
     * @return string
     */
    public function makeCall($json)
    {
        try {
            $this->checkForCurl();

            return $this->send($json);
        } catch (UnavailableException $e) {

        }
    }

    /**
     * Check if curl is loaded
     *
     * @throws \Exception
     */
    protected function checkForCurl()
    {
        if (!extension_loaded('curl')) {
            throw new \Exception('The curl extension needs to be enabled.');
        }
    }

    /**
     * Send the api request
     *
     * @param string $data
     *
     * @return string
     * @throws UnavailableException
     */
    protected function send($data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            ));
        $return = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($code >= 500) {
            throw new UnavailableException('The API could not be reached.');
        }
        if ($code >= 400) {
            throw new UnavailableException('There has been an error reaching the API.');
        }

        return $return;
    }
}

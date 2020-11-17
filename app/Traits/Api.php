<?php

namespace App\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

trait Api {

    public $client = null;

    public static function __init_request_api($param = array()) { //$url, $method = 'GET', $token = null) {
        if (is_array($param)) {
            $url = $param['uri'];
            $method = $param['method'];

            $client = new Client();
            try {
                $options = [
                    'setEncodingType' => false,
                    'verify' => false
                ];
                if (isset($param['header']['token']) && !empty($param['header']['token'])) {
                    $headers = ['headers' => ['token' => $param['header']['token']]];
                    $options = array_merge($options, $headers);
                }
                if (isset($param['body']) && !empty($param['body'])) {
                    $body = ['body' => \GuzzleHttp\json_encode($param['body'])];
                    $options = array_merge($options, $body);
                }
                $response = $client->request($method, $url, $options);
                $results = json_decode($response->getBody());
            } catch (RequestException $e) {
                $results['data'] = [];
                $results['status']['code'] = $e->getResponse()->getStatusCode();
                $results['status']['message_server'] = $e->getResponse()->getReasonPhrase();
                $results['status']['message_client'] = $e->getResponse()->getReasonPhrase();
                $results = json_decode(json_encode($results, JSON_HEX_QUOT | JSON_HEX_TAG));
            }

            return $results;
        }
    }

}

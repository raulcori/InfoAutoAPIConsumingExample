<?php

namespace backend\models\infoauto\api;
use common\utils\CurlUtil;
use backend\models\Parameter;

/**
 * Description of ApiIA
 *
 * @author RAUL CORIMAYO
 */
class ApiIA 
{
    const TEST_MODE = true;
    const BASE_URL_TEST = 'https://demo.api.infoauto.com.ar/cars/';
    const BASE_URL_PROD = 'https://demo.api.infoauto.com.ar/cars/';
    const PARAM_TOKEN = 'ia.token';
    const PARAM_TOKEN_TIME = 'ia.token.time';
    const TOKEN_EXPIRATION_TIME = 60*60;
    public $username;
    public $password;
    
    
    public function __construct($username, $password) 
    {
        $this->username = $username;
        $this->password = $password;
    }
    
    
    public function call(BaseEndpointIA $endpoint)
    {
        $method = $endpoint->getMethod();
        $uri = $endpoint->getUri();
        $requestBody = $endpoint->getRequestBody();
        $requestBodyJson = json_encode($requestBody);
        $url = $this->getBaseURL() . $uri;
        $response = null;
        $headers = $this->getHeaders($endpoint);
        if($method == 'GET'){
            $url = $url . $this->getURLFormat($requestBody);
            $response = CurlUtil::get($headers, $url);
        } else if ($method == 'PUT') {
            $response = CurlUtil::put($headers, $url, $requestBodyJson);
        } else if ($method == 'POST') {
            $response = CurlUtil::post($headers, $url, $requestBodyJson); 
        }
        if ($response) {
            $response = json_decode(json_encode($response), true);
        } else {
            $response = array();
        }
        if (isset($response['code'])) {
            if ($response['code'] == 404) {
                $response = array();
            }
        }
        return $endpoint->getResponseBody($response);
    }
    
    private function getBaseUrl()
    {
        if (self::TEST_MODE) {
            return self::BASE_URL_TEST;
        }
        return self::BASE_URL_PROD;
    }
    
    private function getHeaders(BaseEndpointIA $endpoint)
    {
        if ($endpoint instanceof Login) {
            $username = $this->username;
            $password = $this->password;
            return array(
                "Content-Length: 0",
                "Content-type: application/json",
                "Authorization: Basic " . base64_encode($username . ":" . $password)
            );
        }
        $token = $this->getToken();
        $headers = array();
        $method = $endpoint->getMethod();
        
        if ($method == 'GET') {
            $headers[] = "Content-type: application/json";
            $headers[] = "Authorization: Bearer " . $token;
        } else if ($method == 'PUT') {
            $headers[] = 'Content-Type: application/json';
            $headers[] = "Authorization: Bearer " . $token;
        } else if ($method == 'POST') {
            $headers[] = 'Content-Type: application/json';
            $headers[] = "Authorization: Bearer " . $token;
        }
        return $headers;
    }
    
    private function getURLFormat(array $requestBody)
    {
        $urlParams = '';
        $nexus = '?';
        foreach ($requestBody as $key => $value) {
            $urlParams .= $nexus.$key.'='.$value;
            $nexus = '&';
        }
        return $urlParams;
    }
    
    private function getToken()
    {
        $token = $this->getCurrentToken();
        if ($this->isActive($token)) {
            return $token;
        }
        $newToken = $this->getNewToken();
        Parameter::saveValue(self::PARAM_TOKEN, $newToken);
        Parameter::saveValue(self::PARAM_TOKEN_TIME, date('Y-m-d H:i:s'));
        return $newToken;
    }
    
    private function getNewToken()
    {
        $endpoint = new Login($this);
        $response = $endpoint->call();
        return $response['access_token'];
    }
    
    private function getCurrentToken()
    {
        return Parameter::getValueByName(self::PARAM_TOKEN);
    }
    
    private function isActive($token)
    {
        if ($token == null) {
            return false;
        }
        $time = Parameter::getValueByName(self::PARAM_TOKEN_TIME);
        $now = date('Y-m-d H:i:s');
        $seconds_diff = strtotime($now) - strtotime($time);
        return $seconds_diff < self::TOKEN_EXPIRATION_TIME;
    }
}

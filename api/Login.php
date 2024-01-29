<?php

namespace backend\models\infoauto\api;

/**
 * Description of Login
 *
 * @author RAUL CORIMAYO
 */
class Login extends BaseEndpointIA
{
    
    public function getMethod(): string 
    {
        return 'POST';
    }

    public function getRequestBody(): array 
    {
        return array();
    }

    public function getResponseBody(array $response): array 
    {
        if (isset($response['access_token'])) {
            return $response;
        }
        return array();
    }

    public function getUri(): string 
    {
        return 'auth/login';
    }

}

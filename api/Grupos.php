<?php

namespace backend\models\infoauto\api;

/**
 * Description of Grupos
 *
 * @author RAUL CORIMAYO
 */
class Grupos extends BaseEndpointIA
{
    
    public $marca = 0;
    
    
    public function __construct($api, $marca) 
    {
        parent::__construct($api);
        $this->marca = $marca;
    }
    
    
    public function getMethod(): string 
    {
        return 'GET';
    }

    public function getRequestBody(): array 
    {
        return array(
            'query_mode' => 'matching', 
            'page' => 1,//just for testing
            'page_size' => 10,//just for testing
        );
    }

    public function getResponseBody(array $response): array 
    {
        
        return $response;
    }

    public function getUri(): string 
    {
        if (intval($this->marca)) {
            $marca = $this->marca;
            return "pub/brands/$marca/groups/";
        }
    }

}
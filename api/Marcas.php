<?php

namespace backend\models\infoauto\api;

/**
 * Description of IAMarcas
 *
 * @author RAUL CORIMAYO
 */
class Marcas extends BaseEndpointIA
{
    
    public $term;
    
    
    public function __construct($api, $term) 
    {
        parent::__construct($api);
        $this->term = $term;
    }
    
    
    public function getMethod(): string 
    {
        return 'GET';
    }

    public function getRequestBody(): array 
    {
        // TODO: Parametrize page and page_size
        return array(
            'query_string'=> $this->term, 
            'query_mode' => 'matching', 
            'page' => 1,
            'page_size' => 10,
        );
    }

    public function getResponseBody(array $response): array 
    {
        return $response;
    }

    public function getUri(): string 
    {
        return 'pub/brands/';
    }

}

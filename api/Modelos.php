<?php

namespace backend\models\infoauto\api;

/**
 * Description of Modelos
 *
 * @author RAUL CORIMAYO
 */
class Modelos extends BaseEndpointIA
{
    
    
    public $marca = null;
    public $grupo = null;
    
    
    public function __construct($api, $marca, $grupo) 
    {
        parent::__construct($api);
        $this->marca = $marca;
        $this->grupo = $grupo;
    }
    
    
    public function getMethod(): string 
    {
        return 'GET';// TODO: Use enum/const 
    }

    public function getRequestBody(): array 
    {
        // TODO: Parametrize page and page_size variables
        return array(
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
        if(intval($this->marca) && intval($this->grupo)){
            $marca = $this->marca;
            $grupo = $this->grupo;
            return "pub/brands/$marca/groups/$grupo/models/";
        }
    }

}
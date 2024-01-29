<?php

namespace backend\models\infoauto\api;

/**
 * Description of Modelo
 *
 * @author RAUL CORIMAYO
 */
class Modelo extends BaseEndpointIA
{
    
    
    public $codia = null;
    
    
    public function __construct($api, $codia) 
    {
        parent::__construct($api);
        $this->codia = $codia;
    }
            
    
    public function getMethod(): string 
    {
        return 'GET';
    }

    public function getRequestBody(): array 
    {
        return array();
    }

    public function getResponseBody(array $response): array 
    {
        return $response;
    }

    public function getUri(): string 
    {
        if (intval($this->codia)) {
            $codia = $this->codia;
            return "pub/models/$codia";// sin la barra al final
        }
    }

}
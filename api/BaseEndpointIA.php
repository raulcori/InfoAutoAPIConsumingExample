<?php

namespace backend\models\infoauto\api;

/**
 * Description of BaseEndpointIA
 * InfoAutos
 * @author RAUL CORIMAYO
 */
abstract class BaseEndpointIA 
{
    
    public $api;//ApiIA.php
    public abstract function getMethod() : string;
    public abstract function getUri() : string;
    public abstract function getRequestBody() : array;
    public abstract function getResponseBody(array $response) : array;
    
    
    public function __construct($api) 
    {
        $this->api = $api;
    }
    
    public function call()
    {
        return $this->api->call($this);
    }
}

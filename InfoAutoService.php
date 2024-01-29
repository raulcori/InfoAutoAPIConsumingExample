<?php

namespace backend\models\infoauto;

/**
 * Description of InfoAutoService
 *
 * @author RAUL CORIMAYO
 */
class InfoAutoService implements IInfoAutoService 
{
    
    
    private $api;
    
    
    public function __construct($username, $password) 
    {
        $this->api = new api\ApiIA($username, $password);
    }
    

    public function marcas($search) 
    {
        $endpoint = new api\Marcas($this->api, $search);
        return $this->api->call($endpoint);
    }
    
    public function grupos($marca) 
    {
        $endpoint = new api\Grupos($this->api, $marca);
        return $this->api->call($endpoint);
    }

    public function modelos($marca, $grupo) 
    {
        $endpoint = new api\Modelos($this->api, $marca, $grupo);
        return $this->api->call($endpoint);
    }
    
    public function modelo($codia) 
    {
        $endpoint = new api\Modelo($this->api, $codia);
        return $this->api->call($endpoint);
    }

    public function precio($codia) 
    {
        $endpoint = new api\Precio($this->api, $codia);
        return $this->api->call($endpoint);
    }

    public function precios($codia) 
    {
        $endpoint = new api\Precios($this->api, $codia);
        return $this->api->call($endpoint);
    }

}

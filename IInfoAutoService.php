<?php

namespace backend\models\infoauto;

/**
 * Description of IInfoAutoService
 * Define the interaction with Infoauto
 * @author RAUL CORIMAYO
 */
interface IInfoAutoService 
{
    /**
     * 
     */
    public function marcas($search);
    
    /**
     * 
     */
    public function grupos($marca);
    
    /**
     * 
     */
    public function modelos($marca, $grupo);
    
    /**
     * 
     */
    public function modelo($codia);
    
    /**
     * 
     */
    public function precio($codia);
    
    /**
     * 
     */
    public function precios($codia);
    
}

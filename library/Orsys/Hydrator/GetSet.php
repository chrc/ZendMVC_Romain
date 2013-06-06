<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GetSet
 *
 * @author Administrateur
 */
class Orsys_Hydrator_GetSet implements Orsys_Hydrator_HydratorInterface
{
    
    public function populate($obj, $array)
    {
        if(!is_array($array) && !($array instanceof ArrayAccess))
        {
            throw new Exception("Can only populate arrays and type ArrayAccess");
        }
        foreach($array as $key => $value)
        {
            $setter = 'set' . ucfirst($key);
            if(method_exists($obj, $setter))
            {
                $obj->$setter($value);
            }
        }
    }

    public function toArray($obj) {
        
    }    
}
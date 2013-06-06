<?php


class Zend_View_Helper_Nombre extends Zend_View_Helper_Abstract
{
    public function nombre($nb)
    {
        $strPair = ($nb % 2 == 1)?'impair':'pair';
        
        return "$nb ($strPair)";
    }
}

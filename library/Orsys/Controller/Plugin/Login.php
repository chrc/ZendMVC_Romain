<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Login
 *
 * @author Administrateur
 */
class Orsys_Controller_Plugin_Login extends Zend_Controller_Plugin_Abstract
{
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        $config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/controllersProtected.ini', 'protected');
        
        $contrRequest = ucfirst($request->getControllerName());
        
        foreach($config->controllers as $contrProtege)
        {
            if($contrProtege == $contrRequest)
            {
                $auth = Zend_Auth::getInstance();
                
                if(!$auth->hasIdentity())
                {
                    $request->setControllerName('login');
                    $request->setActionName('index');
                }
            }
        }
    }

}
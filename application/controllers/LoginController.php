<?php

class LoginController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        if($this->_request->isPost())
        {
            $login = $this->_request->getPost('login');
            $pass = $this->_request->getPost('pass');
            
            $auth = new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter(), 
                                                    'user', 'login', 'pass');
            
            $auth->setIdentity($login)
                 ->setCredential($pass);
            
            if($auth->authenticate()->isValid())
            {
                $storage = Zend_Auth::getInstance()->getStorage();
                
                $storage->write($login);
                
                $this->redirect('/');
            }
            else
            {
                // TODO message d'erreur
            }
        }
    }


}


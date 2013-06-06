<?php

class FormationController extends Zend_Controller_Action
{
    /**
     *
     * @var Zend_Controller_Request_Http 
     */
    protected $_request;

    public function init()
    {
        /* Initialize action controller here */
        $this->view->headTitle('Catalogue formations');
    }

    public function indexAction()
    {
        $this->view->headTitle(' - Liste des formations');
//        $this->view->headLink()->appendStylesheet('/css/style.css');
        
        $mapper = new Application_Model_Mapper_Formation();
        
        $flashMessenger = $this->getHelper('FlashMessenger');
        /* @var $flashMessenger Zend_Controller_Action_Helper_FlashMessenger */
        if($flashMessenger->hasMessages())
        {
            $listMessage = $flashMessenger->getMessages();
            $this->view->message = $listMessage[0];
        }
        
        $this->view->formations = $mapper->getAll();
    }

    public function ajouterAction()
    {
        $form = new Application_Form_Formation();
        
        if($this->_request->isPost())
        {
            $data = $this->_request->getPost();
            
            if($form->isValid($data))
            {
                $formation = new Application_Model_Formation();
                
                $hydrator = new Orsys_Hydrator_GetSet();
                $hydrator->populate($formation, $form->getValues());
                
                $mapper = new Application_Model_Mapper_Formation();
                
                $mapper->add($formation);
                
                $flashMessenger = $this->getHelper('FlashMessenger');
                /* @var $flashMessenger Zend_Controller_Action_Helper_FlashMessenger */
                $flashMessenger->addMessage("La formation a bien été insérée");
                
                $redirector = $this->getHelper('Redirector');
                /* @var $redirector Zend_Controller_Action_Helper_Redirector */
                $redirector->gotoRouteAndExit(array('action' => 'index'), 'default');
            }
        }
        
        
        $this->view->form = $form;
    }

    public function modifierAction()
    {
        $form = new Application_Form_Formation();
        
        if($this->_request->isPost())
        {
            $id = (int) $this->getParam('id');
        
            if(!$id) {
                throw new Zend_Controller_Router_Exception(
                        "L'id n'est pas présent ou pas numérique", 404);
            }
                
            $data = $this->_request->getPost();
            
            // retirer le validator Db_NoRecordExists
            $form->getElement('nom')->removeValidator('Db_NoRecordExists');
            
            if($form->isValid($data))
            {
                $formation = new Application_Model_Formation();
                $hydrator = new Orsys_Hydrator_GetSet();
                $hydrator->populate($formation, $form->getValues());
                $formation->setId($id);
                
                $mapper = new Application_Model_Mapper_Formation();
                
                if($mapper->modify($formation))
                {
                    $flashMessenger = $this->getHelper('FlashMessenger');
                    /* @var $flashMessenger Zend_Controller_Action_Helper_FlashMessenger */
                    $flashMessenger->addMessage("La formation a bien été modifié");
                }
                
                $redirector = $this->getHelper('Redirector');
                /* @var $redirector Zend_Controller_Action_Helper_Redirector */
                $redirector->gotoRouteAndExit(array('controller' => 'formation'), 'default', true);
            }
        }
        else
        {
            $this->detailsAction();
            $formation = $this->view->formation;
            
            $form->populate(array(
                'nom' => $formation->getNom(),
                'prix' => $formation->getPrix()
            ));
        }
        
        $this->view->form = $form;
    }

    public function supprimerAction()
    {
        if($this->_request->isPost())
        {
            if($this->_request->getPost('confirm') == 'Oui')
            {
                $id = (int) $this->getParam('id');
        
                if(!$id) {
                    throw new Zend_Controller_Router_Exception(
                            "L'id n'est pas présent ou pas numérique", 404);
                }
                
                $mapper = new Application_Model_Mapper_Formation();
                
                if($mapper->deleteById($id))
                {
                    $flashMessenger = $this->getHelper('FlashMessenger');
                    /* @var $flashMessenger Zend_Controller_Action_Helper_FlashMessenger */
                    $flashMessenger->addMessage("La formation a bien été supprimée");
                }
            }
            
            $redirector = $this->getHelper('Redirector');
            /* @var $redirector Zend_Controller_Action_Helper_Redirector */
            $redirector->gotoRouteAndExit(array('controller' => 'formation'), 'default', true);
        }
        else
        {
            $this->detailsAction();
        }
        
    }

    public function detailsAction()
    {
        $id = (int) $this->getParam('id');
        
        if(!$id) {
            throw new Zend_Controller_Router_Exception(
                    "L'id n'est pas présent ou pas numérique", 404);
        }
        
        $mapper = new Application_Model_Mapper_Formation();
        $formation = $mapper->getById($id);
        
        if(!$formation->getId()) {
            throw new Zend_Controller_Router_Exception(
                    "Cet id n'existe pas", 404);
        }
        
        $this->view->formation = $formation;
    }


}










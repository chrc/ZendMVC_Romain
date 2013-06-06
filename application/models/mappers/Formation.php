<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Formation
 *
 * @author Administrateur
 */
class Application_Model_Mapper_Formation extends Orsys_Model_Mapper_Abstract
{
    
    
    public function getById($id)
    {
        $dbTable = new Application_Model_DbTable_Formation();
        
//        $row = $dbTable->fetchRow(array('id = ?' => $id));
        $row = $dbTable->find($id)->current();
        
        $formation = new Application_Model_Formation();
        $hydrator = new Orsys_Hydrator_GetSet();
        $hydrator->populate($formation, $row);
        
        return $formation;
    }
    
    public function add(Application_Model_Formation $formation)
    {
        $dbTable = new Application_Model_DbTable_Formation();
        $id = $dbTable->insert(array(
            'nom' => $formation->getNom(),
            'prix' => $formation->getPrix()
        ));
        
        $formation->setId($id);
    }
    
    public function deleteById($id)
    {
        $dbTable = new Application_Model_DbTable_Formation();
        
        return $dbTable->delete(array('id = ?' => $id));
    }
    
    public function modify(Application_Model_Formation $formation)
    {
        $dbTable = new Application_Model_DbTable_Formation();
        
        return $dbTable->update(array(
                    'nom' => $formation->getNom(),
                    'prix' => $formation->getPrix()
                ), array('id = ?' => $formation->getId()));
    }
}

<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Abstract
 *
 * @author Administrateur
 */
abstract class Orsys_Model_Mapper_Abstract
{
    /**
     *
     * @var Zend_Db_Table_Abstract 
     */
    protected $dbTable;
    protected $module;
    protected $entity;

    public function __construct() {
        $strClass = get_class($this);
        
        $namespaces = explode('_', $strClass);
        $this->module = $namespaces[0];
        $this->entity = $namespaces[count($namespaces)-1];
        $dbTable = $this->module . '_Model_DbTable_' . $this->entity;
        
        $this->dbTable = new $dbTable();
    }
    
    public function getAll()
    {
        $listEntities = array();
        
        $rowset = $this->dbTable->fetchAll();
        
        foreach ($rowset as $row) {
            $entityClass = $this->module . '_Model_' . $this->entity;
            $entity = new $entityClass();
            
            // Hydrateur
            $hydrator = new Orsys_Hydrator_GetSet();
            $hydrator->populate($entity, $row);
//            $entity->setId($row['id'])
//                      ->setNom($row['nom'])
//                      ->setPrix($row['prix']);
            
            $listEntities[] = $entity;
        }
        
        return $listEntities;
    }
}
<?php

class Application_Model_Formateur extends Personne {
    protected $specialite;
    /**
     *
     * @var Formation 
     */
    private $formation;
    
    public function __construct($prenom = "", $nom = "", $specialite = "") {
        parent::__construct($prenom, $nom);
        $this->specialite = $specialite;
    }
    
    public function getSpecialite() {
        return $this->specialite;
    }

    public function setSpecialite($specialite) {
        $this->specialite = $specialite;
        return $this;
    }
    
    public function getFormation() {
        return $this->formation;
    }

    public function setFormation(Formation $formation) {
        $this->formation = $formation;
        return $this;
    }




}
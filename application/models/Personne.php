<?php


class Application_Model_Personne {
    protected $prenom;
    protected $nom;
    
    public function __construct($prenom = "", $nom = "") {
        $this->prenom = $prenom;
        $this->nom = $nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
        return $this;
    }

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
        return $this;
    }


}


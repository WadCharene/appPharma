<?php

namespace Application\Model;

class Categorie{
    // les attributs de base de la categorie
    private $IdCategorie;
    private $Nom;
   
    private $MedocListe = array ();
    

    



    public function exchangeArray($donnees){
        $this->setIdCategorie((!empty($donnees['IdCategorie']))?$donnees['IdCategorie']:null);
        $this->setNom((!empty($donnees['Nom']))?$donnees['Nom']:null);
    }
    
      public function __construct ($donnees=[]){
        $this->hydrate ($donnees);
    }
    
    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value)
        {
            $method = 'set'.ucfirst($key);
            
            if (method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }
    public function toArray()
    {
        return get_object_vars($this);
    }
    function getIdCategorie() {
        return $this->IdCategorie;
    }

    function getNom() {
        return $this->Nom;
    }

    function setIdCategorie($IdCategorie) {
        $this->IdCategorie = $IdCategorie;
    }

    function setNom($Nom) {
        $this->Nom = $Nom;
    }
   function getMedocListe() {
        return $this->MedocListe;
    }

    function setMedocListe($MedocListe) {
        $this->MedocListe = $MedocListe;
    }

    


}
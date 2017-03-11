<?php

namespace Application\Model;

class Medoc{
    
    
    private $IdMedoc;
    private $Nom;
    private $Type;
    private $Indication;
    private $Fournisseurs;
    private $Notice;
    private $photo;
   
    

    
    
     public function exchangeArray($donnees){

        $this->setNom((!empty($donnees['Nom']))?$donnees['Nom']:null);
        $this->setType((!empty($donnees['Type']))?$donnees['Type']:null);
        $this->setIndication((!empty($donnees['Indication']))?$donnees['Indication']:null);
        $this->setFournisseurs((!empty($donnees['Fournisseurs']))?$donnees['Fournisseurs']:null);
        $this->setNotice((!empty($donnees['Notice']))?$donnees['Notice']:null);
       
        
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
    
    function getIdMedoc() {
        return $this->IdMedoc;
    }

    function getNom() {
        return $this->Nom;
    }

    function getType() {
        return $this->Type;
    }

    function getIndication() {
        return $this->Indication;
    }

    function getFournisseurs() {
        return $this->Fournisseurs;
    }

    function getNotice() {
        return $this->Notice;
    }

    function getPhoto() {
        return $this->photo;
    }

   

    function setIdMedoc($IdMedoc) {
        $this->IdMedoc = $IdMedoc;
    }

    function setNom($Nom) {
        $this->Nom = $Nom;
    }

    function setType($Type) {
        $this->Type = $Type;
    }

    function setIndication($Indication) {
        $this->Indication = $Indication;
    }

    function setFournisseurs($Fournisseurs) {
        $this->Fournisseurs = $Fournisseurs;
    }

    function setNotice($Notice) {
        $this->Notice = $Notice;
    }

    function setPhoto($photo) {
        $this->photo = $photo;
    }

    

    
}
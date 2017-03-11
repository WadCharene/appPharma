<?php

namespace Application\Model;

class Membre{
    
    private $IdMembre;
    private $Nom;
    private $Prenom;
    private $DateDeNaissance;
    private $GroupeSanguin;
    private $Email;
    private $Telephone;
    private $Adresse;
    private $Password;

    
    
    public function exchangeArray($donnees){
        $this->setIdMembre((!empty($donnees['IdMembre']))?$donnees['IdMembre']:null);
        $this->setNom((!empty($donnees['Nom']))?$donnees['Nom']:null);
        $this->setPrenom((!empty($donnees['Prenom']))?$donnees['Prenom']:null);
        $this->setDateDeNaissance((!empty($donnees['DateDeNaissance']))?$donnees['DateDeNaissance']:null);
        $this->setGroupeSanguin((!empty($donnees['GroupeSanguin']))?$donnees['GroupeSanguin']:null);
        $this->setEmail ((!empty ($donnees['Email'])) ? $donnees['Email']:null);
        $this->setTelephone ((!empty ($donnees['Telephone'])) ? $donnees['Telephone']:null);
        $this->setAdresse ((!empty ($donnees['Adresse'])) ? $donnees['Adresse']:null);
        $this->setPassword ((!empty ($donnees['Password'])) ? $donnees['Password']:null);
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
    function getIdMembre() {
        return $this->IdMembre;
    }

    function getNom() {
        return $this->Nom;
    }

    function getPrenom() {
        return $this->Prenom;
    }

    function getDateDeNaissance() {
        return $this->DateDeNaissance;
    }

    function getGroupeSanguin() {
        return $this->GroupeSanguin;
    }

    function setIdMembre($IdMembre) {
        $this->IdMembre = $IdMembre;
    }

    function setNom($Nom) {
        $this->Nom = $Nom;
    }

    function setPrenom($Prenom) {
        $this->Prenom = $Prenom;
    }

    function setDateDeNaissance($DateDeNaissance) {
        $this->DateDeNaissance = $DateDeNaissance;
    }

    function setGroupeSanguin($GroupeSanguin) {
        $this->GroupeSanguin = $GroupeSanguin;
    }

    
    function setEmail($email) {
        $this->Email = $email;
    }
    
    
    function getEmail() {
        return $this->Email;
    }
    
    function setTelephone($telephone) {
        $this->Telephone = $telephone;
    }
      function getTelephone() {
        return $this->Telephone;
    }

  
    function setAdresse($adresse) {
        $this->Adresse = $adresse;
    }
    function getAdresse() {
        return $this->Adresse;
    }
    function setPassword($password) {
        $this->Password = $password;
    }

    function getPassword() {
        return $this->Password;
    }


    
  

 
    
    
}

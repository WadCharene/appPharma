<?php

namespace Application\Model;

class Mbrmmedoc{
    
    private $IdMbrMedeoc;
    private $IdMedoc;
    private $IdMembre;
    private $Posologie;
    

    public function exchangeArray($donnees){
        $this->setIdMbrMedoc((!empty($donnees['IdMbrMedoc']))?$donnees['IdMbrMedoc']:null);
        $this->setIdMedoc((!empty($donnees['IdMedoc']))?$donnees['IdMedoc']:null);
        $this->setIdMembre((!empty($donnees['IdMembre']))?$donnees['IdMembre']:null);
        $this->setPosologie((!empty($donnees['Posologie']))?$donnees['Posologie']:null);
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
    function getIdMbrMedeoc() {
        return $this->IdMbrMedeoc;
    }

    function getIdMedoc() {
        return $this->IdMedoc;
    }

    function getIdMembre() {
        return $this->IdMembre;
    }

    function getPosologie() {
        return $this->Posologie;
    }

    function setIdMbrMedeoc($IdMbrMedeoc) {
        $this->IdMbrMedeoc = $IdMbrMedeoc;
    }

    function setIdMedoc($IdMedoc) {
        $this->IdMedoc = $IdMedoc;
    }

    function setIdMembre($IdMembre) {
        $this->IdMembre = $IdMembre;
    }

    function setPosologie($Posologie) {
        $this->Posologie = $Posologie;
    }


    
    
}
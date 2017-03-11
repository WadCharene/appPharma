<?php

namespace Application\Model;


class MembreTable
{
    private $tableGateway;

    public function __construct($tableGateway)
    {
        $this->tableGateway=$tableGateway;
    }
    
    public function getListeMembres()
    {	
        $result = $this->tableGateway->select();
        return $result;
    }    
    
    public function getMembre($filtres = []) 
    {
        $donnees = $this->tableGateway->select($filtres); 
        $ligne= $donnees->current();
        return $ligne;
    }
    
    public function insertMembre($membre) 
    {
        $membreArray = $membre->toArray();
        $resultat = $this->tableGateway->insert($membreArray);
        return ($resultat);
    }
    
    public function updateMembre($membre) 
    {
        $membreArray = $membre->toArray();
        $idMembre = $membre->getId();
        $resultat = $this->tableGateway->update($membreArray,array('Id'=>$idMembre));
        return ($resultat);
    }
    
    public function deleteMembre($membre) 
    {
        $idMembre = $membre->getId();
        $resultat = $this->tableGateway->delete(array('Id'=>$idMembre));
        return ($resultat);
    }
    
 
}
?>
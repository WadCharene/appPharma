<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway; 

class MedocTable{
    
   
    
    protected $tableGateway; 


    public function __construct(TableGateway $tableGateway){
        $this->tableGateway= $tableGateway;
        
    }
    
    public function obtenirMedoc(){
        return ($this->tableGateway->select());
    }
    
 
    public function obtenirMedocFiltres($filtre){
        return ($this->tableGateway->select($filtre));
    }
    
    public function obtenirMedocFiltresLike($filtre){
        $colonne = $filtre['colonne'];
        $recherche = $filtre['recherche'];
        $resultSet = $this->tableGateway->select(function ($select) use ($colonne, $recherche){
            $select->where->like($colonne, $recherche.'%');
        });
        return $resultSet;
    }
    
    public function searchRegion($text) {
        $resultSet = $this->tableGateway->select(function ($select) use ($text) {
            $select->where->like('name', '%' . $text . '%');
        });
        $rows = array();
        
        foreach ($resultSet as $row){
            $rows[] = $row;
        }
        
        return $rows;
    }
    
    
    public function insertMedoc($medoc){
        
        // transformer en array
        $medocArray= $medoc->toArray();
        $resultat=$this->tableGateway->insert($medocArray);
        return ($resultat);
    }
    
    // Update une ligne dans la BD. Cette fonction reçoit un objet et le transforme dans un array
    // dont la fonction update de TableGateway a besoin
    public function updateMedoc($medocModifie){
        
        // transformer en array
        $medocModifieArray= $medocModifie->toArray();
        // on obtient l'id de l'objet à modifier. Update a besoin de connaitre
        // quelle est la ligne à modifier dans la BD
        $idMedoc=$medocModifie->getIdProduit();
        $resultat=$this->tableGateway->update($medocModifieArray,array('idMedoc'=>$idMedoc));
        return ($resultat);
    }
 
    public function deleteMedoc($medocEffacer){
        
        // on obtient l'id de l'objet à effacer. Delete a besoin de connaitre
        // quelle est la ligne à effacer dans la BD        
        $idMedoc=$medocEffacer->getIdProduit();
        $resultat=$this->tableGateway->delete(array('idMedoc'=>$idMedoc));
        return ($resultat);
    }
    
    
        
}


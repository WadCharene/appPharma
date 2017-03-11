<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;

class CategorieTable{
    
    public $tableGateway; 
    public $medocTableGateway;
    
    public function __construct(TableGateway $tableGateway, $medocTableGateway){
        $this->tableGateway= $tableGateway;
        $this->medocTableGateway=$medocTableGateway;
    }
    public function obtenirCategories(){
        return ($this->tableGateway->select());
    }
    public function obtenirCategorieParId($idCategorie){
        $rsCategorie=$this->tableGateway->select(array('idCategorie'=>$idCategorie));
        return($rsCategorie->current());
     } 
      public function obtenirCategorieParIdAvecMedoc($idCategorie){
       
        $objCategorie=$this->obtenirCategorieParId($idCategorie);
        
        $resultSetMedocParCategorie=$this->medocTableGateway->select(array('idCategorie'=>$objCategorie->getIdCategorie()));
        
        $medocArray = [];
        foreach ($resultSetMedocParCategorie as $objMedoc){
            $medocArray[] = $objMedoc;
        }
        $objCategorie->setMedocListe($medocArray);
        return($objCategorie);
    }
  
    public function obtenirToutesLesCategoriesAvecMedoc(){
            $categoriesSansMedoc=$this->obtenirCategories();
            $categoriesAvecMedoc=array();

            foreach ($categoriesSansMedoc as $categorieSansMedoc){
                $categoriesAvecMedoc[]=$this->obtenirCategorieParIdAvecMedoc($categorieSansMedoc->getIdCategorie());
            }
            return ($categoriesAvecMedoc);
    }
  
}  





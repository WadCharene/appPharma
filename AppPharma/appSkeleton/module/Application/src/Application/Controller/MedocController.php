<?php
namespace Application\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use zend\Application\Model\Medoc;

class MedocController extends AbstractActionController
{   
    public function indexAction()
            
    {
        return new viewModel();
    }
 public function afficherTousLesMedocsAction(){
        $medocsTable = $this->getServiceLocator()->get("MedocTableCRUD");
        $medocs=$medocsTable->obtenirMedoc();
        return new ViewModel(array('tousLesMedocs'=>$medocs));
    }  

    public function afficherMedocsFiltresAction(){
        if (isset($_POST)) {
            $recherche = $_POST['Nom'];
        } else {
            $recherche = "zzzzz";
        }

        $medocsTable= $this->getServiceLocator()->get("MedocTableCRUD");
        $medocsFiltres=$medocsTable->obtenirMedocFiltresLike(['colonne'=>'Nom', 'recherche'=>$recherche]);
        return new ViewModel(array('medocsFiltres'=>$medocsFiltres));
    }
    
    public function updateMedocTestAction() {
        $medocsTable= $this->getServiceLocator()->get("MedocTableCRUD");
    
        
        $unMedoc= $medocsTable->obtenirMedocFiltres(['idMedoc'=>1])->current();
        
        $unMedoc->setNom('viagra');
        
      
        if($medocsTable->updateMedoc($unMedoc)){
            $msg="Update ok";
        }
        else {
            $msg="Probleme update";
        }
        return new ViewModel (['msg'=>$msg]);
        
 
        
    }
    
    public function insertMedocTestAction(){
        $medocsTable= $this->getServiceLocator()->get("MedocTableCRUD");
        $nouveauMedoc= new Medoc(['nom'=>'Dafalgan',
                                  'idCategorie'=>1]); 
        
        // on va obtenir le resultat de l'action et l'envoyer à la vue
        if($medocsTable->insertMedoc($nouveauMedoc)){
            $msg="Insertion ok";
        }
        else {
            $msg="Probleme insertion";
        }
        return new ViewModel (['msg'=>$msg]);
        
        
    }
    
    
    public function deleteMedocTestAction(){
        $medocsTable= $this->getServiceLocator()->get("MedocTableCRUD");
        
        
        // d'abord on obtient (ou on crée) un medoc (ex: ici c'est le "Dafalgan")
        $unMedoc= $medocsTable->obtenirMedocFiltres(['nom'=>'Dafalgan'])->current(); // on obtient le prémier dafalgan
        
        
        var_dump($unMedoc);
        
        if ($medocsTable->deleteMedoc($unMedoc)){
            $msg="Supression ok";
        }
        else {
            $msg="Probleme supression";
        }
        return new ViewModel (['msg'=>$msg]);
        
    }
}
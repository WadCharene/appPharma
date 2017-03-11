<?php


namespace Application\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Forms\FormMembre;
use Application\Forms\FormMedoc;
use Application\Forms\FormRecherche;

class IndexController extends AbstractActionController
{   
    public function indexAction()
            
    {
         $unFormRecherche = new FormRecherche("Rechercher");
        
        return new ViewModel(array('uneRecherche'=>$unFormRecherche));
    }
    public function formMembreAction()
    {
        $unFormMembre = new FormMembre("monFormulaire");
        
        return new ViewModel(array('unForm'=>$unFormMembre));
    }
    public function recevoirDonneesMembreAction()
    {
        $Nom = $this->getRequest()->getPost('nom');
        $Prenom = $this->getRequest()->getPost('prenom');
        $DateDN = $this->getRequest()->getPost('date de naissance');
        return new ViewModel(array('nom'=>$Nom,'prenom'=>$Prenom, 'date de naissance'=>$DateDN));
        
    }
    
//    public function formRechercheAction()
//    {
//        $unFormRecherche = new FormRecherche("Rechercher");
//        
//        return new ViewModel(array('uneRecherche'=>$unFormRecherche));
//    }
    public function recevoirDonneesRechercheAction()
    {
        $recherche = $this->getRequest()->getPost('Recherche');
        $medocsTable= $this->getServiceLocator()->get("MedocTableCRUD");
        $medocsFiltres=$medocsTable->obtenirMedocFiltresLike(['colonne'=>'Nom', 'recherche'=>$recherche]);
        
        return new ViewModel(array('nom'=>$recherche, 'listeResultats' => $medocsFiltres));
        
    }
    
   
        
        
}
    






<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Membre;

class MembreController extends AbstractActionController
{
    public function indexAction()
    {
        
    }
    
    public function connexionAction() 
    {
        $email = $this->getRequest()->getPost('email');
        $password = $this->getRequest()->getPost('password');
        $membreTable = $this->getServiceLocator()->get("MembreTableCRUD");
        $membre = $membreTable->getMembre(['Email'=>$email]);
        
        if (password_verify($password,$membre->getPassword())) {
            session_start();
            $_SESSION['membre']=$membre->toArray();
            return new ViewModel();
        }
        else {
            return new ViewModel(["msg"=>"Connexion échouée! Veuillez vérifier votre email et votre mot de passe et re-essayer! Merci"]);
        }
    }
    
    public function inscriptionAction() 
    {      
        $membreTable = $this->getServiceLocator()->get("MembreTableCRUD");
        $check = $membreTable->getMembre(['Email' => $this->getRequest()->getPost('email')]);

        if (is_object($check)) {
            return new ViewModel(["msg"=>"Il y a deja un utilisateur avec cette email adresse!"]);
        }
        else {
            $passFormulaire = $this->getRequest()->getPost('password');
            $passwordHash = password_hash($passFormulaire, PASSWORD_DEFAULT, ['cost'=>12]);
            
            $membre = new Membre(['Nom'=>$this->getRequest()->getPost('nom'), 'Prenom'=>$this->getRequest()->getPost('prenom'), 'Email'=>$this->getRequest()->getPost('email'),
                              'Telephone'=>$this->getRequest()->getPost('telephone'), 'Adresse'=>$this->getRequest()->getPost('adresse'), 'Password'=>$passwordHash]);

            if ($membreTable->insertMembre($membre)) {
                $msg = "Merci pour votre inscription. Bienvenue sur le site!";
                session_start();
                $_SESSION['membre']=$membre->toArray();
            }
            else {
                $msg = "Error! Veuillez re-essayer! Merci!";
            }
            
            
            return new ViewModel(["msg"=>$msg]);
        }
    }
    
    public function profilAction() {
        session_start();
        $membreTable = $this->getServiceLocator()->get("MembreTableCRUD");
        $membre = $membreTable->getMembre(['Id'=>$_SESSION['membre']['Id']]);
        return new ViewModel(['membre'=> $membre]);
    }
    
    public function deconnectAction() {
        session_start();
        session_destroy();
        return new ViewModel();
    }
    
    public function updateAction() {
        session_start();
        if ($this->getRequest()->getPost('password') != "") {
            $passwordHash = password_hash($this->getRequest()->getPost('password'), PASSWORD_DEFAULT, ['cost'=>12]);
        } else { $passwordHash = $_SESSION['membre']['Password'];}
        if ($this->getRequest()->getPost('email') != "") {  $email = $this->getRequest()->getPost('email');    
        } else {$email = $_SESSION['membre']['Email'];}
        if ($this->getRequest()->getPost('telephone') != null) {
           $phone = $this->getRequest()->getPost('telephone');
        } else {$phone = $_SESSION['membre']['Telephone'];}
        if ($this->getRequest()->getPost('adresse') != "") {
           $adresse = $this->getRequest()->getPost('adresse');
        } else {$adresse = $_SESSION['membre']['Adresse'];}
        if ($this->getRequest()->getPost('groupeSanguin') != "") {
           $GroupeSanguin= $this->getRequest()->getPost('groupeSanguin');
        } else {$GroupeSanguin = $_SESSION['membre']['GroupeSanguin'];}
         if ($this->getRequest()->getPost('DateDeNaissance') != "") {
           $DateDeNaissance= $this->getRequest()->getPost('DateDeNaissance');
        } else {$DateDeNaissance = $_SESSION['membre']['DateDeNaissance'];}
        $membreTable = $this->getServiceLocator()->get("MembreTableCRUD");
        $membre = new Membre(['Id'=>$_SESSION['membre']['Id'], 'Nom'=>$_SESSION['membre']['Nom'], 'Prenom'=>$_SESSION['membre']['Prenom'], 'Email'=>$email,'Telephone'=>$phone,'Adresse'=>$adresse, 'Password'=>$passwordHash]);       
        if ($membreTable->updateUser($membre)) { $msg = "Vos données ont été changées!";} else { $msg = "Error! Veuillez re-essayer! Merci!";}  return new ViewModel(["msg"=>$msg]);}   
           

    public function contacterAction () {
        $idMembre = (int)$this->params()->fromRoute("id",null);
        return new ViewModel(['idMembre'=>$idMembre]);
    }
    
    public function sendAction() {
        $idMembre = (int)$this->params()->fromRoute("id",null);
        $membreTable = $this->getServiceLocator()->get("MembreTableCRUD");
        $membre = $membreTable->getMembre(['Id'=>$idMembre]);
        
        $to      = $membre->getEmail();
        $subject = 'Nouveau message';
        $message = $this->getRequest()->getPost('message') . $this->getRequest()->getPost('nom') . $this->getRequest()->getPost('email') . $this->getRequest()->getPost('telephone');
        $headers = 'From: ' . $this->getRequest()->getPost('nom') . "\r\n" .
            'Reply-To: ' . $this->getRequest()->getPost('email') . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        if (mail($to, $subject, $message, $headers)) {
            $msg = "Message envoyé!";
        } else { $msg = "Error! Veuillez re-essayer! Merci!";}
        
        return new ViewModel(['msg'=>$msg]);
    }
    
    
}

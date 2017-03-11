<?php

namespace Application\Forms;
use Zend\Form\Form;
use Zend\Form\Element;

class FormMembre extends Form
{
   public function __construct($name=null) 
   {
       parent::__construct($name);
       
       $inputPrenom = new Element("prenom");//name pour l'element
       $inputPrenom->setAttributes(array('type'=>'text'));
       
       $inputPrenom->setOptions(array('label'=>'Votre prénom'));
       
       $this->add($inputPrenom);
       
       $inputNom = new Element("nom");//name pour l'element
       $inputNom->setAttributes(array('type'=>'text'));
       
       $inputNom->setOptions(array('label'=>'Votre nom'));
       
       $this->add($inputNom);
       
       $inputDateDN = new Element\Date("date de naissance");//name pour l'element
       $inputDateDN->setAttributes(array('type'=>'text'));
       
       $inputDateDN->setOptions(array('label'=>'Votre date de naissance', 'format' => 'Y-m-d'));
       
       $this->add($inputDateDN);
       
        
       
       $inputEnvoyer = new Element("boutonEnvoyer");
       $inputEnvoyer->setAttributes(array('type'=>'submit','value'=>'Envoyer'));
       
       $this->add($inputEnvoyer);
       
   }
       
}

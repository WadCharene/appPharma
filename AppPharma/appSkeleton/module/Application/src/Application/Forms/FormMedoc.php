<?php

namespace Application\Forms;
use Zend\Form\Form;
use Zend\Form\Element;

class FormMedoc extends Form
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
       
       $Indication = new Element\textarea("mon textarea");//name pour l'element
       
       $Indication->setLabel('Entrer une description');
       $this->add($Indication);
       
       $Photo = new Element\Image("mon image");//name pour l'element
       $Photo->setAttribute('src', 'http://my.image.url'); 
       
       $this->add($Photo);
       
       $inputEnvoyer = new Element("boutonEnvoyer");
       $inputEnvoyer->setAttributes(array('type'=>'submit','value'=>'Envoyer'));
       
       $this->add($inputEnvoyer);
       
   }
       
}

<?php

namespace Application\Forms;
use Zend\Form\Form;
use Zend\Form\Element;

class FormRecherche extends Form
{
   public function __construct($name=null) 
   {
       parent::__construct($name);
       
       $recherche = new Element("Recherche");//name pour l'element
       $recherche->setAttributes(array('type'=>'text'));
       
       $recherche->setOptions(array('label'=>'Introduisez un medicament'));
       
       $this->add($recherche);
       
       $inputEnvoyer = new Element("boutonEnvoyer");
       $inputEnvoyer->setAttributes(array('type'=>'submit','value'=>'Envoyer'));
       
       $this->add($inputEnvoyer);
       
   }
       
}

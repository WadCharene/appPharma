<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'application' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'route'    => '/[:controller[/:action[/:id][/:id2]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[0-9a-zA-Z]*',
                                'id2' => '[0-9a-zA-Z]*'
                            ),
                            'defaults' => array(
                                /*'NAMESPACE'=>'Application\Controller',
                                'controller'=>'Test',
                                'action'=>'index',
                                'id'=>*/
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        
          'factories' => array(
            'translator' => 'Zend\Mvc\Service\TranslatorServiceFactory',
            
            //TableGateway
            
            //création du service manager TableGateway de Produit
            'CategorieTableGateway'=>function($sm){
                $adapter=$sm->get('Zend\Db\Adapter\Adapter'); //obtention de l'Adapter (get)
                $resultSetPrototype=new\Zend\Db\ResultSet\ResultSet();//création d'un ResultSet vide
                $resultSetPrototype->setArrayObjectPrototype(new \Application\Model\Categorie());//ce resultSet prépare un array d'objets de la class Produit
                return new \Zend\Db\TableGateway\TableGateway('categorie', $adapter, null, $resultSetPrototype); //renvoie un nouveau TableGateway
            },
            
            //création d'un service qui appelle un autre service        
            'CategorieTableCRUD'=> function ($sm){
                $tableGateway=$sm->get('CategorieTableGateway'); //j'appelle le service manager que je viens de créer 
                $MedocTableGateway=$sm->get ('MedocTableGateway'); 
                $table=new \Application\Model\CategorieTable($tableGateway, $MedocTableGateway);//creation d'un objet de la class du Model ProduitsTable (un TableGateway)
                return $table;
            },
            
            //création du service manager TableGateway de Personne
            
                    
            'MbrmedocTableCRUD'=> function ($sm){
                $tableGateway=$sm->get('MbrmedocTableGateway');
                $table=new \Application\Model\MbrmedocTable($tableGateway);
                return $table;
            },
                    
           
                    
            //création du service manager TableGateway de Categorie
            'MedocTableGateway'=>function($sm){
                $adapter=$sm->get('Zend\Db\Adapter\Adapter');
                $resultSetPrototype=new\Zend\Db\ResultSet\ResultSet();//création d'un ResultSet vide
                $resultSetPrototype->setArrayObjectPrototype(new \Application\Model\Medoc());
                return new \Zend\Db\TableGateway\TableGateway('medoc', $adapter, null, $resultSetPrototype);
            },
                    
            'MedocTableCRUD'=>function($sm){
                $tableGateway=$sm->get ('MedocTableGateway');
                $table=new \Application\Model\MedocTable($tableGateway);
                 return $table;
            },
            'MembreTableGateway'=>function($sm){
                $adapter=$sm->get('Zend\Db\Adapter\Adapter');
                $resultSetPrototype=new\Zend\Db\ResultSet\ResultSet();//création d'un ResultSet vide
                $resultSetPrototype->setArrayObjectPrototype(new \Application\Model\Membre());
                return new \Zend\Db\TableGateway\TableGateway('membre', $adapter, null, $resultSetPrototype);
            },
                    
            'MembreTableCRUD'=>function($sm){
                $tableGateway=$sm->get ('MedocTableGateway');
                $table=new \Application\Model\MembreTable($tableGateway);
                 return $table;
            },
                    
//                    'UserTableGateway' => function($sm) {
//                $adapter = $sm->get("Zend\DB\Adapter");
//                $resultSet = new \Zend\Db\ResultSet\ResultSet();
//                $resultSet->setArrayObjectPrototype(new \Application\Model\User());
//                return new \Zend\Db\TableGateway\TableGateway('user', $adapter, null, $resultSet);
//            },
//            'UserTableCRUD'=>function ($sm) {
//                   $tableGateway = $sm->get ('UserTableGateway');
//                   $userManager = new \Application\Model\UserTable($tableGateway);
//                   return $userManager;
//            },
            
            
            
        
    ),
        
        
        
        'aliases' => array(
         //   'translator' => 'MvcTranslator',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController',
            'Application\Controller\Membre' => 'Application\Controller\MembreController',
            'Application\Controller\Medoc' => 'Application\Controller\MedocController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);

<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Login\Controller\Login' => 'Login\Controller\LoginController',            
        ),
    ),
    
	// The following section is new and should be added to your file
     'router' => array(
        'routes' => array(
            
            // The following is a route to simplify getting started creating
            'login' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/login[/][/:action]',
                    'constraints' => array(
                        'action' 		=> '[a-zA-Z][a-zA-Z0-9_-]*',
                        
                    ),
                    'defaults' => array(
                        'controller' => 'Login\Controller\Login',
                     	'action'     => 'login',
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
    ), 
   
    'view_manager' => array(
        'template_path_stack' => array(
            'login' => __DIR__ . '/../view',
        ),
    ),
);    


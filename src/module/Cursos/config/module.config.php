<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Cursos\Controller\Cursos' => 'Cursos\Controller\CursosController',            
        ),
    ),
    
	// The following section is new and should be added to your file
     'router' => array(
        'routes' => array(
            
            // The following is a route to simplify getting started creating
            'cursos' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/cursos[/:action][/:id]',
                    'constraints' => array(
                        'action' 		=> '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     		=> '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Cursos\Controller\Cursos',
                     	'action'     => 'index',
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
            'cursos' => __DIR__ . '/../view',
        ),
    ),
);    
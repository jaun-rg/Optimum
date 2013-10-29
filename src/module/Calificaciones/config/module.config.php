<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Calificaciones\Controller\Calificaciones' => 'Calificaciones\Controller\CalificacionesController',            
        ),
    ),
    
	// The following section is new and should be added to your file
     'router' => array(
        'routes' => array(
            
            // The following is a route to simplify getting started creating
            'calificaciones' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/calificaciones[/][/:action][/:id]',
                    'constraints' => array(
                        'action' 		=> '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     		=> '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Calificaciones\Controller\Calificaciones',
                     	'action'     => 'index',
                    ),
                ),
            ),
        ),
     ),
   
    'view_manager' => array(
        'template_path_stack' => array(
            'calificaciones' => __DIR__ . '/../view',
        ),
    ),
);    
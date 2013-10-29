<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Alumnos\Controller\Alumnos' => 'Alumnos\Controller\AlumnosController',            
        ),
    ),
    
	// The following section is new and should be added to your file
     'router' => array(
        'routes' => array(
            
            // The following is a route to simplify getting started creating
            'alumnos' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/alumnos[/][/:action][/:id]',
                    'constraints' => array(
                        'action' 		=> '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     		=> '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Alumnos\Controller\Alumnos',
                     	'action'     => 'index',
                    ),
                ),
            ),
        ),
     ),
   
    'view_manager' => array(
        'template_path_stack' => array(
            'alumnos' => __DIR__ . '/../view',
        ),
    ),
);    
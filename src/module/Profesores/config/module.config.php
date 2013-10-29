<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Profesores\Controller\Profesores' => 'Profesores\Controller\ProfesoresController',            
        ),
    ),
    
	// The following section is new and should be added to your file
     'router' => array(
        'routes' => array(
            
            // The following is a route to simplify getting started creating
            'profesores' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/profesores[/][/:action][/:id]',
                    'constraints' => array(
                        'action' 		=> '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     		=> '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Profesores\Controller\Profesores',
                     	'action'     => 'index',
                    ),
                ),
            ),
        ),
     ),
   
    'view_manager' => array(
        'template_path_stack' => array(
            'profesores' => __DIR__ . '/../view',
        ),
    ),
);    
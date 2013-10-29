<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Admin\Controller\Alumnos' 			=> 'Admin\Controller\AlumnosController',
            'Admin\Controller\Calificaciones' 	=> 'Admin\Controller\CalificacionesController',
            'Admin\Controller\Cursos' 			=> 'Admin\Controller\CursosController',
            'Admin\Controller\Profesores' 		=> 'Admin\Controller\ProfesoresController',
            
        ),
    ),
   
    // The following section is new and should be added to your file
     'router' => array(
        'routes' => array(
            
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'admin' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/admin',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller'    => 'Alumnos',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
		 /*
            'admin' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/admin[/][:Controller][/:action][/:id]',
                    'constraints' => array(
                    	'Controller' 	=> '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' 		=> '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     		=> '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Alumnos',
                     	'action'     => 'index',
                    ),
                ),
            ),
        ),*/
    

    'view_manager' => array(
        'template_path_stack' => array(
            'admin' => __DIR__ . '/../view',
        ),
    ),

    /*
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'admin/index/index' => __DIR__ . '/../view/admin/index/index.phtml',
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
    */
);
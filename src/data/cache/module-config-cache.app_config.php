<?php
return array (
  'view_manager' => 
  array (
    'template_path_stack' => 
    array (
      'zenddevelopertools' => 'C:\\xampp\\htdocs\\Optimum\\src\\vendor\\zendframework\\zend-developer-tools\\config/../view',
      0 => 'C:\\xampp\\htdocs\\Optimum\\src\\module\\Application\\config/../view',
      'alumnos' => 'C:\\xampp\\htdocs\\Optimum\\src\\module\\Alumnos\\config/../view',
      'calificaciones' => 'C:\\xampp\\htdocs\\Optimum\\src\\module\\Calificaciones\\config/../view',
      'cursos' => 'C:\\xampp\\htdocs\\Optimum\\src\\module\\Cursos\\config/../view',
      'profesores' => 'C:\\xampp\\htdocs\\Optimum\\src\\module\\Profesores\\config/../view',
      'login' => 'C:\\xampp\\htdocs\\Optimum\\src\\module\\Login\\config/../view',
    ),
    'display_not_found_reason' => true,
    'display_exceptions' => true,
    'doctype' => 'HTML5',
    'not_found_template' => 'error/404',
    'exception_template' => 'error/index',
    'template_map' => 
    array (
      'layout/layout' => 'C:\\xampp\\htdocs\\Optimum\\src\\module\\Application\\config/../view/layout/layout.phtml',
      'application/index/index' => 'C:\\xampp\\htdocs\\Optimum\\src\\module\\Application\\config/../view/application/index/index.phtml',
      'error/404' => 'C:\\xampp\\htdocs\\Optimum\\src\\module\\Application\\config/../view/error/404.phtml',
      'error/index' => 'C:\\xampp\\htdocs\\Optimum\\src\\module\\Application\\config/../view/error/index.phtml',
    ),
  ),
  'router' => 
  array (
    'routes' => 
    array (
      'home' => 
      array (
        'type' => 'Zend\\Mvc\\Router\\Http\\Literal',
        'options' => 
        array (
          'route' => '/',
          'defaults' => 
          array (
            'controller' => 'Alumnos\\Controller\\Alumnos',
            'action' => 'index',
          ),
        ),
      ),
      'application' => 
      array (
        'type' => 'Literal',
        'options' => 
        array (
          'route' => '/application',
          'defaults' => 
          array (
            '__NAMESPACE__' => 'Application\\Controller',
            'controller' => 'Index',
            'action' => 'index',
          ),
        ),
        'may_terminate' => true,
        'child_routes' => 
        array (
          'default' => 
          array (
            'type' => 'Segment',
            'options' => 
            array (
              'route' => '/[:controller[/:action]]',
              'constraints' => 
              array (
                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
              ),
              'defaults' => 
              array (
              ),
            ),
          ),
        ),
      ),
      'alumnos' => 
      array (
        'type' => 'segment',
        'options' => 
        array (
          'route' => '/alumnos[/:action][/:id]',
          'constraints' => 
          array (
            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
            'id' => '[0-9]+',
          ),
          'defaults' => 
          array (
            'controller' => 'Alumnos\\Controller\\Alumnos',
            'action' => 'index',
          ),
        ),
      ),
      'calificaciones' => 
      array (
        'type' => 'segment',
        'options' => 
        array (
          'route' => '/calificaciones[/:action][/:id]',
          'constraints' => 
          array (
            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
            'id' => '[0-9]+',
          ),
          'defaults' => 
          array (
            'controller' => 'Calificaciones\\Controller\\Calificaciones',
            'action' => 'index',
          ),
        ),
      ),
      'cursos' => 
      array (
        'type' => 'segment',
        'options' => 
        array (
          'route' => '/cursos[/:action][/:id]',
          'constraints' => 
          array (
            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
            'id' => '[0-9]+',
          ),
          'defaults' => 
          array (
            'controller' => 'Cursos\\Controller\\Cursos',
            'action' => 'index',
          ),
        ),
      ),
      'profesores' => 
      array (
        'type' => 'segment',
        'options' => 
        array (
          'route' => '/profesores[/:action][/:id]',
          'constraints' => 
          array (
            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
            'id' => '[0-9]+',
          ),
          'defaults' => 
          array (
            'controller' => 'Profesores\\Controller\\Profesores',
            'action' => 'index',
          ),
        ),
      ),
      'login' => 
      array (
        'type' => 'segment',
        'options' => 
        array (
          'route' => '/login[/][/:action][/:id]',
          'constraints' => 
          array (
            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
            'id' => '[0-9]+',
          ),
          'defaults' => 
          array (
            'controller' => 'Login\\Controller\\Login',
            'action' => 'index',
          ),
        ),
      ),
    ),
  ),
  'service_manager' => 
  array (
    'abstract_factories' => 
    array (
      0 => 'Zend\\Cache\\Service\\StorageCacheAbstractServiceFactory',
      1 => 'Zend\\Log\\LoggerAbstractServiceFactory',
      2 => 'Zend\\Cache\\Service\\StorageCacheAbstractServiceFactory',
      3 => 'Zend\\Log\\LoggerAbstractServiceFactory',
      4 => 'Zend\\Cache\\Service\\StorageCacheAbstractServiceFactory',
      5 => 'Zend\\Log\\LoggerAbstractServiceFactory',
      6 => 'Zend\\Cache\\Service\\StorageCacheAbstractServiceFactory',
      7 => 'Zend\\Log\\LoggerAbstractServiceFactory',
      8 => 'Zend\\Cache\\Service\\StorageCacheAbstractServiceFactory',
      9 => 'Zend\\Log\\LoggerAbstractServiceFactory',
    ),
    'factories' => 
    array (
      'navigation' => 'Zend\\Navigation\\Service\\DefaultNavigationFactory',
      'cache' => 
      Closure::__set_state(array(
      )),
      'Zend\\Db\\Adapter\\Adapter' => 'Zend\\Db\\Adapter\\AdapterServiceFactory',
    ),
  ),
  'translator' => 
  array (
    'locale' => 'en_US',
    'translation_file_patterns' => 
    array (
      0 => 
      array (
        'type' => 'gettext',
        'base_dir' => 'C:\\xampp\\htdocs\\Optimum\\src\\module\\Application\\config/../language',
        'pattern' => '%s.mo',
      ),
    ),
  ),
  'controllers' => 
  array (
    'invokables' => 
    array (
      'Application\\Controller\\Index' => 'Application\\Controller\\IndexController',
      'Alumnos\\Controller\\Alumnos' => 'Alumnos\\Controller\\AlumnosController',
      'Calificaciones\\Controller\\Calificaciones' => 'Calificaciones\\Controller\\CalificacionesController',
      'Cursos\\Controller\\Cursos' => 'Cursos\\Controller\\CursosController',
      'Profesores\\Controller\\Profesores' => 'Profesores\\Controller\\ProfesoresController',
      'Login\\Controller\\Login' => 'Login\\Controller\\LoginController',
    ),
  ),
  'console' => 
  array (
    'router' => 
    array (
      'routes' => 
      array (
      ),
    ),
  ),
  'db' => 
  array (
    'driver' => 'Pdo',
    'dsn' => 'mysql:dbname=Escuela;host=localhost',
    'driver_options' => 
    array (
      1002 => 'SET NAMES \'UTF8\'',
    ),
    'username' => 'developer',
    'password' => 'dev-pass',
  ),
  'zenddevelopertools' => 
  array (
    'profiler' => 
    array (
      'enabled' => true,
      'strict' => false,
      'flush_early' => false,
      'cache_dir' => 'data/cache',
      'matcher' => 
      array (
      ),
      'collectors' => 
      array (
      ),
    ),
    'toolbar' => 
    array (
      'enabled' => true,
      'auto_hide' => false,
      'position' => 'bottom',
      'version_check' => true,
      'entries' => 
      array (
      ),
    ),
  ),
);
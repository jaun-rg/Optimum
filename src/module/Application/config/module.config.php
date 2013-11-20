<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
use Zend\Authentication\AuthenticationService;
use Application\Authentication\Adapter\DbTableBcrypt;

return array(
    'router' => array(
    	
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Alumnos\Controller\Alumnos',
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
            
		    //definido para autentifcacion
		    /*
            'auth' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/auth',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Auth\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    // Esta regla te da aceso a todos los controladores y acciones del modulo auth, parecido a ZF1.
                    // ej: auth/session/login, auth/session/logout, auth/user/register, auth/user/resetpassword
                    'session' => array(
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
            ),//termina auth
			 */ 
        ),
    ),
	'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
		 
		 
     	'factories' => array(
     	 //'Application\Cache' => 'Zend\Cache\Service\StorageCacheFactory',
		 //'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory', // <-- add this
         'cache' => function () {
            return Zend\Cache\StorageFactory::factory(array(
                'storage' => array(
                    'adapter' => 'Filesystem',
                    'options' => array(
                        'cache_dir' => __DIR__ . '/../../../data/cache',
                        'ttl' => 100
                    ),
                ),
                'plugins' => array(
                    'IgnoreUserAbort' => array(
                        'exitOnAbort' => true
                    ),
                    'exception_handler' => array(
                   		'throw_exceptions' => false
                	),
                ),
            ));
        },//cache
        
        //*autentificacion 1. Damos de alta el servicio, ir a Application/Module.php
        /* /'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
        'AuthService' => function($sm) {
                $authServiceManager = new AuthenticationService();
                 
                // Obtenemos el adaptador de Base de datos
                $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                 
                // Configuramos el adaptador auth
                $authAdapter = new DbTableBcrypt($dbAdapter);
                $authAdapter->setTableName('usuarios')
                    ->setIdentityColumn('username')
                    ->setCredentialColumn('pass');
                 
                // Y se lo pasamos a nuestro servicio
                $authServiceManager->setAdapter($authAdapter);
                return $authServiceManager;
            }
        //*/
			
      ), //data-caching
    ),
    
    'translator' => array(
        'locale' => 'es_ES',
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
        	//'Application\Controller\Account' => 'Application\Controller\AccountController',
            'Application\Controller\Index' => 'Application\Controller\IndexController',
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

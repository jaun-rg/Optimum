<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
		
		/*
		//inicia data-caching
		// A list of routes to be cached
        $routes = array('/profesores', '/alumnos', '/cursos','/calificaciones');

        $app = $e->getApplication();
        $em  = $app->getEventManager();
        $sm  = $app->getServiceManager();

        $em->attach(MvcEvent::EVENT_ROUTE, function($e) use ($sm) {
            $route = $e->getRouteMatch()->getMatchedRouteName();
            $cache = $sm->get('cache-service');
            $key   = 'route-cache-' . $route;

            if ($cache->hasItem($key)) {
                // Handle response
                $content  = $cache->getItem($key);

                $response = $e->getResponse();
                $response->setContent($content);

                return $response;
            }
        }, -1000); // Low, then routing has happened

        $em->attach(MvcEvent::EVENT_RENDER, function($e) use ($sm, $routes) {
            $route = $e->getRouteMatch()->getMatchedRouteName();
            if (!in_array($route, $routes)) {
                return;
            }

            $response = $e->getResponse();
            $content  = $response->getContent();

            $cache = $sm->get('cache-service');
            $key   = 'route-cache-' . $route;
            $cache->setItem($key, $content);
        }, -1000); // Late, then rendering has happened
        
        //termina data-caching
        */
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
	
	

}

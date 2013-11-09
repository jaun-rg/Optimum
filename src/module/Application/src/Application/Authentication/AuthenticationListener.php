<?php

//3. definimos el manejo de autentificacion en la aplicacion
//falta crear la vista y el controlador correspondiente
//ver src/Application/Form/LoginForm


namespace Application\Authentication;
 
use Zend\Mvc\Router\RouteMatch;
 
use Zend\Mvc\MvcEvent;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
 
class AuthenticationListener implements ListenerAggregateInterface
{
    protected $listeners = array();
	
 /**
  *  primero registramos el listener, y asignamos una prioridad alta, 
  * para que se ejecute lo antes posible dentro del stack de listeners registrados en el evento.
  */
    public function attach(EventManagerInterface $events, $priority = 1000)
    {
        $this->listeners[] = $events->attach(MvcEvent::EVENT_DISPATCH, array($this, 'onDispatch'), $priority);
    }
 
  /**
   * lo único que haces es remover el listener del evento
   */
    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }
	
 	/**
	 * primero obtengo el servicio Auth, y el match hecho por mi router
	 */
    public function onDispatch(MvcEvent $e)
    {
    	
		/**
		 * primero obtengo el servicio Auth, y el match hecho por mi router
		 */
        $authService = $e->getApplication()->getServiceManager()->get('AuthService');
         
        $matches = $e->getRouteMatch();
        if (!$matches instanceof RouteMatch) {
            // No hacemos nada si no tenemos un match en el router
            return;
        }
         
		 /**
		  * Luego obtengo el nombre del controlador y la accion actual que hicieron match en mi router, 
		  * 
		  * si estoy en la pagina de inicio de sesión no es necesario hacer nada mas, 
		  * por que quiere decir que el usuario quiere logearse
		  */
        $controller = $matches->getParam('controller');
        $action     = $matches->getParam('action');
         
        if ($controller == 'Application\Controller\Auth' && $action == 'login') {
            // Si estamos en la pagina de Login, no hacemos nada
            return;
        }
         
		 
		 /**
		  * si el usuario ya inicio sesión, no es necesario hacerlo de nuevo
		  */
        if ($authService->hasIdentity()) {
            // Si hay una sesion activa, no hacemos nada
            return;
        }
		
		
         /**
		  * si el usuario no ha iniciado sesión y esta intentando acceder 
		  * a una página de la aplicación sin logearse, entonces lo redirigimos a la página de login
		  */
		 
        // Si lo anterior no se da, debemos iniciar sesion
        $matches->setParam('controller', 'Application\Controller\Account');
        $matches->setParam('action', 'login');
    }
}
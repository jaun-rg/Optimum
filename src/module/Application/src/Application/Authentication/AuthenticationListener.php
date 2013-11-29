<?php
namespace Application\Authentication;
 
use Zend\Mvc\Router\RouteMatch;
 
use Zend\Mvc\MvcEvent;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
 
class AuthenticationListener implements ListenerAggregateInterface
{
    protected $listeners = array();
 
    public function attach(EventManagerInterface $events, $priority = 1000)
    {
        $this->listeners[] = $events->attach(MvcEvent::EVENT_DISPATCH, array($this, 'onDispatch'), $priority);
    }
 
    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }
 
    public function onDispatch(MvcEvent $e)
    {
        $authService = $e->getApplication()->getServiceManager()->get('AuthService');
         
        $matches = $e->getRouteMatch();
        if (!$matches instanceof RouteMatch) {
            // No hacemos nada si no tenemos un match en el router
            return;
        }
         
        $controller = $matches->getParam('controller');
        $action     = $matches->getParam('action');
         
        if ($controller == 'Application\Controller\Auth' && $action == 'login') {
            // Si estamos en la pagina de Login, no hacemos nada
            return;
        }
         
        if ($authService->hasIdentity()) {
            // Si hay una sesion activa, no hacemos nada
            return;
            //return $this->redirect()->toRoute('alumnos');
        }
         
        // Si lo anterior no se da, debemos iniciar sesion
        $matches->setParam('controller', 'Application\Controller\Account');
        $matches->setParam('action', 'login');
    }
}
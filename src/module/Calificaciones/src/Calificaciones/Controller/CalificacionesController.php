<?php

namespace Calificaciones\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container as SessionContainer;
use Zend\Mvc\Controller\Plugin\FlashMessenger;
use Zend\View\Model\ViewModel;
use Zend\Cache\Storage\StorageInterface;

class CalificacionesController extends AbstractActionController {
	

	
	protected $calificacionesTable;
	//protected $session;
	//$session = 
	
	public function getCalificacionesTable()
    {
        if (!$this->calificacionesTable) {
            $sm = $this->getServiceLocator();
            $this->albumTable = $sm->get('Calificaciones\Model\CalificacionesTable');
        }		
        return $this->albumTable;
    }
	
	
	public function indexAction() {
		$this->session = new SessionContainer('session');
		//if ($this->sessionoffsetGet('ex')){
		//if($_SESSION['session']['ex']){
		if($this->session->offsetGet('ex')){
				$this -> flashMessenger() -> setNamespace(FlashMessenger::NAMESPACE_SUCCESS);
				$this -> flashMessenger() -> addMessage('has ingresado con exito '.$this->session->offsetGet('username'));
				
				return new ViewModel(	array(
            		'calificaciones' => $this->getCalificacionesTable()->fetchAll(),
        		));
		}else{
			$this -> flashMessenger() -> setNamespace(FlashMessenger::NAMESPACE_DEFAULT);
			$this -> flashMessenger() -> addMessage('QUE HACES?');
			return $this -> redirect() -> toRoute('login');
		}
	}

	public function agregarCalificacionesAction() {
		return new ViewModel();
	}

	public function inscripcionAction() {
		return new ViewModel();
	}

	public function pagoAction() {
		return new ViewModel();
	}

	public function buscarAction() {
		return new ViewModel();
	}

	public function mostrarAction() {
		return new ViewModel();
	}

	public function borrarAction() {
		return new ViewModel();
	}

}

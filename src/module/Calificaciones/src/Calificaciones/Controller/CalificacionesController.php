<?php

namespace Calificaciones\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container as SessionContainer;
use Zend\Mvc\Controller\Plugin\FlashMessenger;
use Zend\View\Model\ViewModel;
use Zend\Cache\Storage\StorageInterface;
use Calificaciones\Model\Calificaciones;          // <-- Add this import
use Calificaciones\Form\CalificacionesForm; 
use Calificaciones\Form\BusquedaForm;

class CalificacionesController extends AbstractActionController {

	protected $calificacionesTable;
	
	private function islogged(){
		try {
			$session = new SessionContainer('user');
			
			if (!$session -> offsetGet('ex'))
			{
				$this -> flashMessenger() -> setNamespace(FlashMessenger::NAMESPACE_DEFAULT);
				$this -> flashMessenger() -> addMessage('Es necesario iniciar sesión antes de continuar');
				return $this -> redirect() -> toRoute('login');
			}
				
		}
		catch (\Exception $ex) {
			$this -> flashMessenger() -> setNamespace(FlashMessenger::NAMESPACE_DEFAULT);
			$this -> flashMessenger() -> addMessage('Es necesario iniciar sesión antes de continuar');
			return $this -> redirect() -> toRoute('login');
		}
	}

	public function getCalificacionesTable() {
		if (!$this -> calificacionesTable) {
			$sm = $this -> getServiceLocator();
			$this -> albumTable = $sm -> get('Calificaciones\Model\CalificacionesTable');
		}
		return $this -> albumTable;
	}

	public function indexAction() {
		$this->islogged();
				return new ViewModel( array('calificaciones' => $this -> getCalificacionesTable() -> fetchAll(), ));
			
	}

	public function agregarCalificacionesAction() {
		$this -> flashMessenger() -> setNamespace(FlashMessenger::NAMESPACE_DEFAULT);
		$this -> flashMessenger() -> addMessage('Estamos haciendo mejoras en esta sección, por lo que no se puede acceder');
		return $this -> redirect() -> toRoute('calificaciones');
	}

	public function editarAction() {
		$this -> flashMessenger() -> setNamespace(FlashMessenger::NAMESPACE_DEFAULT);
		$this -> flashMessenger() -> addMessage('Estamos haciendo mejoras en esta sección, por lo que no se puede acceder');
		return $this -> redirect() -> toRoute('calificaciones');
	}

	public function pagoAction() {
		$this -> flashMessenger() -> setNamespace(FlashMessenger::NAMESPACE_DEFAULT);
		$this -> flashMessenger() -> addMessage('Estamos haciendo mejoras en esta sección, por lo que no se puede acceder');
		return $this -> redirect() -> toRoute('calificaciones');
	}

	public function buscarAction() {
		$this -> flashMessenger() -> setNamespace(FlashMessenger::NAMESPACE_DEFAULT);
		$this -> flashMessenger() -> addMessage('Estamos haciendo mejoras en esta sección, por lo que no se puede acceder');
		return $this -> redirect() -> toRoute('calificaciones');
	}

	public function mostrarAction() {
		$this -> flashMessenger() -> setNamespace(FlashMessenger::NAMESPACE_DEFAULT);
		$this -> flashMessenger() -> addMessage('Estamos haciendo mejoras en esta sección, por lo que no se puede acceder');
		return $this -> redirect() -> toRoute('calificaciones');	}

	public function borrarAction() {
		$this -> flashMessenger() -> setNamespace(FlashMessenger::NAMESPACE_DEFAULT);
		$this -> flashMessenger() -> addMessage('Estamos haciendo mejoras en esta sección, por lo que no se puede acceder');
		return $this -> redirect() -> toRoute('calificaciones');
	}

}

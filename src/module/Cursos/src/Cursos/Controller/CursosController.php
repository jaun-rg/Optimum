<?php

namespace Cursos\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container as SessionContainer;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\Plugin\FlashMessenger;
use Cursos\Model\Cursos;          // <-- Add this import
use Cursos\Form\CursosForm; 
use Cursos\Form\BusquedaForm;

class CursosController extends AbstractActionController {
	
	protected $cursosTable;
	
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
	
	public function getCursosTable()
    {
        if (!$this->cursosTable) {
            $sm = $this->getServiceLocator();
            $this->albumTable = $sm->get('Cursos\Model\CursosTable');
        }
        return $this->albumTable;
    }
	
	
	public function indexAction() {
		$this->islogged();
		
		return new ViewModel(array(
            'cursos' => $this->getCursosTable()->fetchAll(),
        ));
	}

	public function agregarCursosAction() {
		$this -> flashMessenger() -> setNamespace(FlashMessenger::NAMESPACE_DEFAULT);
		$this -> flashMessenger() -> addMessage('Estamos haciendo mejoras en esta sección, por lo que no se puede acceder');
		return $this -> redirect() -> toRoute('cursos');
	}

	public function editarAction() {
		$this -> flashMessenger() -> setNamespace(FlashMessenger::NAMESPACE_DEFAULT);
		$this -> flashMessenger() -> addMessage('Estamos haciendo mejoras en esta sección, por lo que no se puede acceder');
		return $this -> redirect() -> toRoute('cursos');
	}

	public function pagoAction() {
		$this -> flashMessenger() -> setNamespace(FlashMessenger::NAMESPACE_DEFAULT);
		$this -> flashMessenger() -> addMessage('Estamos haciendo mejoras en esta sección, por lo que no se puede acceder');
		return $this -> redirect() -> toRoute('cursos');
	}

	public function buscarAction() {
		$this -> flashMessenger() -> setNamespace(FlashMessenger::NAMESPACE_DEFAULT);
		$this -> flashMessenger() -> addMessage('Estamos haciendo mejoras en esta sección, por lo que no se puede acceder');
		return $this -> redirect() -> toRoute('cursos');
	}

	public function mostrarAction() {
		$this -> flashMessenger() -> setNamespace(FlashMessenger::NAMESPACE_DEFAULT);
		$this -> flashMessenger() -> addMessage('Estamos haciendo mejoras en esta sección, por lo que no se puede acceder');
		return $this -> redirect() -> toRoute('cursos');
	}

	public function borrarAction() {
		$this -> flashMessenger() -> setNamespace(FlashMessenger::NAMESPACE_DEFAULT);
		$this -> flashMessenger() -> addMessage('Estamos haciendo mejoras en esta sección, por lo que no se puede acceder');
		return $this -> redirect() -> toRoute('cursos');
	}

}

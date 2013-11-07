<?php

namespace Profesores\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ProfesoresController extends AbstractActionController {
	
	protected $profesoresTable;
	
	public function getProfesoresTable()
    {
        if (!$this->profesoresTable) {
            $sm = $this->getServiceLocator();
            $this->albumTable = $sm->get('Profesores\Model\ProfesoresTable');
        }
        return $this->albumTable;
    }
	
	
	public function indexAction() {
		return new ViewModel(array(
            'profesores' => $this->getProfesoresTable()->fetchAll(),
        ));
	}

	public function agregarProfesoresAction() {
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

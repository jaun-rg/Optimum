<?php

namespace Cursos\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CursosController extends AbstractActionController {
	
	protected $cursosTable;
	
	public function getCursosTable()
    {
        if (!$this->cursosTable) {
            $sm = $this->getServiceLocator();
            $this->albumTable = $sm->get('Cursos\Model\CursosTable');
        }
        return $this->albumTable;
    }
	
	
	public function indexAction() {
		return new ViewModel(array(
            'cursos' => $this->getCursosTable()->fetchAll(),
        ));
	}

	public function agregarCursosAction() {
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

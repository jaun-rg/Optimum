<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AlumnosController extends AbstractActionController {
	
	protected $alumnosTable;
	
	public function getAlumnosTable()
    {
        if (!$this->alumnosTable) {
            $sm = $this->getServiceLocator();
            $this->albumTable = $sm->get('Admin\Model\AlumnosTable');
        }
        return $this->albumTable;
    }
	
	
	public function indexAction() {
		return new ViewModel(array(
            'alumnos' => $this->getAlumnosTable()->fetchAll(),
        ));
	}

	public function agregarAction() {
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

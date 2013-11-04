<?php

namespace Calificaciones\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CalificacionesController extends AbstractActionController {
	
	protected $calificacionesTable;
	
	public function getCalificacionesTable()
    {
        if (!$this->calificacionesTable) {
            $sm = $this->getServiceLocator();
            $this->albumTable = $sm->get('Calificaciones\Model\CalificacionesTable');
        }
        return $this->albumTable;
    }
	
	
	public function indexAction() {
		return new ViewModel(array(
            'calificaciones' => $this->getCalificacionesTable()->fetchAll(),
        ));
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

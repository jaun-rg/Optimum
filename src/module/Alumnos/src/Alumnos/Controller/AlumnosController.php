<?php

namespace Alumnos\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Alumnos\Model\Alumnos;          // <-- Add this import
use Alumnos\Form\AlumnosForm; 

class AlumnosController extends AbstractActionController {
	
	protected $alumnosTable;
	
	public function getAlumnosTable()
    {
        if (!$this->alumnosTable) {
            $sm = $this->getServiceLocator();
            $this->albumTable = $sm->get('Alumnos\Model\AlumnosTable');
        }
        return $this->albumTable;
    }
	
	
	public function indexAction() {
		return new ViewModel(array(
            'alumnos' => $this->getAlumnosTable()->fetchAll(),
        ));
	}

	public function agregarAction() {
		$form = new AlumnosForm();
         $form->get('submit')->setValue('agregar');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $alumno = new Alumnos();
             $form->setInputFilter($alumno->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $alumno->exchangeArray($form->getData());
                 $this->getAlumnosTable()->saveAlumno($alumno);

                 // Redirect to list of albums
                 return $this->redirect()->toRoute('alumnos');
             }
         }
         return array('form' => $form);
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

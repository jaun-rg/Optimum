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
            $this->alumnosTable = $sm->get('Alumnos\Model\AlumnosTable');
        }
        return $this->alumnosTable;
    }
	
	
	public function indexAction() {
		return new ViewModel(array(
            'alumnos' => $this->getAlumnosTable()->fetchAll(),
            /*'message' => 'Hello world',*/
        ));
	}

	public function inscripcionAction() {
		$form = new AlumnosForm();
         $form->get('submit')->setValue('Inscribir');

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
	 public function editarAction(){
	 	
		 $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('alumnos', array(
                 'action' => 'inscripcion'
             ));
         }

         // Get the Usuario with the specified id.  An exception is thrown
         // if it cannot be found, in which case go to the index page.
         try {
             $alumno = $this->getAlumnosTable()->getAlumno($id);
         }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('alumnos', array(
                 'action' => 'index'
             ));
         }

         $form  = new AlumnosForm();
         $form->bind($alumno);
         $form->get('submit')->setAttribute('value', 'Editar');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $form->setInputFilter($alumno->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $this->getAlumnosTable()->saveAlumno($alumno);

                 // Redirect to list of albums
                 return $this->redirect()->toRoute('alumnos');
             }
         }

         return array(
             'id' => $id,
             'form' => $form,
         );
	} 
	
	public function borrarAction() {
		 $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('alumnos');
         }

         $request = $this->getRequest();
         if ($request->isPost()) {
             $del = $request->getPost('del', 'No');

             if ($del == 'Si') {
                 $id = (int) $request->getPost('id');
                 $this->getAlumnosTable()->deleteAlumno($id);
             }

             // Redirect to list of albums
             return $this->redirect()->toRoute('alumnos');
         }

         return array(
             'id'    => $id,
             'alumno' => $this->getAlumnosTable()->getAlumno($id),
         );
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

	

}

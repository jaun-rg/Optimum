<?php

namespace Alumnos\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\Plugin\FlashMessenger;
use Alumnos\Model\Alumnos;          // <-- Add this import
use Alumnos\Form\AlumnosForm; 
use Alumnos\Form\BusquedaForm;

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
		$form = new AlumnosForm();
        $form->get('submit')->setValue('Buscar');
		
		return new ViewModel(array(
            //'alumnos' => $this->getAlumnosTable()->fetchAll(),
            'form'=> $form,
        ));
	}
	
	public function todosAction() {
		
		return new ViewModel(array(
            'alumnos' => $this->getAlumnosTable()->fetchAll(),
        ));
	}
	
	public function buscarAction() {
		$form = new BusquedaForm();
        $form->get('submit')->setValue('Buscar');
		
		$request = $this->getRequest();
         if ($request->isPost()) {
         	
             $nombre  	= (string) 	$form->get('nombres')->getValue();
			 $apaterno  = (string) 	$form->get('aPaterno')->getValue();
			 $amaterno  = (string) 	$form->get('aMaterno')->getValue();
			 $folio 	= (string) 	$form->get('folioExamen')->getValue();

             try {
             	return new ViewModel(array(
             		'alumnos' => $this->getAlumnosTable()->findAlumno($nombre, $apaterno, $amaterno, $folio),
        		));
         	}
         	catch (\Exception $ex) {
         		 //view status messages
             	$this->flashMessenger()->setNamespace(FlashMessenger::NAMESPACE_ERROR);
             	$this->flashMessenger()->addMessage('Error al obtener los datos del alumno:'.$nombre.', $apaterno, $amaterno, $folio');
             	return $this->redirect()->toRoute('alumnos', array(
                 'action' => 'index'
             	));
         	}
		 
         }
		
		return array('form' => $form);
		
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

                 // Redirect to index
                 $this->flashMessenger()	->setNamespace(FlashMessenger::NAMESPACE_SUCCESS);
                 $this->flashMessenger()	->addMessage('Has inscrito a un nuevo alumno');
                 return $this->redirect()->toRoute('alumnos');
             }
         }
         return array('form' => $form);
	
	}
	 public function editarAction(){
		 $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
         	// Redirect to index
             $this->flashMessenger()	->setNamespace(FlashMessenger::NAMESPACE_DEFAULT);
             $this->flashMessenger()	->addMessage('Has intentado editar a un alumno que no esta inscrito');
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
         	 //view status messages
             $this->flashMessenger()->setNamespace(FlashMessenger::NAMESPACE_ERROR);
             $this->flashMessenger()->addMessage('Error al obtener los datos del alumno');
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

                 //view status messages
                 $this->flashMessenger()->setNamespace(FlashMessenger::NAMESPACE_SUCCESS);
                 $this->flashMessenger()->addMessage('Los datos del alumno han sido actualizados');
				 // Redirect to index
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
         	//view status messages
             $this->flashMessenger()->setNamespace(FlashMessenger::NAMESPACE_DEFAULT);
             $this->flashMessenger()->addMessage('Has intentado borrar a un alumno que no ha sido registrado');
			 // Redirect to index
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
             $this->flashMessenger()	->setNamespace(FlashMessenger::NAMESPACE_SUCCESS);
              $this->flashMessenger()	->addMessage('El alumno ha sido eliminado');
              
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
	
	
	public function mostrarAction() {
		return new ViewModel();
	}

	

}

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

    public function getAlumnosTable() {
        if (!$this->alumnosTable) {
            $sm = $this->getServiceLocator();
            $this->alumnosTable = $sm->get('Alumnos\Model\AlumnosTable');
        }
        return $this->alumnosTable;
    }
	
	
	public function indexAction() {
		$form = new BusquedaForm();
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
		$result=NULL;
		 $form = new BusquedaForm();
         $form->get('submit')->setValue('Buscar');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $alumno = new Alumnos();
             $form->setInputFilter($alumno->getInputFilter());
             $form->setData($request->getPost())->isValid();

             $alumno->exchangeArray($form->getData());
                     
             $nombre= $alumno->nombres;
			 $aPaterno= $alumno->aPaterno;
			 $aMaterno = $alumno->aMaterno;
			 $folio= $alumno->folioExamen;
				
			$result=$this->getAlumnosTable()->findAlumno($nombre,$aPaterno,$aMaterno, $folio);
				
			if (!$result || $result==NULL){
				$this->flashMessenger()	->setNamespace(FlashMessenger::NAMESPACE_DEFAULT);
               	$this->flashMessenger()	->addMessage('tu consulta no ha dado resultados');
				
				return new ViewModel( array(
             		'form' => $form,		
             		'alumnos'=> NULL,
				));
					
			}else{
				$this->flashMessenger()	->setNamespace(FlashMessenger::NAMESPACE_SUCCESS);
               	$this->flashMessenger()	->addMessage('esto son los resultados de la consulta');
				
				return new ViewModel( array(
             		'form' => $form,		
             		'alumnos'=> $result,
				));
			}

         }

         return array(
         'form' => $form,
		 'alumnos'=> NULL,
		 );
		
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
                 //return $this->redirect()->toRoute('alumnos');
				 return $this->redirect()->toRoute('alumnos', array(
                 'action' => 'mostrar', 'id' => $id,
             ));
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

             if ($del == 'Si' || $del == 'Borrar') {
                 $id = (int) $request->getPost('id');
                 $this->getAlumnosTable()->deleteAlumno($id);
				 
				 $this->flashMessenger()	->setNamespace(FlashMessenger::NAMESPACE_SUCCESS);
               	 $this->flashMessenger()	->addMessage('El alumno ha sido eliminado');
             }
			 else{
			 	 $this->flashMessenger()	->setNamespace(FlashMessenger::NAMESPACE_DEFAULT);
               	 $this->flashMessenger()	->addMessage('Has cancelado el borrado del alumno');
			 }

             // Redirect to list of albums
             return $this->redirect()->toRoute('alumnos');
         }

         return array(
             'id'    => $id,
             'alumno' => $this->getAlumnosTable()->getAlumno($id),
         );
	}
	
	public function mostrarAction() {
		 $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
         	// Redirect to index
             $this->flashMessenger()	->setNamespace(FlashMessenger::NAMESPACE_DEFAULT);
             $this->flashMessenger()	->addMessage('Has mostrar información de un alumno que no esta inscrito');
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
		 
		 return new ViewModel(array(
            'alumno'=> $alumno,
        ));

	}
	
	
	
	public function pagoAction() {
		return new ViewModel();
	}

}

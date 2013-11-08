<?php

namespace Profesores\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\Plugin\FlashMessenger;
use Profesores\Model\Profesores;  
use Profesores\Form\ProfesoresForm; 

class ProfesoresController extends AbstractActionController {
	
	protected $profesoresTable;
	
	public function getProfesoresTable()
    {
        if (!$this->profesoresTable) {
            $sm = $this->getServiceLocator();
            $this->profesoresTable = $sm->get('Profesores\Model\ProfesoresTable');
        }
        return $this->profesoresTable;
    }
	
	
	public function indexAction() {
		return new ViewModel(array(
            'profesores' => $this->getProfesoresTable()->fetchAll(),
        ));
	}

	public function agregarAction() {
		$form = new ProfesoresForm();
         $form->get('submit')->setValue('Agregar');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $profesor = new Profesores();
             $form->setInputFilter($profesor->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $profesor->exchangeArray($form->getData());
                 $this->getProfesoresTable()->saveProfesor($profesor);

                 // Redirect to index
                 $this->flashMessenger()	->setNamespace(FlashMessenger::NAMESPACE_SUCCESS);
                 $this->flashMessenger()	->addMessage('Has agregado a un nuevo profesor');
                 return $this->redirect()->toRoute('profesores');
             }
         }
         return array('form' => $form);
	}

	public function editarAction() {
		 $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
         	// Redirect to index
             $this->flashMessenger()	->setNamespace(FlashMessenger::NAMESPACE_WARNING);
             $this->flashMessenger()	->addMessage('Has intentado editar a un profesor que no ha sido agregado');
             return $this->redirect()->toRoute('profesor', array(
                 'action' => 'agregar'
             ));
         }

         // Get the Usuario with the specified id.  An exception is thrown
         // if it cannot be found, in which case go to the index page.
         try {
             $profesor = $this->getProfesoresTable()->getProfesor($id);
         }
         catch (\Exception $ex) {
         	 //view status messages
             $this->flashMessenger()->setNamespace(FlashMessenger::NAMESPACE_DANGER);
             $this->flashMessenger()->addMessage('Error al obtener los datos del profesor');
             return $this->redirect()->toRoute('profesores', array(
                 'action' => 'index'
             ));
		 }

         $form  = new ProfesoresForm();
         $form->bind($profesor);
         $form->get('submit')->setAttribute('value', 'Editar');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $form->setInputFilter($profesor->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $this->getProfesoresTable()->saveProfesor($profesor);

                 //view status messages
                 $this->flashMessenger()->setNamespace(FlashMessenger::NAMESPACE_SUCCESS);
                 $this->flashMessenger()->addMessage('Los datos del profesor han sido actualizados');
				 // Redirect to index
                 return $this->redirect()->toRoute('profesores');
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
             $this->flashMessenger()->setNamespace(FlashMessenger::NAMESPACE_WARNING);
             $this->flashMessenger()->addMessage('Has intentado borrar a un profesor que no ha sido agregado');
			 // Redirect to index
             return $this->redirect()->toRoute('profesores');
         }

         $request = $this->getRequest();
         if ($request->isPost()) {
             $del = $request->getPost('del', 'No');

             if ($del == 'Si') {
                 $id = (int) $request->getPost('id');
                 $this->getProfesoresTable()->deleteProfesor($id);
             }

             // Redirect to index
             $this->flashMessenger()	->setNamespace(FlashMessenger::NAMESPACE_SUCCESS);
              $this->flashMessenger()	->addMessage('El profesor ha sido eliminado');
              
             return $this->redirect()->toRoute('profesores');
         }

         return array(
             'id'    => $id,
             'profesor' => $this->getProfesoresTable()->getProfesor($id),
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

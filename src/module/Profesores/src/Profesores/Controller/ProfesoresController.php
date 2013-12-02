<?php

namespace Profesores\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container as SessionContainer;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\Plugin\FlashMessenger;
use Profesores\Model\Profesores;
use Profesores\Form\ProfesoresForm;
use Profesores\Form\BusquedaForm;

class ProfesoresController extends AbstractActionController {

    protected $profesoresTable;
	
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

    public function getProfesoresTable() {
        if (!$this->profesoresTable) {
            $sm = $this->getServiceLocator();
            $this->profesoresTable = $sm->get('Profesores\Model\ProfesoresTable');
        }
        return $this->profesoresTable;
    }

    public function indexAction() {
    	$this->islogged();
		
        $form = new BusquedaForm();
        $form->get('submit')->setValue('Buscar');

        return new ViewModel(array(
        'form' => $form,
        ));
    }
    
    public function todosAction() {
    	$this->islogged();
	
        return new ViewModel(array(
            'profesores' => $this->getProfesoresTable()->fetchAll(),
        ));
    }

    public function buscarAction() {
    	$this->islogged();
		
        $result = NULL;
        $form = new BusquedaForm();
        $form->get('submit')->setValue('Buscar');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $profesor = new Profesores();
            $form->setInputFilter($profesor->getInputFilter());
            $form->setData($request->getPost())->isValid();

            $profesor->exchangeArray($form->getData());

            $nombre = $profesor->nombres;
            $aPaterno = $profesor->aPaterno;
            $aMaterno = $profesor->aMaterno;
            $mail = $profesor->mail;

            $result = $this->getProfesoresTable()->findProfesor($nombre, $aPaterno, $aMaterno, $mail);

            if (!$result || $result == NULL) {
                $this->flashMessenger()->setNamespace(FlashMessenger::NAMESPACE_DEFAULT);
                $this->flashMessenger()->addMessage('tu consulta no ha dado resultados');

                return new ViewModel(array(
                    'form' => $form,
                    'profesores' => NULL,
                ));
            } else {
                $this->flashMessenger()->setNamespace(FlashMessenger::NAMESPACE_SUCCESS);
                $this->flashMessenger()->addMessage('esto son los resultados de la consulta');

                return new ViewModel(array(
                    'form' => $form,
                    'profesores' => $result,
                ));
            }
        }

        return array(
            'form' => $form,
            'profesores' => NULL,
        );
    }

    public function agregarAction() {
    	$this->islogged();
		
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
                $this->flashMessenger()->setNamespace(FlashMessenger::NAMESPACE_SUCCESS);
                $this->flashMessenger()->addMessage('Has agregado a un nuevo profesor');
                return $this->redirect()->toRoute('profesores');
            }
        }
        return array('form' => $form);
    }

    public function editarAction() {
    	$this->islogged();
		
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            // Redirect to index
            $this->flashMessenger()->setNamespace(FlashMessenger::NAMESPACE_DEFAULT);
            $this->flashMessenger()->addMessage('Has intentado editar a un profesor que no ha sido agregado');
            return $this->redirect()->toRoute('profesores', array(
                        'action' => 'agregar'
            ));
        }

        // Get the Usuario with the specified id.  An exception is thrown
        // if it cannot be found, in which case go to the index page.
        try {
            $profesor = $this->getProfesoresTable()->getProfesor($id);
        } catch (\Exception $ex) {
            //view status messages
            $this->flashMessenger()->setNamespace(FlashMessenger::NAMESPACE_ERROR);
            $this->flashMessenger()->addMessage('Error al obtener los datos del profesor');
            return $this->redirect()->toRoute('profesores', array(
                        'action' => 'index'
            ));
        }

        $form = new ProfesoresForm();
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
                // 
                // Redirect to index
//                return $this->redirect()->toRoute('profesores');
                return $this->redirect()->toRoute('profesores', array(
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
    	$this->islogged();
		
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            //view status messages
            $this->flashMessenger()->setNamespace(FlashMessenger::NAMESPACE_DEFAULT);
            $this->flashMessenger()->addMessage('Has intentado borrar a un profesor que no ha sido agregado');
            // Redirect to index
            return $this->redirect()->toRoute('profesores');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Si' || $del == 'Borrar') {
                $id = (int) $request->getPost('id');
                $this->getProfesoresTable()->deleteProfesor($id);

                $this->flashMessenger()->setNamespace(FlashMessenger::NAMESPACE_SUCCESS);
                $this->flashMessenger()->addMessage('El profesor ha sido eliminado');
            } else {
                $this->flashMessenger()->setNamespace(FlashMessenger::NAMESPACE_DEFAULT);
                $this->flashMessenger()->addMessage('Has cancelado la operación');
            }


            return $this->redirect()->toRoute('profesores');
        }

        return array(
            'id' => $id,
            'profesor' => $this->getProfesoresTable()->getProfesor($id),
        );
    }

    public function mostrarAction() {
    	$this->islogged();
		
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            // Redirect to index
            $this->flashMessenger()->setNamespace(FlashMessenger::NAMESPACE_DEFAULT);
            $this->flashMessenger()->addMessage('El profesor solicitado no se encuentra en el sistema');
            return $this->redirect()->toRoute('profesores', array(
                        'action' => 'agregar'
            ));
        }

        // Get the Usuario with the specified id.  An exception is thrown
        // if it cannot be found, in which case go to the index page.
        try {
            $profesor = $this->getProfesoresTable()->getProfesor($id);
        } catch (\Exception $ex) {
            //view status messages
            $this->flashMessenger()->setNamespace(FlashMessenger::NAMESPACE_ERROR);
            $this->flashMessenger()->addMessage('Error al obtener los datos del profesor');
            return $this->redirect()->toRoute('profesores', array(
                        'action' => 'index'
            ));
        }

        return new ViewModel(array(
            'profesor' => $profesor,
        ));
    }

    public function pagoAction() {
    	$this->islogged();
		
        $this -> flashMessenger() -> setNamespace(FlashMessenger::NAMESPACE_DEFAULT);
		$this -> flashMessenger() -> addMessage('Estamos haciendo mejoras en esta sección, por lo que no se puede acceder');
		return $this -> redirect() -> toRoute('profesores');
    }

}

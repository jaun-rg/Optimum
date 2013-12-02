<?php

namespace Login\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\Plugin\FlashMessenger;
use Login\Model\Usuarios;
use Login\Form\LoginForm;

class LoginController extends AbstractActionController {

	protected $loginTable;
	protected $profesoresTable;

	public function getLoginTable() {
		if (!$this -> loginTable) {
			$sm = $this -> getServiceLocator();
			$this -> loginTable = $sm -> get('Login\Model\UsuariosTable');
		}
		return $this -> loginTable;
	}
	
	
	public function getProfesoresTable()
    {
        if (!$this->profesoresTable) {
            $sm = $this->getServiceLocator();
            $this->profesoresTable = $sm->get('Profesores\Model\ProfesoresTable');
        }
        return $this->profesoresTable;
    }

	public function loginAction() {
		//$result=NULL;
		$form = new LoginForm();
		$form -> get('submit') -> setValue('Ingresar');

		$request = $this -> getRequest();
		if ($request -> isPost()) {
			$auth = new Usuarios();
			$form -> setInputFilter($auth -> getInputFilter());
			$form -> setData($request -> getPost());

			if ($form -> isValid()) {
				$auth -> exchangeArray($form -> getData());

				$username = $auth -> username;
				$pass = $auth -> pass;

				try {
					$result = $this -> getLoginTable() -> authentificate($username, $pass);
				} catch (\Exception $ex) {
					$this -> flashMessenger() -> setNamespace(FlashMessenger::NAMESPACE_ERROR);
					$this -> flashMessenger() -> addMessage('tu correo y/o tu contraseña son incorrectos');
					return array('form' => $form, );
				}

				if (!$result || $result == NULL) {
					$this -> flashMessenger() -> setNamespace(FlashMessenger::NAMESPACE_DEFAULT);
					$this -> flashMessenger() -> addMessage('tu correo y/o tu contraseña son incorrectos');

					return array('form' => $form, );

				}

				//aqui hay que agregar la sesion
				$user_session =  $this -> getProfesoresTable() -> findProfesorForEmail($result->username);
				$session = new Container('user');
				$session->username =(string) ($user_session->nombres.'  '. $user_session->aPaterno.' '. $user_session->aMaterno);	
				$session->role=(string) $result->role;
				$session->ex = true;
				
				$this -> flashMessenger() -> setNamespace(FlashMessenger::NAMESPACE_SUCCESS);
				$this -> flashMessenger() -> addMessage('has ingresado con exito '.$session->offsetGet('username'));
				return $this -> redirect() -> toRoute('home');
				//return array('form' => $form, );

			}

		}

		return array('form' => $form, );

	}

	public function logoutAction() {
		$session = new Container('user');
		//unset($_SESSION['user']); 
		$session->getManager()->getStorage()->clear('user');
		//$session->getManager()->destroy('user');
		session_destroy('user');
		
		$this -> flashMessenger() -> setNamespace(FlashMessenger::NAMESPACE_SUCCESS);
		$this -> flashMessenger() -> addMessage('Cerraste sesión de manera exitosa');
		return $this -> redirect() -> toRoute('login');
	}

}

<?php
 
namespace Application\Controller;
 
use Application\Form\LoginForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
 
class AccountController extends AbstractActionController
{
    /**
     * Login page, shows and process login form
     */
    public function loginAction()
    {
        $authService = $this->getServiceLocator()->get('AuthService');
        // Si el usuario ya inicio sesion, redirige a la home
        if ( $authService->hasIdentity() ) {
        	$identity = $authService->getIdentity();
            return $this->redirect()->toRoute('alumnos');
			
        }
         
        // Cerramos cualquier sesion que pueda quedar
        $authService->clearIdentity();
         
        // Obetenemos el formulaio
        $form = new LoginForm();
         
        // Si el usuario ha enviado el formulario
        if ( $this->request->isPost() ) {
            $form->setData($this->request->getPost());
            // Validamos el formulario
            if ( $form->isValid() ) {
                // Preparamos el adaptador auth
                $authAdapter = $authService->getAdapter();
                $authAdapter->setIdentity($form->get('identity')->getValue())
                    ->setCredential($form->get('credential')->getValue());
                 
                // Intentamos autentificar el usuario
                $result = $authAdapter->authenticate();
				
				
				if ($result->isValid()) {
   					//$result->getIdentity() === $auth->getIdentity();
    				//$result->getIdentity() === $username;
					 return $this->redirect()->toRoute('alumnos');
				}
				
 
                // ... con el resultado podemos, ya sea almacenar el usuario en la sesion
                // O mostrar un mensaje de error si la autentificacion falló
            }
        }
 
        return new ViewModel(array(
            'form' => $form,
        ));
    }
}
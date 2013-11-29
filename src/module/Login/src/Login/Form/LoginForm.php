<?php

//4. Definicion de formulario de logeo

namespace Login\Form;
 
use Zend\Form\Form;
 
class LoginForm extends Form
{
    public function __construct ($name = null, $options = array())
    {
        parent::__construct('loginform');
         
        $this->setAttribute('method', 'POST');
         
        // Nombre de usuario
        $this->add(array(
            'type' => 'Zend\Form\Element\Email',
            'name' => 'username',
            'options' => array(
                'label' => 'Correo Electrónico',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                )
            ),
            'attributes' => array(
        		'placeholder' => 'Ingresa tu correo',
                'class' => 'form-control',
        		'required' => 'required',
        		'title'=> 'Ingresa un correo',
    		),
             
        ));
         
        // Contraseña
        $this->add(array(
            'type' => 'Zend\Form\Element\Password',
            'name' => 'pass',
            'options' => array(
                'label' => 'Contraseña',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StringTrim'),
                )
            ),
            'attributes' => array(
        		'placeholder' => 'Ingresa tu contraseña',
                'class' => 'form-control',
        		'required' => 'required',
        		'title'=> 'este campo no puede quedar vacío',
    		),
        ));
		
		
        // Proteccion CSRF
        $this->add(array(
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'csrfcheck',
        ));
         
        // Botón submit
        $this->add(array(
            'type' => 'Zend\Form\Element\Submit',
            'name' => 'submit',
            'attributes' => array(
                'value' => 'Ingresar'
            )
        ));
    }
}
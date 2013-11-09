<?php

//4. Definicion de formulario de logeoo

namespace Application\Form;
 
use Zend\Form\Form;
 
class LoginForm extends Form
{
    public function __construct ($name = null, $options = array())
    {
        parent::__construct('loginform');
         
        $this->setAttribute('method', 'post');
         
        // Nombre de usuario
        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'username',
            'options' => array(
                'label' => 'Nombre de usuario',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                )
            ),
            'attributes' => array(
        		'placeholder' => 'Ingresa tu nombre de usuario',
                'class' => 'form-control',
        		'required' => 'required',
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
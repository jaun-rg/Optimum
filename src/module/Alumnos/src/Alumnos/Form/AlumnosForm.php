<?php
namespace Alumnos\Form;

 use Zend\Form\Form;

 class AlumnosForm extends Form
 {
     public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('alumno');

         $this->add(array(
             'name' => 'idAlumno',
             'type' => 'Hidden',
         ));
		  
		$this->add(array(
	             'name' => 'aPaterno',
	             'type' => 'Text',
	              
	             'options' => array(
	                 'label' => 'Apellido Paterno',
	             ),
	             
	             'attributes' => array(
        			'placeholder' => 'Apellido Paterno',
	                'min'      => 1,
                    'max'      => 100,
                    'pattern'  => '[a-zA-Z][a-zA-Z]*',
                    // 'value'	   => ' ',
                    'class' => 'form-control',
        			//'required' => 'required',
    			),
	         ));
		$this->add(array(
	             'name' => 'aMaterno',
	             'type' => 'Text',
	              
	             'options' => array(
	                 'label' => 'Apellido Materno',  
	             ),
	             
	             'attributes' => array(
        			'placeholder' => 'Apellido Materno',
        			'min'      => 1,
                    'max'      => 100,
                    'pattern'  => '[a-zA-Z][a-zA-Z]*',                    
                    // 'value'	   => ' ',
                    'class' => 'form-control',
        			//'required' => 'required',
    			),
	         ));
		$this->add(array(
	             'name' => 'nombres',
	             'type' => 'Text',
	       
	             'options' => array(
	                 'label' => 'Nombre del Alumno',
	             ),
	             
	             'attributes' => array(
        			'placeholder' => 'Nombre',
        			'min'      => 1,
                    'max'      => 100,
                    'pattern'  => '[a-zA-Z][a-zA-Z]*',
                    'messages' => 'ingresa un dato',
                    // 'value'	   => ' ',
                    'class' => 'form-control',
        			//'required' => 'required',
    			),
	         ));
	    $this->add(array(
	             'name' => 'mail',
	             'type' => 'Zend\Form\Element\Email',
	             
	             'options' => array(
	                 'label' => 'Correo', 
	             ),
	             
	             'attributes' => array(
        			'placeholder' => 'example@server.domain',
                    'value'	   	  => ' ',
                    'class' 	  => 'form-control',
        			//'required' => 'required',
    			),
	         ));
	    $this->add(array(
	             'name' => 'tipoEstudiante',
	             'type' => 'Zend\Form\Element\Select',
	             
	             'options' => array(
	                 'label' => 'Tipo de Estudiante',
	                 'empty_option' => 'Selecciona una opción',
                     'value_options' => array(
                             'regularizacion' => 'Regularización',
                             'ceneval' => 'Ceneval',
                      ),                       
	             ),
	             'attributes' => array(
	             	  'class' 	 => 'form-control',
	             	  'type' => 'Select',
        			//'required' => 'required',
    			),
	         ));
			 
	         
	         $this->add(array(
	             'name' => 'submit',
	             'type' => 'Submit',
	             
	             'attributes' => array(
	                 'value' => 'Go',
	                 'id' => 'submitbutton',
	                 'class'=>'btn btn-default',	         
	             ),
	         ));
	     }
 }

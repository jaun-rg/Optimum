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
	         ));
		$this->add(array(
	             'name' => 'aMaterno',
	             'type' => 'Text',
	             'options' => array(
	                 'label' => 'Apellido Materno',
	             ),
	         ));
		$this->add(array(
	             'name' => 'nombres',
	             'type' => 'Text',
	             'options' => array(
	                 'label' => 'Nombre(s)',
	             ),
	         ));
	    $this->add(array(
	             'name' => 'mail',
	             'type' => 'email',
	             'options' => array(
	                 'label' => 'Correo',
	             ),
	             'attributes' => array(
        			'type' => 'email',
        			//'required' => 'required',
    			),
	         ));
	    $this->add(array(
	             'name' => 'tipoEstudiante',
	             'type' => 'Text',
	             'options' => array(
	                 'label' => 'Tipo de Estudiante',
	             ),
	         ));
			 
	         
	         $this->add(array(
	             'name' => 'submit',
	             'type' => 'Submit',
	             'attributes' => array(
	                 'value' => 'Go',
	                 'id' => 'submitbutton',
	             ),
	         ));
	     }
 }

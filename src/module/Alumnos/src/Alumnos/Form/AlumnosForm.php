<?php

namespace Alumnos\Form;

use Zend\Form\Form;
use Zend\Validator;
use Zend\Validator\Regex;

class AlumnosForm extends Form {

    public function __construct($name = null) {
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
                ////'placeholder' => 'Apellido Paterno',
                'min' => 1,
                'max' => 100,   
                'pattern' => '[a-zñÑáéíóúÁÉÍÓÚüÜA-Z][a-zñÑáéíóúÁÉÍÓÚüÜA-Z]*',
                'class' => 'form-control',
                'required' => 'required',
                'data-toggle'=>'tooltip',
                'title'=>'No debe estar vacio y solo debe contener letras',
            ),
        ));
        $this->add(array(
            'name' => 'aMaterno',
            'type' => 'Text',
            'options' => array(
                'label' => 'Apellido Materno',
            ),
            'attributes' => array(
                //'placeholder' => 'Apellido Materno',
                'min' => 1,
                'max' => 100,
                'pattern' => '[a-zñÑáéíóúÁÉÍÓÚüÜA-Z][a-zñÑáéíóúÁÉÍÓÚüÜA-Z]*',
                'class' => 'form-control',
                'required' => 'required',
                'data-toggle'=>'tooltip',
                'title'=>'No debe estar vacio y solo debe contener letras',
            ),
        ));
        $this->add(array(
            'name' => 'nombres',
            'type' => 'Text',
            'options' => array(
                'label' => 'Nombre del Alumno',
            ),
            'attributes' => array(
                //'placeholder' => 'Nombre',
                'min' => 1,
                'max' => 100,
                'pattern' => '[a-zñÑáéíóúÁÉÍÓÚüÜA-Z][a-zñÑáéíóúÁÉÍÓÚüÜA-Z\s]*',
                'class' => 'form-control',
                'required' => 'required',
                'data-toggle'=>'tooltip',
                'title'=>'No debe estar vacio y solo debe contener letras',
            ),
            
        ));
        $this->add(array(
            'name' => 'mail',
            'type' => 'Zend\Form\Element\Email',
            'options' => array(
                'label' => 'Correo',
            ),
            'attributes' => array(
                //'placeholder' => 'example@server.domain',
                'value' => ' ',
                'class' => 'form-control',
                'required' => 'required', 
                'data-toggle'=>'tooltip',
                'data-html'=>TRUE,
                'title'=>'debe tener el formato example@server.domain',
            ),
        ));
        $this->add(array(
            'name' => 'tipoEstudiante',
            'type' => 'Zend\Form\Element\Select',
            'options' => array(
                'label' => 'Tipo de Estudiante',
                'empty_option' => 'Selecciona una opción',
                'value_options' => array(
                    'CIP' => 'Curso Prepa',
                    'CIU' => 'Curso Univ',
                    'REG' => 'Regularización',
                ),
            ),
            'attributes' => array(
                'class' => 'form-control',
                'type' => 'Select',
                'required' => 'required',
                'data-toggle'=>'tooltip',
                'title'=>'selecciona alguna opción de la lista',
            ),
        ));
        $this->add(array(
            'name' => 'telefonos',
            'type' => 'Text',
            'options' => array(
                'label' => 'Teléfonos',
            ),
            'attributes' => array(
                //'placeholder' => '56739090',
                'min' => 1,
                'max' => 100,
                'pattern' => '*',
                'message' => 'ingresa un dato',
                'class' => 'form-control',
                'required' => 'required',
                'data-toggle'=>'tooltip',
                'title'=>'agrega los números de telefono separados por comas',
            ),
        ));
        $this->add(array(
            'name' => 'curp',
            'type' => 'Text',
            'options' => array(
                'label' => 'CURP',
            ),
            'attributes' => array(
                //'placeholder' => 'RORC910520HDFDMR06',
                'min' => 1,
                'max' => 100,
                'pattern' => '[A-Za-z]{4}[0-9]{6}[A-Za-z]{6}[0-9]{2}',
                'class' => 'form-control',
                'required' => 'required',
                'data-toggle'=>'tooltip',
                'title'=>'debe tener el formato RORC910520HDFDMR06',
            ),
        ));
        $this->add(array(
            'name' => 'folioExamen',
            'type' => 'Text',
            'options' => array(
                'label' => 'Folio de Examen',
            ),
            'attributes' => array(
                //'placeholder' => 'Ingresa folio',
                //'min' => 1,
                'max' => 100,
                'pattern' => '*',
                'messages' => 'ingresa un dato',
                'class' => 'form-control',
                //'required' => 'required',
            ),
        ));
        $this->add(array(
            'name' => 'nombreTutor',
            'type' => 'Text',
            'options' => array(
                'label' => 'Nombre del padre ó tutor',
            ),
            'attributes' => array(
                //'placeholder' => 'Nombre del padre ó tutor',
                'min' => 1,
                'max' => 100,
                'pattern' => '[a-zñÑáéíóúÁÉÍÓÚüÜA-Z][a-zñÑá éíóúÁÉÍÓÚüÜA-Z]*',
                'messages' => 'ingresa un dato',
                'class' => 'form-control',
                'required' => 'required',
                'data-toggle'=>'tooltip',
                'title'=>'Solo debe contener letras',
            ),
        ));


        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Go',
                'id' => 'submitbutton',
                'class' => 'btn btn-default',
            ),
        ));
    }

}

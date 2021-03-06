<?php

namespace Alumnos\Form;

use Zend\Form\Form;

class BusquedaForm extends Form {

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
                'placeholder' => 'Apellido Paterno',
                //'min' => 1,
                'max' => 100,
                'pattern' => '[a-zñÑáéíóúÁÉÍÓÚüÜA-Z][a-zñÑáéíóúÁÉÍÓÚüÜA-Z]*',
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
                //'min' => 1,
                'max' => 100,
                'pattern' => '[a-zñÑáéíóúÁÉÍÓÚüÜA-Z][a-zñÑáéíóúÁÉÍÓÚüÜA-Z]*',
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
                //'min' => 1,
                'max' => 100,
                'pattern' => '[a-zñÑáéíóúÁÉÍÓÚüÜA-Z][a-zñÑáéíóúÁÉÍÓÚüÜA-Z]*',
                'messages' => 'ingresa un dato',
                // 'value'	   => ' ',
                'class' => 'form-control',
                //'required' => 'required',
            ),
        ));
        $this->add(array(
            'name' => 'mail',
            'type' => 'Hidden',
            
        ));
        $this->add(array(
            'name' => 'tipoEstudiante',
            'type' => 'Hidden',
            
        ));
        $this->add(array(
            'name' => 'telefonos',
            'type' => 'Hidden',
        ));
        $this->add(array(
            'name' => 'curp',
            'type' => 'Hidden',
        ));
        $this->add(array(
            'name' => 'folioExamen',
            'type' => 'Text',
            'options' => array(
                'label' => 'folio',
            ),
            'attributes' => array(
                'placeholder' => 'Ingresa folio',
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
            'type' => 'Hidden',
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

<?php

namespace Alumnos\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Alumnos implements InputFilterAwareInterface {

    public $idAlumno;
    public $aPaterno;
    public $aMaterno;
    public $nombres;
    public $mail;
    public $tipoEstudiante;
    public $telefonos;
    public $curp;
    public $folioExamen;
    public $nombreTutor;
    protected $inputFilter;

    public function exchangeArray($data) {
        $this->idAlumno = (!empty($data['idAlumno'])) ? $data['idAlumno'] : null;
        $this->aPaterno = (!empty($data['aPaterno'])) ? $data['aPaterno'] : null;
        $this->aMaterno = (!empty($data['aMaterno'])) ? $data['aMaterno'] : null;
        $this->nombres = (!empty($data['nombres'])) ? $data['nombres'] : null;
        $this->mail = (!empty($data['mail'])) ? $data['mail'] : null;        
        $this->tipoEstudiante = (!empty($data['tipoEstudiante'])) ? $data['tipoEstudiante'] : null;
        $this->telefonos = (!empty($data['telefonos'])) ? $data['telefonos'] : null;
        $this->curp = (!empty($data['curp'])) ? $data['curp'] : null;
        $this->folioExamen = (!empty($data['folioExamen'])) ? $data['folioExamen'] : null;
        $this->nombreTutor = (!empty($data['nombreTutor'])) ? $data['nombreTutor'] : null;
    }

    // Add the following method:
    public function getArrayCopy() {
        return get_object_vars($this);
    }

    // Add content to these methods:
    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception("Not used");
    }

    public function getInputFilter() {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();

            $inputFilter->add(array(
                'name' => 'idAlumno',
                'required' => true,
                'filters' => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'aPaterno',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 100,
                        ),
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'aMaterno',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 100,
                        ),
                    ),
                ),
            ));
            $inputFilter->add(array(
                'name' => 'nombres',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 100,
                        ),
                    ),
                ),
            ));
            $inputFilter->add(array(
                'name' => 'mail',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 100,
                        ),
                    ),
                ),
            ));
            $inputFilter->add(array(
                'name' => 'tipoEstudiante',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 100,
                        ),
                    ),
                ),
            ));
            $inputFilter->add(array(
                'name' => 'telefonos',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 100,
                        ),
                    ),
                ),
            ));
            $inputFilter->add(array(
                'name' => 'curp',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 100,
                        ),
                    ),
                ),
            ));
            $inputFilter->add(array(
                'name' => 'folioExamen',
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 100,
                        ),
                    ),
                ),
            ));
            $inputFilter->add(array(
                'name' => 'nombreTutor',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 100,
                        ),
                    ),
                ),
            ));


            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

    public function getConsultFilter() {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();

            $inputFilter->add(array(
                'name' => 'idAlumno',
                'filters' => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'aPaterno',
                //'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            //'min' => 1,
                            'max' => 100,
                        ),
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'aMaterno',
                //'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            //'min' => 1,
                            'max' => 100,
                        ),
                    ),
                ),
            ));
            $inputFilter->add(array(
                'name' => 'nombres',
                //'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            //'min' => 1,
                            'max' => 100,
                        ),
                    ),
                ),
            ));
            $inputFilter->add(array(
                'name' => 'mail',
                //'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            //'min' => 1,
                            'max' => 100,
                        ),
                    ),
                ),
            ));
            $inputFilter->add(array(
                'name' => 'tipoEstudiante',
                //'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            //'min' => 1,
                            'max' => 100,
                        ),
                    ),
                ),
            ));
            $inputFilter->add(array(
                'name' => 'telefonos',
                //'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            //'min' => 1,
                            'max' => 100,
                        ),
                    ),
                ),
            ));
            $inputFilter->add(array(
                'name' => 'curp',
                //'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            //'min' => 1,
                            'max' => 100,
                        ),
                    ),
                ),
            ));
            $inputFilter->add(array(
                'name' => 'folioExamen',
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            //'min' => 1,
                            'max' => 100,
                        ),
                    ),
                ),
            ));
            $inputFilter->add(array(
                'name' => 'nombreTutor',
                //'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            //'min' => 1,
                            'max' => 100,
                        ),
                    ),
                ),
            ));


            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}

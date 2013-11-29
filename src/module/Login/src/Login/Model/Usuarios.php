<?php
namespace Login\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Usuarios implements InputFilterAwareInterface {

    public $username;
    public $pass;
    public $role;
    
    protected $inputFilter;

    public function exchangeArray($data) {
        $this->username = (!empty($data['username'])) ? $data['username'] : null;
        $this->pass = (!empty($data['pass'])) ? $data['pass'] : null;
        //$this->role = (!empty($data['role'])) ? $data['role'] : null;
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
                'name' => 'username',
                'filters' => array(
                    array('name' => 'StripTags'),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'pass',
                'filters' => array(
                    array('name' => 'StripTags'),
                ),
            ));
			
			/*$inputFilter->add(array(
                'name' => 'role',
                'filters' => array(
                    array('name' => 'StripTags'),
                ),
            ));*/


            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

   }

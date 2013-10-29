<?php
namespace Admin\Model;

class Profesores
{
    public $idProfesor;
	public $aPaterno;
	public $aMaterno;
	public $nombres;
    public $mail;

    public function exchangeArray($data)
    {
        $this->idProfesor 	= (!empty($data['idProfesor'])) ? $data['idProfesor'] 	: null;
        $this->aPaterno 	= (!empty($data['aPaterno'])) 	? $data['aPaterno'] 	: null;
        $this->aMaterno		= (!empty($data['aMaterno'])) 	? $data['aMaterno'] 	: null;
		$this->nombres 		= (!empty($data['nombres'])) 	? $data['nombres']		: null;
		$this->mail 		= (!empty($data['mail'])) 		? $data['mail'] 		: null;
    }
}
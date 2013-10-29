<?php
namespace Alumnos\Model;

class Alumnos
{
    public $idAlumno;
	public $aPaterno;
	public $aMaterno;
	public $nombres;
    public $mail;
    public $tipoEstudiante;

    public function exchangeArray($data)
    {
        $this->idAlumno			= (!empty($data['idAlumno'])) 		? $data['idAlumno'] 		: null;
        $this->aPaterno 		= (!empty($data['aPaterno'])) 		? $data['aPaterno'] 		: null;
        $this->aMaterno 		= (!empty($data['aMaterno'])) 		? $data['aMaterno'] 		: null;
		$this->nombres 			= (!empty($data['nombres'])) 		? $data['nombres'] 			: null;
		$this->mail 			= (!empty($data['mail'])) 			? $data['mail'] 			: null;
		$this->tipoEstudiante 	= (!empty($data['tipoEstudiante'])) ? $data['tipoEstudiante'] 	: null;
    }
}
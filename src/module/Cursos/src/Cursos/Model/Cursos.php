<?php

namespace Cursos\Model;

class Cursos
{
    public $idCurso;
	public $idProfesor;
	public $idAlumno;
	public $curso;
	public $salon;
	public $horario;

    public function exchangeArray($data)
    {
        $this->idCurso			= (!empty($data['idCurso'])) 		? $data['idCurso'] 			: null;
		$this->idProfesor		= (!empty($data['idProfesor'])) 	? $data['idProfesor'] 		: null;
		$this->idAlumno			= (!empty($data['idAlumno'])) 		? $data['idAlumno'] 		: null;
        $this->curso	 		= (!empty($data['curso'])) 			? $data['curso'] 			: null;
        $this->salon 			= (!empty($data['salon']))	 		? $data['salon'] 			: null;
		$this->horario 			= (!empty($data['horario'])) 		? $data['horario'] 			: null;
		
    }
}
	

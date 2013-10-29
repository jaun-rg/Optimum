<?php
namespace Calificaciones\Model;

class Calificaciones
{
    public $idCalificaciones;	
    public $idCurso;
	public $idAlumno;
	public $fecha;
	public $calificacion;
	public $tipoCalificacion;

    public function exchangeArray($data)
    {
        $this->idCalificaciones	= (!empty($data['idCalificaciones'])) 	? $data['idCalificaciones'] : null;	
        $this->idCurso			= (!empty($data['idCurso'])) 			? $data['idCurso'] 			: null;
		$this->idAlumno			= (!empty($data['idAlumno'])) 			? $data['idAlumno'] 		: null;
        $this->fecha	 		= (!empty($data['fecha'])) 				? $data['fecha'] 			: null;
        $this->calificacion 	= (!empty($data['calificacion']))		? $data['calificacion'] 	: null;
		$this->tipoCalificacion	= (!empty($data['tipoCalificacion '])) 	? $data['tipoCalificacion ']: null;
		
    }
}
	

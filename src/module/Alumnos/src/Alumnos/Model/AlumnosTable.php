<?php

namespace Alumnos\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Where;

use Alumnos\Model\Alumnos; 



class AlumnosTable
{
    protected $tableGateway;
    protected $table ='alumnos';
 

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
	

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getAlumno($id)
    {
       $id = (int)$id;
		$rowset = $this -> tableGateway -> select(array('idAlumno' => $id));
		$row = $rowset -> current();
		
		if (!$row) {
			throw new \Exception("No se pudo encontrar en Alumno con id  $id");
		}
		
		return $row;
    }
	
	public function findAlumno($nombre,$apaterno,$amaterno, $folio)
    {
       
       $sql="";
	   /*
	   $nombre = strtoupper((string)$nombre);
	   $apaterno =strtoupper((string)$apaterno);
	   $amaterno=strtoupper((string)$amaterno);
	   $folio = strtoupper((string)$folio);
	   */
	   $sql.=$nombre!=NULL? "(nombres LIKE '%".strtoupper((string)$nombre)."%')" : ""; 
	   
	   $sql.=$apaterno!=NULL? 
	   		($sql!=NULL? 	" OR (aPaterno LIKE '%".strtoupper((string)$apaterno)."%')" : 
	   						"(aPaterno LIKE '%".strtoupper((string)$apaterno)."%')") : 
	   		"";
	   $sql.=$amaterno!=NULL? 
	   		($sql!=NULL? 	" OR (aMaterno LIKE '%".strtoupper((string)$amaterno)."%')" : 
	   						"(aMaterno LIKE '%".strtoupper((string)$amaterno)."%')") : 
	   		"";
	   $sql.=$folio!=NULL? 
	   		($sql!=NULL? 	" OR (folioExamen LIKE '%".strtoupper((string)$folio)."%')" : 
	   						"(folioExamen LIKE '%".strtoupper((string)$folio)."%')") : 
	   		"";
	   
	   
	  // $sql= 	"(folioExamen LIKE '%".$folio."%') OR (aPaterno LIKE '%".$apaterno.
	  // 			"%') OR (aMaterno LIKE '%".$amaterno."%') OR (nombres LIKE '%".$nombre."%')";
	   
	   
	   $select = new \Zend\Db\Sql\Select ;
       $select->from('alumnos');
       // $select->join('tracks','tracks.album_id = album.id');
	   $select->where($sql);
	   //$select->where(array('album_id'=>$id));
	   /*
	   $select->where->NEST->
                       like('nombres', '%'.$nombre.'%')
                     //       ->OR->
                     //  like('a_paterno', '%'.$apaterno.'%')
                ->UNNEST;
	  */ 
	   
	   //echo $select->getSqlString();
	    $resultSet=NULL;
		try{
       		$resultSet = $this->tableGateway->selectWith($select);
		}
		catch (\Exception $ex) {
         	$resultSet=NULL;	 
         }

       //echo $resultSet->count();
     	return $resultSet;
    }

    public function saveAlumno(Alumnos $alumno)
    {
        $data = array(
            'idAlumno' => $alumno->idAlumno,
            'aPaterno' => $alumno->aPaterno,
            'aMaterno' => $alumno->aMaterno,
            'nombres' => $alumno->nombres,
            'mail' => $alumno->mail,
            'tipoEstudiante' => $alumno->tipoEstudiante,
            'telefonos' => $alumno->telefonos,
            'curp' => $alumno->curp,
            'folioExamen' => $alumno->folioExamen,
            'nombreTutor' => $alumno->nombreTutor,
        );

        $id = (int)$alumno->idAlumno;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getAlumno($id)) {
                $this->tableGateway->update($data, array('idAlumno' => $id));
            } else {
                throw new \Exception('El alumno no existe');
            }
        }
    }

    public function deleteAlumno($id)
     {
         $this->tableGateway->delete(array('idAlumno' => (int) $id));
     }
}
<?php
namespace Profesores\Model;

 use Zend\Db\TableGateway\TableGateway;
 use Profesores\Model\Profesores;

 class ProfesoresTable
 {
     protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }

     public function fetchAll()
     {
         $resultSet = $this->tableGateway->select();
         return $resultSet;
     }

     public function getProfesor($id)
     {
         $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('idProfesor' => $id));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("No encontramos el registro  del Profesor solicitado");
         }
         return $row;
     }

	public function findProfesor($nombre,$apaterno,$amaterno, $curso)
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
	  /*
	   $sql.=$curso!=NULL? 
	   		($sql!=NULL? 	" OR (cursos LIKE '%".strtoupper((string)$curso)."%')" : 
	   						"(cursos LIKE '%".strtoupper((string)$curso)."%')") : 
	   		"";
	   */ 
	   
	   
	  
	   $select = new \Zend\Db\Sql\Select ;
       $select->from('profesores');
       // $select->join('tracks','tracks.album_id = album.id');
	   $select->where($sql);
	   
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

     public function saveProfesor(Profesores $profesor)
     {
         $data = array(
             'idProfesor' 	=> $profesor->idProfesor,
             'aPaterno' 	=> $profesor->aPaterno,
             'aMaterno' 	=> $profesor->aMaterno,
             'nombres' 		=> $profesor->nombres,
             'mail' 		=> $profesor->mail,
             'telefonos'        => $profesor->telefonos,
             
         );

         $id = (int) $profesor->idProfesor;
         if ($id == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getProfesor($id)) {
                 $this->tableGateway->update($data, array('idProfesor' => $id));
             } else {
                 throw new \Exception('El registro del Profesor solicitado no existe');
             }
         }
     }

     public function deleteProfesor($id)
     {
         $this->tableGateway->delete(array('idProfesor' => (int) $id));
     }
 }

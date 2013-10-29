<?php
namespace Admin;

use Admin\Model\Alumnos;
use Admin\Model\AlumnosTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
	
	 public function getServiceConfig()
    {
        return array(
            'factories' => array(
            /****/
                'Admin\Model\AlumnosTable' =>  function($sm) {
                    $tableGateway = $sm->get('AlumnosTableGateway');
                    $table = new AlumnosTable($tableGateway);
                    return $table;
                },
                'AlumnosTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Alumnos());
                    return new TableGateway('alumnos', $dbAdapter, null, $resultSetPrototype);
                },
            /****/
            /****/
                'Admin\Model\CalificacionessTable' =>  function($sm) {
                    $tableGateway = $sm->get('CalificacionesTableGateway');
                    $table = new CalificacionesTable($tableGateway);
                    return $table;
                },
                'CalificacionesTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Calificaciones());
                    return new TableGateway('calificaciones', $dbAdapter, null, $resultSetPrototype);
                },
            /****/
            /****/
                'Admin\Model\CursosTable' =>  function($sm) {
                    $tableGateway = $sm->get('CursosTableGateway');
                    $table = new CursosTable($tableGateway);
                    return $table;
                },
                'CursosTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Cursos());
                    return new TableGateway('cursos', $dbAdapter, null, $resultSetPrototype);
                },
            /****/
            /****/
                'Admin\Model\ProfesoresTable' =>  function($sm) {
                    $tableGateway = $sm->get('ProfesoresTableGateway');
                    $table = new ProfesoresTable($tableGateway);
                    return $table;
                },
                'ProfesoresTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Profesores());
                    return new TableGateway('profesores', $dbAdapter, null, $resultSetPrototype);
                },
            /****/
            ),
        );
    }
	
}

/*
 * Apoyados con composer degfinimos
 * 
    getAutoloaderConfig() { }
 * 
 * y agregamos a composer.json:
 * 
 	"autoload": {
    	"psr-0": { "Album": "module/Album/src/" }
	},
 * 
 * */
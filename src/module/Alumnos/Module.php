<?php
namespace Alumnos;

use Alumnos\Model\Alumnos;
use Alumnos\Model\AlumnosTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module {
	public function getConfig() {
		return
		include __DIR__ . '/config/module.config.php';
	}

	public function getAutoloaderConfig() {
		return array('Zend\Loader\StandardAutoloader' => array('namespaces' => array(__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__, ), ), );
	}

	public function getServiceConfig() {
		return array('factories' => array(
		/****/
		'Alumnos\Model\AlumnosTable' => function($sm) {
			$tableGateway = $sm -> get('AlumnosTableGateway');
			$table = new AlumnosTable($tableGateway);
			return $table;
		}, 'AlumnosTableGateway' => function($sm) {
			$dbAdapter = $sm -> get('Zend\Db\Adapter\Adapter');
			$resultSetPrototype = new ResultSet();
			$resultSetPrototype -> setArrayObjectPrototype(new Alumnos());
			return new TableGateway('alumnos', $dbAdapter, null, $resultSetPrototype);
		},
		/****/

		), );
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
}

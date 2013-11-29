<?php
namespace Login;

use Login\Model\Usuarios;
use Login\Model\UsuariosTable;
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
		'Login\Model\UsuariosTable' => function($sm) {
			$tableGateway = $sm -> get('UsuariosTableGateway');
			$table = new UsuariosTable($tableGateway);
			return $table;
		}, 
		'UsuariosTableGateway' => function($sm) {
			$dbAdapter = $sm -> get('Zend\Db\Adapter\Adapter');
			$resultSetPrototype = new ResultSet();
			$resultSetPrototype -> setArrayObjectPrototype(new Usuarios());
			return new TableGateway('usuarios', $dbAdapter, null, $resultSetPrototype);
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
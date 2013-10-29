<?php
namespace Calificaciones;

use Calificaciones\Model\Calificaciones;
use Calificaciones\Model\CalificacionesTable;
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
	
	public function getServiceConfig() {
		return array('factories' => array(
		/****/
		'Calificaciones\Model\CalificacionesTable' => function($sm) {
			$tableGateway = $sm -> get('CalificacionesTableGateway');
			$table = new CalificacionesTable($tableGateway);
			return $table;
		}, 'CalificacionesTableGateway' => function($sm) {
			$dbAdapter = $sm -> get('Zend\Db\Adapter\Adapter');
			$resultSetPrototype = new ResultSet();
			$resultSetPrototype -> setArrayObjectPrototype(new Calificaciones());
			return new TableGateway('calificaciones', $dbAdapter, null, $resultSetPrototype);
		},
		/****/

		), );
	}
	
}

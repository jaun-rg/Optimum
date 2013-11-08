<?php
namespace Profesores;

use Profesores\Model\Profesores;
use Profesores\Model\ProfesoresTable;
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
		'Profesores\Model\ProfesoresTable' => function($sm) {
			$tableGateway = $sm -> get('ProfesoresTableGateway');
			$table = new ProfesoresTable($tableGateway);
			return $table;
		}, 'ProfesoresTableGateway' => function($sm) {
			$dbAdapter = $sm -> get('Zend\Db\Adapter\Adapter');
			$resultSetPrototype = new ResultSet();
			$resultSetPrototype -> setArrayObjectPrototype(new Profesores());
			return new TableGateway('profesores', $dbAdapter, null, $resultSetPrototype);
		},
		/****/

		), );
	}
	
}

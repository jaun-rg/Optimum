<?php
namespace Login;
/*
use Login\Model\Login;
use Login\Model\LoginTable;
 */
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
	
	/*
	public function getServiceConfig() {
		return array('factories' => array(
		
		'Admin\Model\LoginTable' => function($sm) {
			$tableGateway = $sm -> get('LoginTableGateway');
			$table = new LoginTable($tableGateway);
			return $table;
		}, 'LoginTableGateway' => function($sm) {
			$dbAdapter = $sm -> get('Zend\Db\Adapter\Adapter');
			$resultSetPrototype = new ResultSet();
			$resultSetPrototype -> setArrayObjectPrototype(new Login());
			return new TableGateway('login', $dbAdapter, null, $resultSetPrototype);
		},
	

		), );
	}
	*/
	
}

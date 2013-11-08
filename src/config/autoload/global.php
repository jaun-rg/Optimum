<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */
/*
return array(
    'db' => array(
        'driver'         => 'Pdo',
        'dsn'            => 'mysql:dbname=Escuela;host=localhost',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter'
                    => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
    ),
);
*/

 //NOTA: estas modificaciones son solo para la fase de desarrollo, 
 //modificar a la versión anterior en la fase de producción
$dbParams = array(
    'database'  => 'Escuela',
    'username'  => 'developer',
    'password'  => 'dev-pass',
    'hostname'  => 'localhost',
    // buffer_results - only for mysqli buffered queries, skip for others
    'options' => array('buffer_results' => true)
);
 

return array(
//definimos nuestra conexión a la base de datos 
    'db' => array(
        'driver'         => 'Pdo',
        'dsn'            => 'mysql:dbname=Escuela;host=localhost',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        ),
    ),
//definimos el adaptador interno (a la aplicación) para la base de datos
    'service_manager' => array(
        'factories' => array(
		 
		    
           //definición para fase de desarrollo, comentar en fase de producción
            'Zend\Db\Adapter\Adapter' => function ($sm) use ($dbParams) {
                $adapter = new BjyProfiler\Db\Adapter\ProfilingAdapter(array(
                    'driver'    => 'pdo',
                    'dsn'       => 'mysql:dbname='.$dbParams['database'].';host='.$dbParams['hostname'],
                    'database'  => $dbParams['database'],
                    'username'  => $dbParams['username'],
                    'password'  => $dbParams['password'],
                    'hostname'  => $dbParams['hostname'],
                ));

                if (php_sapi_name() == 'cli') {
                    $logger = new Zend\Log\Logger();
                    // write queries profiling info to stdout in CLI mode
                    $writer = new Zend\Log\Writer\Stream('php://output');
                    $logger->addWriter($writer, Zend\Log\Logger::DEBUG);
                    $adapter->setProfiler(new BjyProfiler\Db\Profiler\LoggingProfiler($logger));
                } else {
                    $adapter->setProfiler(new BjyProfiler\Db\Profiler\Profiler());
                }
                if (isset($dbParams['options']) && is_array($dbParams['options'])) {
                    $options = $dbParams['options'];
                } else {
                    $options = array();
                }
                $adapter->injectProfilingStatementPrototype($options);
                return $adapter;
            }, //termina configuracion fase desarrollo, comentar hasta aqui       
        ),
    ),
    
	
);


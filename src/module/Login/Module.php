<?php
namespace Login;

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
<?php

$dbParams = require('dbParams.php');

return array(
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => function ($sm) use ($dbParams) {
                $adapter = new BjyProfiler\Db\Adapter\ProfilingAdapter(array(
                    'driver'    => 'pdo',
                    'dsn'       => 'mysql:dbname='.$dbParams['database'].';host='.$dbParams['hostname'],
                    'database'  => $dbParams['database'],
                    'username'  => $dbParams['username'],
                    'password'  => $dbParams['password'],
                    'hostname'  => $dbParams['hostname'],
                    'port'      => $dbParams['port'],
                ));
                
                $adapter->setProfiler(new BjyProfiler\Db\Profiler\Profiler);
                $adapter->injectProfilingStatementPrototype();
                return $adapter;
            },
            'entityManagerService' => function($sm) {
            	return $sm->get('Doctrine\ORM\EntityManager');
            },
        ),
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Db\Adapter\AdapterAbstractServiceFactory',
        )
    ),
    'doctrine' => array(
    		'connection' => array(
    				'orm_default' => array(
    						'doctrine_type_mappings' => array( 'enum' => 'string' ),
    						'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
    						'params' => array(
    								'host'     => $dbParams['hostname'],
    								'port'     => $dbParams['port'],
    								'user'     => $dbParams['username'],
    								'password' => $dbParams['password'],
    								'dbname'   => $dbParams['database'],
    						)
    				),
    		)
    ),
);
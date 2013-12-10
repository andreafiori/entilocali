<?php

/* Global Configuration Override */
$dbParams = array(
	'database'  => 'fossobandito',
	'username'  => 'root',
	'password'  => '',
	'hostname'  => 'localhost',
	'port'		=> '3306'
);

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
                ));
                
                $adapter->setProfiler(new BjyProfiler\Db\Profiler\Profiler);
                $adapter->injectProfilingStatementPrototype();
                return $adapter;
            },
        ),
    ),
    /* Doctrine */
    'doctrine' => array(
    		'connection' => array(
    				'orm_default' => array(
    						'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
    						'params' => array(
    								'host'     => $dbParams['hostname'],
    								'port'     => $dbParams['port'],
    								'user'     => $dbParams['username'],
    								'password' => $dbParams['password'],
    								'dbname'   => $dbParams['database'],
    						)
    				)
    		)
    ),
);

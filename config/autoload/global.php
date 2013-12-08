<?php

/* Global Configuration Override */
$dbParams = array(
	'database'  => 'fossobandito',
	'username'  => 'root',
	'password'  => '',
	'hostname'  => 'localhost',
	'port'		=> '3306'
);

/*
'db' => array(
		'driver'         => 'Pdo',
		'dsn'            => 'mysql:dbname='.$dbParams['database'].';host='.$dbParams['hostname'],
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
*/
return array(
	'db' => array(
		'driver' => 'Pdo',
		'dsn'    => 'mysql:dbname='.$dbParams['database'].';host='.$dbParams['hostname'],
	),
	'service_manager' => array(
			'factories' => array(
				'Zend\Db\Adapter\Adapter' => function ($serviceManager) {
					$adapterFactory = new Zend\Db\Adapter\AdapterServiceFactory();
					$adapter = $adapterFactory->createService($serviceManager);

					\Zend\Db\TableGateway\Feature\GlobalAdapterFeature::setStaticAdapter($adapter);
					
					return $adapter;
				}
			),
	),
	'doctrine' => array(
			'connection' => array(
				'orm_default' => array(
						'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
						'params' => array(
								'host'     => $dbParams['hostname'],
								'port'     => '3306',
								'dbname'   => $dbParams['database'],
						)
				)
			)
	),
);

<?php
return array(
		'doctrine' => array(
			'connection' => array(
				'orm_default' => array(
				'doctrine_type_mappings' => array(
					'enum' => 'string'
				),
				'driverClass' =>'Doctrine\DBAL\Driver\PDOMySql\Driver',
				'params' => array(
					'host'     => 'localhost',
					'port'     => '3306',
					'user'     => 'root',
					'password' => '',
					'dbname'   => 'fossobandito',
				),
			),
		)
	)
);
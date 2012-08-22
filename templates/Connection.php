<?php
return array(
    'db' => array(
        'driver'         => '{adapter}',
        'dsn'            => 'mysql:dbname={dbname};host={host}',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        ),
        'username' => '{user}',
        'password' => '{pass}',

    ),
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter'
                    => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
    )
);

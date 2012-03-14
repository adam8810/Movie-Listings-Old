<?php
/**
 * Base Database Config.
 *
 * See the individual environment DB configs for specific config information.
 */

return array(
	'active' => 'development',

	/**
	 * Base config, just need to set the DSN, username and password in env. config.
	 */
	'default' => array(
		'type'        => 'pdo',
		'connection'  => array(
			'persistent' => false,
		),
		'identifier'   => '`',
		'table_prefix' => '',
		'charset'      => 'utf8',
		'caching'      => false,
		'profiling'    => false,
	),

	'redis' => array(
		'default' => array(
//			'hostname'  => '127.0.0.1',
			'port'      => 6379,
		)
	),
        
        'development' => array(
            'type' => 'mysql',
            'connection'     => array(
                'hostname'   => 'server',
                'port'       => '####',
                'database'   => 'movies_database',
                'username'   => 'movies_username',
                'password'   => 'movies_password',
                'persistent' => false
            ),
            'table_prefix'  => '',
            'charset'       => 'utf8',
            'caching'       => false,
            'profiling'     => false
        ),
);

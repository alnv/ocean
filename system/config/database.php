<?php

$GLOBALS['database'] = array(
	
	/*
	 * your current selected database
	 */
	'connected' => 'mysql',
	
	/**
	 * your defined database connections
	 */
	'connections' => array(
		
		/**
		 * mysql database
		 */
		'mysql' => array(
			
			'driver' => 'mysql',
			'host' => 'localhost',
			'database' => 'testdb',
			'username' => 'root',
			'password' => 'root',
			
		),
		
		/**
		 * nicht getestet
		 */
		'sqlite' => array(),
		
		/**
		 * nicht getestet
		 */
		'pgsql' => array()
		
	)
	
);
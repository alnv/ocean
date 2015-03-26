<?php

$GLOBALS['database'] = array(
	
	/*
	 * selected database
	 */
	'connected' => 'mysql',
	
	/**
	 * defined databases
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
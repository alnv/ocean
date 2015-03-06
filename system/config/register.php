<?php

/**
 * modules register array
 * @var mixed
 */
$GLOBALS['register'] = array(
	
	/**
	 * Files		
	 */	
	'Controller' => array('controller'),
	'Models' => array('models'),
	
	/**
	 * Core
	 */	
	'Exception' => array(
		'system/core/Exception'
	),
	'Validator' => array(
		'system/core/Validator'
	),
	'Helper' => array(
		'system/core/Helper'
	),
	'Http' => array(
		'system/core/Http'
	),
	'Database' => array(
		'system/core/Database'
	),
	'Routing' => array(
		'system/core/Routing'
	)
	
);
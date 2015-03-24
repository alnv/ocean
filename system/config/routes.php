<?php
	
/**
 *
 */

$GLOBALS['routes'] = array(
	
	/**
	 * root
	 */	
	'homeIndex' => array(
		'method' => 'get',
		'path' => '/',
		'controller' => 'HomeController.index',
	),
	
	/**
	 * Restful example
	 */	
	'userIndex' => array(
		'method' => 'get',
		'path' => '/user',
		'controller' => 'UserController.index',
	),
	'createUser' => array(
		'method' => 'post',
		'path' => '/user',
		'controller' => 'UserController.create',
	),
	'showUser' => array(
		'method' => 'get',
		'path' => '/user/:id',
		'controller' => 'UserController.show',
	),
	'updateUser' => array(
		'method' => 'put',
		'path' => '/user/:id',
		'controller' => 'UserController.update',
	),
	'deleteUser' => array(
		'method' => 'delete',
		'path' => '/user/:id',
		'controller' => 'UserController.delete',
	)
);
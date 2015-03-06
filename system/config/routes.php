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
	 * Restful user 
	 */	
	'userIndex' => array(
		'method' => 'get',
		'path' => '/user/:id',
		'controller' => 'UserController.index',
	),
	'userDelete' => array(
		'method' => 'delete',
		'path' => 'user/delete/:id',
		'controller' => 'UserController.delete',
	),
	'userCreate' => array(
		'method' => 'post',
		'path' => 'user/create',
		'controller' => 'UserController.create',
	),
	'userUpdate' => array(
		'method' => 'put',
		'path' => 'user/update/:id',
		'controller' => 'UserController.update',
	)
	
);
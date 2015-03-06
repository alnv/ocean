<?php namespace Ocean;
	
/**
 * config files
 */	
require __DIR__ . '/config/app.php';
require __DIR__ . '/config/database.php';
require __DIR__ . '/config/register.php';
require __DIR__ . '/config/routes.php';

/**
 * classloader
 */	
require __DIR__ . '/autoload/ClassLoader.php';

/**
 * start session
 */	
@session_set_cookie_params(0, ('/'));
@session_start();


/**
 * load modules
 */	
ClassLoader::setModules($register);
ClassLoader::register();

/**
 * create session token
 */	
Token::init();

/**
 * init routes
 */
$router = new Router();
$router->init();
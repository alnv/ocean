<?php namespace Ocean;
/*
 *
 * Ocean
 * 
 * Copyright 2015 Alexander Naumov
 * 
 * @license MIT
 */	

/**
 * Class Database
 * 
 * @copyright Alexander Naumov
 * @author Alexander Naumov	
 */	
class Database
{
	
	private static $driver;
	private static $host;
	private static $database;
	private static $username;
	private static $password;
	private static $instance = null;
	
	/**
	 * start PDO Driver
	 */
	private static function getInstance()
	{
		
		if(self::$instance === null)
		{
						
			$connected = &$GLOBALS['database']['connected'];
			$config = &$GLOBALS['database']['connections'][$connected];
			
			self::$driver = $config['driver'];
			self::$host = $config['host'];
			self::$database = $config['database'];
			
			self::$username = $config['username'];
			self::$password = $config['password'];
			
			$dns = self::$driver.':dbname='.self::$database.";host=".self::$host; 
			
			static::$instance = new \PDO($dns, self::$username, self::$password); 
		
		}
		
		return static::$instance;
		
	}
	
	/**
	 * delete database instance
	 */
	public static function close()
	{
		self::$instance = null;
	}
	
	/**
	 * call PDO methdos staticly example: Database::prepare('<sql str>');
	 */	
	public static function __callStatic($name, $args)
	{	
		$callback = array (self::getInstance(), $name);
		return call_user_func_array($callback , $args);
	}
		
}



<?php namespace Ocean;

class Database
{
	
	private static $driver;
	private static $host;
	private static $database;
	private static $username;
	private static $password;
	private static $instance = null;
	
	/**
	 *
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
	
	public static function close()
	{
		self::$instance = null;
	}
	
	/**
	 *
	 */	
	public static function __callStatic($name, $args)
	{	
		$callback = array (self::getInstance(), $name);
		return call_user_func_array($callback , $args);
	}
		
}



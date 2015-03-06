<?php namespace Ocean;

class ClassLoader
{
	
	/**
	 *
	 */	
	private static $modules = null;
	
	/**
	 *
	 */	
	public static function setModules($arr)
	{
		self::$modules = $arr;
	}
	
	
	public static function getModules()
	{
		return self::$modules;
	}
	
	/**
	 *
	 */	
	public static function autoload($namespace)
	{
		
		
		$modules = self::getModules();
		
		foreach ($modules as $module)
		{
		
			foreach($module as $path){
				
				self::load($path, $namespace);
				
			}
					
		}
		
		
	}
	
	/**
	 *
	 */	
	public static function load($path, $namespace)
	{
		
		$class = explode('\\', $namespace);
		$file = $path.'/'.end($class).'.php';

		if(file_exists($file) && is_readable($file))
		{
			include $file;
		}
		
	}
	
	/**
	 *
	 */	
	public static function register()
	{
		
		spl_autoload_register('self::autoload');
		
	}
	
}
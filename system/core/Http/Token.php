<?php namespace Ocean;

/**
 * Ocean
 * 
 * Copyright 2015 Alexander Naumov
 * 
 * @license MIT
 */	


/**
 * Class Token
 * 
 * @copyright Alexander Naumov
 * @author Alexander Naumov	
 */	
class Token
{
	
	/**
	 *
	 */	
	private static $token = null;
	
	/**
	 *
	 */	
	public static function init()
	{
		
		if(isset($_SESSION['REQUEST_TOKEN'])) static::$token = $_SESSION['REQUEST_TOKEN'];
		
		if(static::$token === null) static::generateToken();

	}
	
	/**
	 *
	 */	
	public static function check($token)
	{
		if( $token != '' && static::$token != '' && $token == static::$token ) return true;
		return false;
	}
	
	/**
	 *
	 */	
	private static function generateToken()
	{
		$_SESSION['REQUEST_TOKEN'] = md5(uniqid(mt_rand(), true));
	}
	
	/**
	 *
	 */	
	public static function get()
	{
		return static::$token;
	}

}
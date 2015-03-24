<?php namespace Ocean;

/**
 * Ocean
 * 
 * Copyright 2015 Alexander Naumov
 * 
 * @license MIT
 */	


/**
 * Class Request
 * 
 * @copyright Alexander Naumov
 * @author Alexander Naumov	
 */	
class Request
{
	
	/**
	 * 
	 */	
	public static $instance = null;
	private static $values = array();
	
	/**
	 * return post and get data
	 */	
	private static function getValues()
	{
		
		$values = array();
		if(! empty($_POST) ) $values = $_POST;
		if(! empty($_GET) ) $values = $_GET;
		if(isset($values['_method'])){
			unset($values['_method']);
		}
		return $values;
	}
	
	/**
	 * @param mixed
	 * @return mixed
	 */
	public static function except($input){
		
		$rawValues = static::getValues();
		
		if(is_array($input)){		
			foreach($input as $key){
				if(isset($rawValues[$key])) unset($rawValues[$key]);
			}
		}
		
		foreach($rawValues as $key => $value){	
		
			$str = $value;
			$str = static::getValidStr($str);
			static::$values[$key] = $str;
		
		}
		
		$rawValues = null;
		return static::$values;
		
	}
	
	/**
	 * @return mixed
	 */	
	public static function all()
	{
		
		$rawValues = static::getValues();
		$values = array();
		
		foreach($rawValues as $key => $value){
			
			$str = $value;
			$str = static::getValidStr($str);			
			static::$values[$key] = $str;
			
		}
		
		$rawValues = null;
		
		return static::$values;
	}
	
	/**
	 * @param mixed
	 * @return mixed
	 */	
	public static function only($input)
	{
		
		$rawValues = static::getValues();
		
		if( is_string($input) && isset( $rawValues[$input] ) ){
			
			$str = $rawValues[$input];
			$str = static::getValidStr($str);
			return $str;
			
		}
		
		if(is_array($input)){		
			
			foreach($input as $key){
				
				static::$values[$key] = static::only($key);
				
			}
		
		}
		
		$rawValues = null;
		return static::$values;
		
	}
	
	/**
	 * @param string
	 * @return null
	 */	
	public static function get($input){
		
		$rawValues = static::getValues();
		
		if( isset($rawValues[$input]) ){
		
			$str = $rawValues[$input];
			$str = static::getValidStr($str);
			static::$values[$input] = $str;
			return static::$values[$input];
		}
		
		$rawValues = null;
		return null;
	}
	
	/**
	 * @param string
	 * @return string
	 */	
	private static function getValidStr($str)
	{
		
		$str = ValidEntities::decodeEntities($str);
		$str = ValidEntities::encodeSpecialChars($str);
		$str = ValidEntities::removeHtmlEntities($str);
		$str = ValidEntities::removeSlashes($str);
		return $str;
	}
	
	/**
	 * Return Input (singelton)
	 * @return obj instace
	 */ 	
	public static function getInstance()
	{
		if(self::$instance === null){
			
			static::$instance = new static();
		
		}
		
		return static::$instance;
	
	}

}
<?php namespace Ocean;

/**
 * Ocean
 * 
 * Copyright 2015 Alexander Naumov
 * 
 * @license MIT
 */	


/**
 * Class ValidEntities
 * 
 * @copyright Alexander Naumov
 * @author Alexander Naumov	
 */
 class ValidEntities
 {
	
	/**
	 * @todo docu
	 */
	public static $instance = null;
	 
	/**
	 * @todo docu
	 */	 
	public static function decodeEntities($str)
	{
		
		if($str === null || $str == '') return $str;
		$str = static::preserveEntities($str);
		$str = html_entity_decode($str, ENT_COMPAT, 'UTF-8');
		return $str;
		
	}
	
	/**
	 * @todo docu
	 */
	public static function preserveEntities($str)
	{
		
		if($str === null || $str == '') return $str;
		$find = array('[&amp;]', '&amp;', '[&lt;]', '&lt;', '[&gt;]', '&gt;', '[&nbsp;]', '&nbsp;', '[&shy;]', '&shy;');
		$replace = array('[&]', '[&]', '[lt]', '[lt]', '[gt]', '[gt]', '[nbsp]', '[nbsp]', '[-]', '[-]');
		$str = str_replace($find,$replace,$str);
		return $str;
	}	 
	
	/**
	 * @todo docu
	 */
	public static function encodeSpecialChars($str)
	{
		if ($str === null || $str == '') return $str;
		$find = array('#', '<', '>', '(', ')', '\\', '=');
		$replace = array('&#35;', '&#60;', '&#62;', '&#40;', '&#41;', '&#92;', '&#61;');
		return str_replace($find, $replace, $str);
		
	}
	
	/**
	 * @todo docu
	 */
	public static function removeHtmlEntities($str)
	{
		if ($str === null || $str == '') return $str;
		$str = htmlentities($str, ENT_QUOTES, 'UTF-8');
		return $str;
	} 
	
	/**
	 * @todo docu
	 */
	public static function removeSlashes($str)
	{
		if ($str === null || $str == '') return $str;
		$str = stripslashes($str);
		return $str;
	}
	
	/**
	 * Return Cleaner 
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
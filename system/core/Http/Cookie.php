<?php namespace Ocean;

/**
 * Ocean
 * 
 * Copyright 2015 Alexander Naumov
 * 
 * @license MIT
 */	


/**
 * Class Cookie
 * 
 * @copyright Alexander Naumov
 * @author Alexander Naumov	
 */	
class Cookie extends SetterGetter
{
	

	/**
	 *
	 */	
	public function __construct()
	{
		$this->arrData = $_COOKIE;
	}
	
	/**
	 *
	 */
	public function __destruct()
	{
		$_COOKIE = $this->arrData;
	}
	
	/**
	 * set cookies secure	
	 */	
	public function set($key, $value){
		
		$str = $value;
		$str = Cleaner::decodeEntities($str);
		$str = Cleaner::encodeSpecialChars($str);
		$str = Cleaner::removeTags($str);
		$str = Cleaner::removeSlashes($str);		
		$this->arrData[$key] = $str;
		
	}
	
}
<?php namespace Ocean;

/**
 * Ocean
 * 
 * Copyright 2015 Alexander Naumov
 * 
 * @license MIT
 */	


/**
 * Class Valid
 * 
 * @copyright Alexander Naumov
 * @author Alexander Naumov	
 */
 class Valid
 {
	 /**
	  * @todo docu
	  */	 
	 public static function email($str)
	 {
		 return preg_match('/^([a-zA-Z0-9\._-])+@+([a-zA-Z0-9\._-])+.+([a-zA-Z])/', $str) ? true : false;
	 }
	 
	 /**
	  * @todo docu
	  */	 
	 public static function alpha($str)
	 {
		 return preg_match('/^[A-Za-z]+$/', $str) ? true : false;
	 }
	 
	 /**
	  * @todo docu
	  */	 
	 public static function alphaNummeric($str)
	 {
		 return preg_match('/^[A-Za-z0-9]+$/', $str) ? true : false;
	 }
	 
	 /**
	  * @todo docu
	  */	 
	 public static function alphaDash($str)
	 {
		 return preg_match('/^[A-Za-z0-9_-]+$/', $str) ? true : false;
	 }
	 
	 /**
	  * @todo docu
	  */	 
	 public static function url($str)
	 {
		 return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $str) ? true : false;
	 }
	 
	 
 }
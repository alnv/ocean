<?php namespace Ocean;

/**
 * Ocean
 * 
 * Copyright 2015 Alexander Naumov
 * 
 * @license MIT
 */	


/**
 * Class Dispatcher
 * 
 * @copyright Alexander Naumov
 * @author Alexander Naumov	
 */	
class Dispatcher
{
	
	/**
	 * @param mixed, string
	 */
	public function __construct($match, $ctlStr)
	{
		
		$params = $this->getParameters($match);
		$ctlArr = $this->splitCtl($ctlStr);
		
		$this->callController($params, $ctlArr);
		
	}
	
	/**
	 *  @param mixed, string
	 */	
	private function callController($param, $ctlArr)
	{
		
		//$class = $ctlArr[0];
		$class = $ctlArr[0];
		$action = $ctlArr[1];
		
		if(isset($class))
			$path = ''.__NAMESPACE__.'\\'.$class;
			$controller = new $path;

		if(isset($action))
			call_user_func_array( array($controller, $action), array( $param ) );
		
	}
	
	/**
	 * @param mixed
	 * @return mixed
	 */	
	private function getParameters($match)
	{
		
		$param = array();
		
		foreach($match as $key => $value){
			
			if(is_string($key)){
				$param[$key] = $value;
			}
		
		}
		
		return $param;
		
	}
	
	/**
	 * @param string
	 * @return mixed
	 */	
	private function splitCtl($ctlStr)
	{
		$ctlArr = explode('.', $ctlStr);
		return $ctlArr;
	}
	
}
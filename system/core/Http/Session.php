<?php namespace Ocean;

/**
 * Ocean
 * 
 * Copyright 2015 Alexander Naumov
 * 
 * @license MIT
 */	


/**
 * Class Session
 * 
 * @copyright Alexander Naumov
 * @author Alexander Naumov	
 */	
class Session extends SetterGetter
{

	/**
	 *
	 */	
	public function __construct()
	{
		$this->arrData = $_SESSION;
	}
	
	/**
	 *
	 */
	public function __destruct()
	{
		$_SESSION = $this->arrData;
	}
	
}
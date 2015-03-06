<?php namespace Ocean;

/**
 * Ocean
 * 
 * Copyright 2015 Alexander Naumov
 * 
 * @license MIT
 */	


/**
 * Class StatusCodes
 * 
 * @copyright Alexander Naumov
 * @author Alexander Naumov	
 */	
class StatusCodes
{
	
	/**
	 * @todo docu
	 */	
	public function throwException($code)
	{
		
		switch($code){
							
			case '403':
				$this->throw403();
				break;
			
			case '404':
				$this->throw404();
				break;
			
			case '500':
				$this->throw500();
				break;
			
		}
			
	}
	
	/**
	 * @todo docu
	 */	
	private function throw403()
	{
		$res = new Respone(403);
		$res->sendHeaders();
		include_once 'Views/System/Error/403.html';
		exit;
	}
	
	/**
	 * @todo docu
	 */	
	private function throw404()
	{
		$res = new Respone(404);
		$res->sendHeaders();
		include_once 'Views/System/Error/404.html';
		exit;
	}
	
	/**
	 * @todo docu
	 */	
	private function throw500()
	{
		$res = new Respone(500);
		$res->sendHeaders();
		include_once 'Views/System/Error/500.html';
		exit;
	}
	
}
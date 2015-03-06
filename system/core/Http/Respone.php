<?php namespace Ocean;

/**
 * Ocean
 * 
 * Copyright 2015 Alexander Naumov
 * 
 * @license MIT
 */	


/**
 * Class Respone
 * 
 * @copyright Alexander Naumov
 * @author Alexander Naumov	
 */
class Respone
{
	
	/**
	 * 
	 */	
	private static $statusTexts = array(
		 200 => 'OK',
		 400 => 'Bad Request',
		 403 => 'Forbidden',
     404 => 'Not Found',
		 500 => 'Internal Server Error',
		 502 => 'Bad Gateway',
	);
	
	/**
	 * 
	 */	
	private $statusText;
	
	/**
	 *
	 */
	private $statusCode;
	
	/**
	 *
	 */
	private $headers;
	 
	/**
	 *
	 */
	private $protocol;
	
	 
	/**
	 *
	 */	
	public function __construct($status = 200, $headers = array())
	{
	
		$this->setStatusCodes($status);
		$this->setProtocol();
		$this->setHeaders($headers);
		
	}
	 
	/**
	 *
	 */	
	public function setStatusCodes($status)
	{
		$this->statusCode = $status;
		$this->setStatusText($status);
	}
	
	/**
	 *
	 */
	public function setHeaders($headers)
	{
		$this->headers = $headers;
	}
	 
	/**
	 *
	 */
	public function setStatusText($code)
	{
		$this->statusText = isset(self::$statusTexts[$code]) ? self::$statusTexts[$code] : '';
	}
	
	
	/**
	 *
	 */	
	public function setProtocol($protocol = '')
	{
		if($protocol === '') $protocol = $_SERVER["SERVER_PROTOCOL"];
		$this->protocol = $protocol;
	}
	
	
	public function sendHeaders()
	{
		
		//set header
		header(sprintf('HTTP/%s %s %s', $this->protocol, $this->statusCode, $this->statusText), true, $this->statusCode);
		
		//set headers
		foreach( $this->headers as $key => $value )
		{
			header($key.':'.$value, true, $this->statusCode);
		}
		
	}
	
}
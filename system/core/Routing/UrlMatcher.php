<?php namespace Ocean;

/**
 * Ocean
 * 
 * Copyright 2015 Alexander Naumov
 * 
 * @license MIT
 */	


/**
 * Class UrlMatcher
 * 
 * provides methods for geting request-uri and method(get, post)
 * @copyright Alexander Naumov
 * @author Alexander Naumov	
 */		
class UrlMatcher
{
	
	/**
	 * relative path
	 * @var string
	 */	
	private $requestUri;
	
	/**
	 * path to index.php
	 * @var string
	 */	
	private $requestFile;
	
	/**
	 * request method
	 * @var string
	 */	
	private $formMethod;
	
	
	/**
	 *
	 */
	private $path;
	 
	/**
	 * set $_SERVER['REQUEST_URI']
	 */	
	public function setRequestUri()
	{
		$this->requestUri = strtok($_SERVER['REQUEST_URI'], '?');
	}
	
	/**
	 * get request-uri method
	 * @return string
	 */	
	public function getRequestUri()
	{
		return $this->requestUri;
	}
	
	
	/**
	 * set requestFile method
	 */	
	public function setRequestFile()
	{
		$this->requestFile = $_SERVER['SCRIPT_NAME'];
	}
	
	/**
	 * get requestFile method
	 * @return string
	 */	
	public function getRequestFile()
	{
		return $this->requestFile;
	}
	
	/**
	 * check if input has _method
	 * @return string
	 */
	private function isHiddenMethod()
	{
		
		$method = null;
		
		if( isset($_GET['_method']) )
		{
			$method = $_GET['_method'];
		}
		
		if( isset($_POST['_method']) )
		{
			$method = $_POST['_method'];
		}
		
		return $method;
		
	}
	
	/**
	 * set method
	 */
	public function setMethod()
	{
	
		$hidden = $this->isHiddenMethod();
		$method = is_null($hidden) ? $this->requestMethod() : $hidden;
		
		switch(strtolower($method)){
		
			case 'get':
				$this->formMethod = 'get';
				break;
		
			case 'post':
				$this->formMethod = 'post';
				break;
		
			case 'put':
				$this->formMethod = 'put';
				break;
		
			case 'delete':
				$this->formMethod = 'delete';
				break;
				
			case 'patch':
				$this->formMethod = 'patch';
				break;
				
			case 'head':
				$this->formMethod = 'head';
				break;
	
		}
	}
	
	/**
	 * get form method
	 */
	public function getMethod()
	{
		
		$this->setMethod();
		return $this->formMethod;
	
	}
	
	
	public function requestMethod()
	{
		return $_SERVER['REQUEST_METHOD'];
	}
	
	public function setPath()
	{
		
		$this->setRequestUri();
		$this->setRequestFile();
		
		$path = str_replace( $this->getRequestFile(), '', $this->getRequestUri() );
		
		if(substr($path, -1) == '/') $path = substr($path, 0, -1);
		if($path === '') $path = '/';
		
		$this->path = $path;
		
	}
	
	
	/**
	 * get current path // /user/12345
	 * @return string
	 */
	public function getPath()
	{
		
		$this->setPath();
		return $this->path;
		
	}
	
}
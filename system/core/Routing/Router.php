<?php namespace Ocean;
/*
 *
 * Ocean
 * 
 * Copyright 2015 Alexander Naumov
 * 
 * @license MIT
 */	

/**
 * Class Router
 * 
 * match routes with request uri
 * @copyright Alexander Naumov
 * @author Alexander Naumov	
 */		
class Router
{
	/**
	 * declare UrlMatcher Object
	 * @var object	
	 */	
	private $urlMatcher = null;
	
	/**
	 * current uri request // /user/12345
	 * @var string
	 */
	private $request = null;
	
	/**
	 * routes collection
	 * @var mixed
	 */
	private $routes = array(
	
		'get' => array(),
		'post' => array(),
		'put' => array(),
		'delete' => array(),
		'patch' => array(),
		'head' => array()
		
	);
	
	/**
	 * initialize UrlMatcher
	 */
	public function __construct(){
		
		if( $this->urlMatcher === null ){
		
			$this->urlMatcher = new UrlMatcher();	
		
		}
		
		$this->setRoutes();
		
	} 
	
	private function setRoutes()
	{
		
		$routes = &$GLOBALS['routes'];
		
		foreach($routes as $route)
		{
			call_user_func_array(array($this, $route['method']), array($route['path'], $route['controller']));
		}
	
	}
	
	/**
	 * RESTful methods. save routes in $routes.
	 * @param string(/user:id), string(Class.method)
	 */		
	public function get($uri, $controller)
	{
		
		$cUri = $this->convertUri($uri);
		$this->routes['get'][$cUri] = $controller;
	
	}
	public function post($uri, $controller)
	{
		
		$cUri = $this->convertUri($uri);
		$this->routes['post'][$cUri] = $controller;
	
	}
	public function put($uri, $controller)
	{
		
		$cUri = $this->convertUri($uri);
		$this->routes['put'][$cUri] = $controller;
	
	}
	public function delete($uri, $controller)
	{
		
		$cUri = $this->convertUri($uri);
		$this->routes['delete'][$cUri] = $controller;
	
	}
	public function patch($uri, $controller)
	{
		
		$cUri = $this->convertUri($uri);
		$this->routes['patch'][$cUri] = $controller;
	
	}
	public function head($uri, $controller)
	{
		
		$cUri = $this->convertUri($uri);
		$this->routes['head'][$cUri] = $controller;
	
	}
	
	/**
	 * get routes
	 * @return mixed 
	 */ 	
	public function getRoutes()
	{
	
		return $this->routes;
	
	}
	
	/**
   * convert /user/:id in #^/user/(?P<id>[a-z0-9]+)$#
   * @param string /user/:id 
   * @return string 
   */		
	private function convertUri($uri)
	{
	
		$pattern = '#:([\w]+)\+?#';
		$regex = '#^';
		$struri = trim($uri, '/');
		$arruri = explode('/', $struri);
		
		foreach($arruri as $part){
	
			preg_match($pattern, $part, $match);
	
			if(empty($match)){
	
				$regex = $regex.'/'.$part;
	
			}else{
	
				$regex = $regex.'/(?P<'.$match[1].'>[a-zA-Z0-9]+)';
	
			}
	
		}
		
		$regex = $regex.'$#';
		return $regex;
			
	}
	
	/**
   	 * initialize routes and match uri
   	 */	
	public function init()
	{
		
		$routes = $this->getRoutes();
		$method = $this->urlMatcher->getMethod();

		if( !isset( $routes[$method] ) ){
			
			$sc = new StatusCodes();
			$sc->throwException('500');
		
		}
		
		foreach($routes[$method] as $pattern => $ctl){
	
			$match = $this->match($pattern);
			
			if(!empty($match)){
				
				//create contoller
				new Dispatcher($match, $ctl);
				
				return true;
				
			}
			
		}
		
		$sc = new StatusCodes();
		$sc->throwException('404');
		
	}
	
	/**
	 * check uri if match pattern	
	 * @param string
	 * @return mixed
	 */ 
	private function match($pattern)
	{
		
		$currPath = $this->urlMatcher->getPath();
		preg_match($pattern, $currPath, $matches);
		return $matches;
		
	}
		
}
<?php namespace Ocean;

class HomeController
{

	/**
	 * @path /
	 * http method get
	 */
	public function index()
	{
		/*
		 * your logic
		 */
		include 'views/page/home.php';
	}

}
	
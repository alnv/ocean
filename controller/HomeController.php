<?php namespace Ocean;

class HomeController
{

	public function index()
	{
	
		$user = new User();
		$blog = new Blog();

		$blog->cols = 'id as bid, authorID, title';
		$user->cols = 'id, name, email';
		//$user->limit = '2';
		$user->joinid($blog, 'authorID');
		$users = $user->find();
		include 'views/layout/master.php';
		
	}

}
	
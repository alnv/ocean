<?php namespace Ocean;

class HomeController
{

	public function index()
	{
	
		$user = new User();
		$blog = new Blog();

		$blog->cols = 'id as bid, authorID, title';
		$user->cols = 'id, name, email';
		$user->joinid($blog, 'authorID');
		$users = $user->find();
		var_dump($users);
		include 'views/layout/master.php';
		
	}

}
	
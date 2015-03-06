<?php namespace Ocean;

class UserController
{
	
	public function index($param)
	{
		$user = new User();
		$blog = new Blog();
		$user->cols = 'id as userID, name, email';
		$blog->cols = 'id as blogID, title, created_at, updated_at';
		$user->where = 'oc_user.id = '.$param['id'].'';
		$user->joinid($blog, 'authorID');
		$profile = $user->find();
		var_dump($profile);
	}
	
	public function create()
	{
		$data = Request::all();
		
		$user = new User();
		$user->name = $data['username'];
		$user->email = $data['email'];
		$user->password = $data['password'];
		$user->insert();		
		
		
		
		$blog = new Blog();
		$blog->title = 'Hallo '.$data['username'].'!';
		$blog->authorID = $user->id;
		$blog->insert();
		
		header("Location: http://www.ocean.dev");
	
	}

	public function delete($param)
	{
		$user = new User();
		$user->remove('id = '.$param['id'].'');
		header("Location: http://www.ocean.dev");
	}
	
	public function update($param)
	{
		$user = new User();
		$user->name = Request::get('name');
		$user->update('id='.$param['id'].'');
		header("Location: http://www.ocean.dev");
	}
	
}
	
<?php namespace Ocean;
/**
 * Filename == Classname !!!
 */
class UserController
{

	/**
	 * get /user
	 * show all user
	 */
	public function index()
	{
		/**
		 * create table for my user
		 */
		$user = new User();
		
		/**
		 * create user table [if not exist]
		 */
		$user->create();


		/**
		 * some methods and attributes you can work with
		 * 
		 * $user-where = 'name = "usermame"';
		 * $user->limit = '0,5' #like sql start, max
		 *
		 * you can use joins
		 *
		 * $exampleBlog = new ExampleBlog();
		 * $field = 'authorID';
		 * $user->joinid($exampleBlog, $field);
		 * syntax: $user->join<col> #<col> = your primary key in $user
		 */
		
		/**
		 * get a list of users
		 */
		$users = $user->find();

		/**
		 * load view
		 */
		include 'views/page/user.php';
	}

	/**
	 * post /user
	 * create new user
	 */
	public function create()
	{
		/**
		 * get post data from form with Request class
		 */
		$input = Request::only(array('username', 'message'));

		/**
		 * create instance of User
		 */
		$user = new User();

		/**
         * fill user attributes
         */
		$user->username = $input['username'];
		$user->message = $input['message'];

		/**
		 * insert new table with given attributes
		 */
		$user->insert();

		/**
		 *	Redirect back to user page
		 */
		header("Location: /user");

	}

	/**
	 * get /user/:id
	 * get specific user
	 */
	public function show($param)
	{
		/**
		 * get user id from param
		 */
		$userID = $param['id'];

		/**
		 * create instance of User
		 */
		$user = new User();

		/**
		 * get user with current id
		 */
		$user->where = 'id = '.$userID;
		
		/**
		 * get user object
		 */
		$currentUser = $user->find()[0]; //get first object

		/*
		 * load view
		 */
		include 'views/page/user-profile.php';

	}

	/**
	 * put /user/:id
	 * update user
	 */
	public function update($param)
	{	

		/**
		 * get post data from form with Request class
		 */
		$input = Request::only(array('username', 'message'));

		/**
		 * get user id from param
		 */
		$userID = $param['id'];

		/**
		 * create instance of User
		 */
		$user = new User();

		/**
         * update user attributes
         */
		$user->username = $input['username'];
		$user->message = $input['message'];

		/**
		 * select user
		 */
		$user->where = 'id = '.$userID;

		/**
		 * update user
		 */
		$user->update();

		/**
		 *	Redirect back to user page
		 */
		header("Location: /user");
	}

	/**
	 * delete /user/:id
	 * delete user
	 */
	public function delete($param)
	{	
		/**
		 * get user id from param
		 */
		$userID = $param['id'];

		/**
		 * create instance of User
		 */
		$user = new User();

		/**
		 * select user
		 */
		$user->where = 'id = "'.$userID.'"';

		/**
		 * remove user
		 */
		$user->remove();

		/**
		 *	Redirect back to user page
		 */
		header("Location: /user");
	}

}
	
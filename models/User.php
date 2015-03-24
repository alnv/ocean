<?php namespace Ocean;

class User extends Model
{
	
	/**
	 * your tablename
	 */	
	protected $table = 'oc_user';
	
	/**
	 * your fields
	 */	
	protected $schema = array(
		
		'id' => 'int(12) AUTO_INCREMENT PRIMARY KEY',
		'username' => 'varchar(255)',
		'message' => 'text'

	);
	
}
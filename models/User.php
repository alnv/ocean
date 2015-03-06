<?php namespace Ocean;

class User extends Model
{
	
	/**
	 *
	 */	
	protected $table = 'oc_user';
	
	/**
	 *
	 */	
	protected $schema = array(
		
		'id' => 'int(12) AUTO_INCREMENT PRIMARY KEY',
		'name' => 'varchar(255)',
		'email' => 'varchar(255)',
		'password' => 'varchar(255)',
		
	);
	
}
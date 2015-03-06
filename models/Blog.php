<?php namespace Ocean;

class Blog extends Model
{
	
	/**
	 *
	 */	
	protected $table = 'oc_blog';
	
	/**
	 *
	 */	
	protected $schema = array(
		
		'id' => 'int(12) AUTO_INCREMENT PRIMARY KEY',
		'authorID' => 'int(12)',
		'title' => 'varchar(255)',
		
	);
	
}
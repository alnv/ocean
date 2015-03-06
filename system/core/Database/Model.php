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
 * Class Model
 *
 * Database Mapping Object 
 * @copyright Alexander Naumov
 * @author Alexander Naumov	
 */	
class Model
{
	
	/**
	 * current model id (Database::lastInsertId())
	 * @var string
	 */
	protected $id;
	 	
	/**
	 * @var string
	 */	
	protected $timestamp_format;
	
	/**
	 * @var string
	 */	
	protected $cols = '*';
	
	/**
	 * @var mixed
	 */	
	protected $additionalCols = array();
		
	/**
	 * @var string
	 */	
	public $where;
	
	/**
	 * @var string
	 */	
	public $limit;
	
	/**
	 * joins container for multiply joins strings
 	 * @var array
	 */
	protected $joins = array();
	 
	/**
	 * @var string
	 */
	protected $joinStr;
	 
	/**
	 * initialize the object
	 */	
	public function __construct()
	{
		$this->timestamp_format = &$GLOBALS['app']['timestamp-format'];
		$this->extendSchema();
	}
	
  	/**
   	 * close database method
   	 */
  	public function __destruct()
  	{
		Database::close();
  	} 
    
	/**
	 * get custom attributes
	 */
	public function __get($key)
	{
		return $this->$key;
	}
	
	/**
	 * allow fill the model with custom attributes
	 */
	public function __set($key, $value)
	{
		$this->$key = $value;
	}
	
	/**
	 * creating magic method join<param>($modelObj, 'foreignkey')
	 * $user->joinid($blog, 'authorID');
	 */	
	public function __call($method, $args)
	{
		
		$pkey = str_replace('join', '', $method, $count);
		
		if($count > 0)
		{
			$this->pkey = $this->table.'.'.trim($pkey);
			$this->join($args);	
		}
	
	}	
	
	/**
	 * remove item form model
	 */
	public function remove($query)
	{
		if($query !== '') $query = ' WHERE '.$query;
		$statement = Database::prepare('DELETE FROM '.$this->table.''.$query.';');
		$statement->execute();
	
	}	
	
	/**
	 * update attributes
	 */
 	public function update($query = '', $update = array())
	{

		if($query !== '') $query = ' WHERE '.$query;
		$this->setUpdateAt();
		$this->initProperties($update);
		$model = $this->getValues();
		$updateStr = Helper::assocToCustomStr($model);
		$statement = Database::prepare('UPDATE '.$this->table.' SET '.$updateStr.$query.';');
		$statement->execute();
		
	}
	
	/**
	 * find items
	 */
	public function find()
	{

		$sql = $this->getSelect().' '.$this->getJoins().' '.$this->getWhere().' '.$this->getLimit().';';
		$statement = Database::prepare($sql);
		$statement->execute();
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		return $statement->fetchAll();
		
	}
	
	/**
	 * insert new row
	 */
	public function insert($create = array())
	{
		
		$this->setCreatedAt();
		$this->setUpdateAt();
		$this->initProperties($create);
		$model = $this->getValues();
		$valStr = Helper::arrKeysToStr($model);
		$placeholder = Helper::arrValuesConvertToPlaceholders($model);
		$statement = Database::prepare('INSERT INTO '.$this->table.' ('.$valStr.') VALUES ('.$placeholder.');'  );
		$statement->execute( array_values($model) );
		$this->id = Database::lastInsertId();
	}
		
	/**
	 * create table
	 */	
	public function create()
	{
	
		$schema = $this->schema;
		
		Helper::$customAssign = ' ';
		Helper::$ValueAsStr = false;
		
		$cols = Helper::assocToCustomStr($schema);
		$sql = 'CREATE TABLE IF NOT EXISTS '.$this->table.' ( '.$cols.' );';
		Database::exec($sql);
	
	}
	
	/**
	 * extend current model with created_at and updated_at cols
	 * @return void
	 */	
	protected function extendSchema()
	{
		$extend = array(
			'created_at' => 'DATETIME',
			'updated_at' => 'DATETIME',
		);

		$this->schema = array_merge($this->schema, $extend);
	}
	
	/**
	 * creating sql-inner-join string
	 */
	protected function join($args)
	{

		$this->additionalCols[] = $args[0]->getCols();
		$joinStr = 'INNER JOIN '.$args[0]->table.' ON '.$this->pkey.'='.$args[0]->table.'.'.trim($args[1]);
		$this->addJoin($joinStr);
	
	}
	
	/**
	 * getter
	 */	
	protected function getWhere()
	{
		$where = is_null($this->where) ? '' : $this->where;
		
		if($where !== '')
		{
			$where = 'WHERE '.$where;
		}
		return $where;
	}
	
	/**
	 * getter
	 */	
	protected function getLimit()
	{
		$limit = is_null($this->limit) ? '' : $this->limit;
		
		if($limit !== '')
		{
			$limit = 'LIMIT '.$limit;
		}
		return $limit;
	}
	
	/**
	 * create timestamp for update_at
	 */	
	public function setUpdateAt()
	{
		$this->updated_at = date($this->timestamp_format);
	}
	
	/**
	 * creating sql-select string
	 */	
	private function getSelect()
	{
		return 'SELECT '.$this->getCols().' FROM '.$this->table;	
	}
	
	/**
	 * add joins sql-string to joins container
	 */	
	private function addJoin($joinStr)
	{
		$this->joins[] = $joinStr;
	}
	
	/**
	 *
	 */	
	public function getJoins()
	{
		return implode(' ', $this->joins);
	}
	
	/**
	 *	@todo: überarbeiten..
	 */	
	protected function getCols()
	{
		
		$cols = $this->cols;
		
		if($cols !== '*' && $cols !== '')
		{
			
			$tempArr = array();
			
			foreach(explode(',', $cols) as $col)
			{
				$tempArr[] = $this->table.'.'.trim($col);
			}
			
			$cols = implode(',', $tempArr);
		}
		
		$additionalCols = '';
		
		if( ! empty( $this->additionalCols ) )
		{
			foreach($this->additionalCols as $acols)
			{
				if($acols !== '' && $acols!== '*')
				{
					$additionalCols = ','.$acols;		
				}	
			}
		}
		
		return $cols.$additionalCols;
		
	}
		
	/**
	 * create timestamp for created_at
	 */	
	public function setCreatedAt()
	{
		$this->created_at = date($this->timestamp_format);
	}
	
	/**
	 * get all attributes
	 */
	protected function getValues()
	{
		
		$values = array();
		foreach($this->schema as $field => $sqlStatmant)
		{
			if(isset($this->$field)) $values[$field] = $this->$field;	
		}
		return $values;
		
	}
	
	/**
	 * init proberties if you use parameter
	 */	
	protected function initProperties($arr = array()){
		
		foreach($arr as $key => $value)
		{
			$this->$key = $value;
		}
		
	}
	
}
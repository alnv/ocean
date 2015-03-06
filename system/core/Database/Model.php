<?php namespace Ocean;
	
class Model
{
	
	/**
	 *
	 */
	protected $id;
	 	
	/**
	 *
	 */	
	protected $timestamp_format;
	
	/**
	 *
	 */	
	protected $cols = '*';
	
	/**
	 *
	 */	
	protected $additionalCols = array();
		
	/**
	 *
	 */	
	protected $where;
	
	/**
	 *
	 */	
	protected $limit;
	
	/**
	 *
	 */
	protected $joins = array();
	 
	/**
	 *
	 */
	protected $joinStr;
	 
	/**
	 *
	 */	
	public function __construct()
	{
		$this->timestamp_format = &$GLOBALS['app']['timestamp-format'];
		$this->extendSchema();
	}
	
  	/**
   	*
   	*/
  	public function __destruct()
  	{
		Database::close();
  	} 
    
	/**
	 *
	 */
	public function __get($key)
	{
		return $this->$key;
	}
	
	/**
	 *
	 */
	public function __set($key, $value)
	{
		$this->$key = $value;
	}
	
	/**
	 *
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
	 *
	 */
	public function remove($query)
	{
		if($query !== '') $query = ' WHERE '.$query;
		$statement = Database::prepare('DELETE FROM '.$this->table.''.$query.';');
		$statement->execute();
	
	}	
	
	/**
	 * 
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
	 *
	 */
	public function find()
	{

		$sql = $this->getSelect().' '.$this->getJoins().' '.$this->getWhere().';';
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
	 *
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
	 * 
	 */
	protected function join($args)
	{

		$this->additionalCols[] = $args[0]->getCols();
		$joinStr = 'INNER JOIN '.$args[0]->table.' ON '.$this->pkey.'='.$args[0]->table.'.'.trim($args[1]);
		$this->addJoin($joinStr);
	
	}
	
	/**
	 *
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
	 *
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
	 *
	 */	
	public function setUpdateAt()
	{
		$this->updated_at = date($this->timestamp_format);
	}
	
	/**
	 *
	 */	
	private function getSelect()
	{
		return 'SELECT '.$this->getCols().' FROM '.$this->table;	
	}
	
	/**
	 *
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
	 *
	 */	
	public function setCreatedAt()
	{
		$this->created_at = date($this->timestamp_format);
	}
	
	/**
	 *
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
	 * 
	 */	
	protected function initProperties($arr = array()){
		
		foreach($arr as $key => $value)
		{
			$this->$key = $value;
		}
		
	}
	
}
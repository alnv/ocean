<?php namespace Ocean;
	
class SetterGetter extends AbstractSetterGetter
{
	
	/**
	 *
	 */	
	protected $arrData = array();
	
	/**
	 * set data
	 */
	public function set($key, $value)
	{
		$this->arrData[$key] = $value;
	}
	
	/**
	 * get specific data
	 */	
	public function get($key)
	{
		if( isset($this->arrData[$key]) ) return $this->arrData[$key];
		return false;
	}
	
	/**
	 * get specific data
	 */	
	public function remove($key)
	{
		if( isset($this->arrData[$key]) ) unset ($this->arrData[$key]);
	}
	
	/**
	 * get data
	 */	
	public function all()
	{
			return $this->arrData;
	}
	
	/**
	 * remove data
	 */	
	public function flush()
	{
			return $this->arrData = array();
	}
	
}
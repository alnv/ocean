<?php namespace Ocean;

class Helper
{
	
	public static $customAssign = '=';
	public static $ValueAsStr = true;
	private static $qStr;
	
	public static function arrValuesToStr($arr)
	{
		return implode(',', array_values($arr));
	}
	
	public static function arrValuesConvertToPlaceholders($arr, $str = '?')
	{
		return implode(',', array_fill(0, count($arr), $str));
	}
	
	public static function arrKeysToStr($arr)
	{
		return implode(',', array_keys($arr));
	}
	
	public static function assocToCustomStr($arr)
	{	
	
		$keys = array_keys($arr);
		$values = array_values($arr);
		self::$qStr = self::$ValueAsStr ? '"' : '';
		$arrStr = array_map('static::setStr', $values, $keys);
		return implode( ',', $arrStr );
	
	}
	
	public static function setStr($value, $key){
		
		return $key.''.self::$customAssign.self::$qStr.$value.self::$qStr.'';
		
	}
	
}
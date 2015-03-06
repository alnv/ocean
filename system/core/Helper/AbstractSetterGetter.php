<?php namespace Ocean;

abstract class AbstractSetterGetter
{
	
	abstract protected function set($arrKey, $value);
	abstract protected function get($arrKey);
	abstract protected function all();
	abstract protected function flush();
}
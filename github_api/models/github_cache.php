<?php

class GithubCache extends GithubApiAppModel {
	
	var $name = 'GithubCache';
	var $useTable = 'cache';
	
	function read($type, $params) {
		$key = $this->__name($type, $params);
	    $cache = $this->find('first', array('conditions' => array('name' => $key)));
	    return unserialize($cache['GithubCache']['data']);
	}
	
	function write($type, $params, $blob) {
		$data['GithubCache']['name'] = $this->__name($type, $params);
		$data['GithubCache']['data'] = serialize($blob);
		$this->save($data);
	}
	
	function __name($type, $params = array()) {
		$file  = $type . '-';
		foreach ($params as $key => $value) {
			$file .= $this->__clean($value) . '-';
		}
		return $file . $this->__generateID($params);
	}
	
	function __generateID($params = array()) {
		$str = serialize($params);
		$id = $this->__clean($str);
		return md5($id);
	}
	
	function __clean($str) {
		$strip = array('.',' ','-','_','/',"\\");
		return str_replace($strip, '', $str);
	}
}
?>
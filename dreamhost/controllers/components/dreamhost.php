<?php

class DreamhostComponent extends Object {
	
	var $name = 'Dreamhost';	
	var $params = array();
	var $components = array('Session');
	var $key = '';
		
	function initialize(&$controller, $settings = array()) {
		$this->Settings =& ClassRegistry::init('Setting');
		$this->Settings = $this->Settings->settings();
		$this->key = $this->Settings['key'];
	}

	function startup() {
		App::import('ConnectionManager');
		$this->dreamhost =& ConnectionManager::getDataSource('dreamhost');
	}

	function uuid($prefix = array()) {
		$chars = md5(microtime());
		$uuid  = substr($chars,0,8) . '-';
		$uuid .= substr($chars,8,4) . '-';
		$uuid .= substr($chars,12,4) . '-';
		$uuid .= substr($chars,16,4) . '-';
		$uuid .= substr($chars,20,12);
		return $this->getString($prefix, 'string') . $uuid;	
	}
	
	function getString($array = array(), $type = 'query') {
		$str = '';
		if ($type == 'query') {
			foreach ($array as $key => $value) {
				$str .= $key . '=' . $value . '&';
			} 
		}
		if ($type == 'string') {
			foreach ($array as $key => $value) {
				$str .= $key . $value;
			} 
		}
		return $str;
	}
	
	function save($params) {
		$this->dreamhost->configs($this->key, $this->uuid());		
		return $this->dreamhost->connect('mysql-add_hostname', $params);
	}
	
	function delete($cmd, $params) {
		$this->dreamhost->configs($this->key, $this->uuid());		
		return $this->dreamhost->connect($cmd, $params);
	}
	
	function find($command) {
		$this->dreamhost->configs($this->key, $this->uuid());		
		return $this->dreamhost->connect($command);
	}    
	
}

?>
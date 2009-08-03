<?php

class Repo extends GithubApiAppModel {
		
    var $name = 'Repo';
    var $useTable = false;
	
	var $cmds = array(
    	'search' => 'http://github.com/api/v2/json/repos/search/[repo]',
    	'tree' => 'http://github.com/api/v2/json/tree/show/[owner]/[repo]/[sha]',
    	'subtree' => 'http://github.com/api/v2/json/tree/show/[owner]/[repo]/[sha]/[file]',
    	'branches' => 'http://github.com/api/v2/json/repos/show/[owner]/[repo]/branches',
    	'file' => 'http://github.com/api/v2/json/blob/show/[owner]/[repo]/[sha]/[file]',
    	'commits' => 'http://github.com/api/v2/json/commits/list/[owner]/[repo]/master',
	);

	function find($command, $params = array()) {
	    $this->url = $this->cmds[$command];
	    foreach ($params as $key => $value) {
	        $this->url = str_replace('['.$key.']', $value, $this->url);
	    }
	    // echo $this->url; die;
	    return self::__decode();
	}
	
	function __connect() {
		App::import('HttpSocket');
		$this->Http = new HttpSocket();
		return $this->Http->get($this->url);
	}
	
	function __decode() {   	
		$json = json_decode($this->__connect());
		return Set::reverse($json);
	}

}
?>
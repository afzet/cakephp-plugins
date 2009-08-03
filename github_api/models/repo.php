<?php

class Repo extends GithubApiAppModel {
		
    var $name = 'Repo';
    var $useTable = false;
	
	var $cmds = array(
    	'search' => 'http://github.com/api/v2/json/repos/search/[repo]',
    	'tree' => 'http://github.com/api/v2/json/tree/show/[owner]/[repo]/[sha]',
    	'subtree' => 'http://github.com/api/v2/json/blob/show/[owner]/[repo]/[sha]',
    	'branches' => 'http://github.com/api/v2/json/repos/show/[owner]/[repo]/branches',
    	'file' => 'http://github.com/api/v2/json/blob/show/[owner]/[repo]/[sha]/[file]',
    	'commits' => 'http://github.com/api/v2/json/commits/list/[owner]/[repo]/master',
	);

	function find($command, $params = array()) {
	    $this->url = $this->cmds[$command];
	    foreach ($params as $key => $value) {
	        $this->url = str_replace('['.$key.']', $value, $this->url);
	    }
	    //echo $this->url; die;
	    if ($command == 'subtree') {
	        $raw = $this->__connect();
	        return $this->__rawConvert($raw);
	    }
	    return self::__decode();
	}
	
	function __rawConvert($data) {
	    $splitcontents = explode("\n", $data);
	    foreach ($splitcontents as $key => $value) {
	        $value = str_replace("\t", ' ', $value);
	        list($mode, $type, $sha, $name) = explode(' ', $value);
	        $line['tree'][$key]['mode'] = $mode;
	        $line['tree'][$key]['type'] = $type;
	        $line['tree'][$key]['sha'] = $sha;
	        $line['tree'][$key]['name'] = $name;
	    }
	    // echo '<pre>'; print_r($line); die;
	    return $line;
	}
	
	function __connect() {
		App::import('HttpSocket');
		$this->Http =& new HttpSocket();
		$result = $this->Http->get($this->url);
		// echo '<pre>'; print_r($result); die;
		return $result;
	}
	
	function __decode() {   	
		$json = json_decode($this->__connect());
		return Set::reverse($json);
	}

}
?>
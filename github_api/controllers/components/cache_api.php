<?php

class CacheApiComponent extends Object {
    
	var $name = 'CacheApi';	
	var $components = array('Session');
	
	function search($keyword) {
	    $keywords = $this->Session->read('GithubApi.Search.keywords');
	    
	    // check count
	    if (count($keywords) == 5) {
	        unset($keywords[0]);
	    }
	    
	    // check unique
	    if (!in_array($keyword, $keywords)) {
	        $keywords[] = $keyword;
	    }
	    
	    sort($keywords);
	    $this->Session->write('GithubApi.Search.keywords', array_unique($keywords));
	}
}
?>
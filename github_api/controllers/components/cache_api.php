<?php

class CacheApiComponent extends Object {
    
	var $name = 'CacheApi';	
	var $components = array('Session');
	
	function search($keyword) {
	    $keywords = $this->Session->read('GithubApi.Search.keywords');
	    if (!empty($keywords)) {
	         // check count
    	    if (count($keywords) == 5) unset($keywords[0]);
    	    
    	    // check unique
    	    if (!in_array($keyword, $keywords)) $keywords[] = $keyword;
	    }
	    else {
	         $keywords[] = $keyword;
	    }
	    
	    sort($keywords);
	    $this->Session->write('GithubApi.Search.keywords', array_unique($keywords));
	}
	
	function view($owner, $repo) {
	    $keywords = $this->Session->read('GithubApi.Viewed.keywords');
	    if (!empty($keywords)) {
	         // check count
    	    if (count($keywords) == 5) unset($keywords[0]);
    	    
    	    // check unique
    	    if (!in_array($repo, $keywords)) $keywords[] = array('repo' => $repo, 'owner' => $owner);
	    }
	    else {
	        $keywords[] = array('keyword' => $repo, 'owner' => $owner);
	    }
	    
	    sort($keywords);
	    $this->Session->write('GithubApi.Viewed.keywords', array_unique($keywords));
	}
}
?>
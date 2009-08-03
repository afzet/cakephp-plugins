<?php

class CacheApiComponent extends Object {
    
	var $name = 'CacheApi';	
	//var $components = array('Cache');
	
	function startup() {
	    App::import('Cache');
        Cache::config('cacheapi', array(
            'engine' => 'File',
            'duration'=> '+2 hours',
            'probability'=> 100,
            'path' => APP . 'plugins' . DS . 'github_api' . DS . 'cache',
            'prefix' => 'cake_',
            'lock' => false,
            'serialize' => true)
        );
	}
	
	function search($keyword) {
	    $keywords = Cache::read('GithubApi.Search.keywords', 'cacheapi');
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
	    Cache::write('GithubApi.Search.keywords', array_unique($keywords), 'cacheapi');
	}
	
	function tree($owner, $repo, $sha, $tree) {
	    
	    $tree = Cache::write('GithubApi.Trees', 'cacheapi');
	    if (!empty($tree)) {
	        $trees[$sha] = array('repo' => $repo, 'sha' => $sha, 'owner' => $owner, 'tree' => $tree);
	    }
	    else {
	         $trees[$sha] = array('repo' => $repo, 'sha' => $sha, 'owner' => $owner, 'tree' => $tree);
	    }
	    
	    sort($trees);
	    Cache::write('GithubApi.Tress', array_unique($trees));
	    $trees = Cache::read('GithubApi.Trees', 'cacheapi');
	    echo '<pre>'; print_r($trees);
	}
	
	function view($owner, $repo) {
	    $keywords = Cache::read('GithubApi.Viewed.keywords', 'cacheapi');
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
	    Cache::write('GithubApi.Viewed.keywords', array_unique($keywords), 'cacheapi');
	}
}
?>
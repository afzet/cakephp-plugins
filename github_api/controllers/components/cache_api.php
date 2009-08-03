<?php


class CacheApiComponent extends Object {
    
	var $name = 'CacheApi';	
	
	function startup(&$controller) {
	    App::Import('Cache');
	}
	
	function search($keyword) {
	    $keywords = Cache::read('keywords');
	    $keywords[] = $keyword;
	    sort($keywords);
	    Cache::write('keywords', array_unique($keywords));
	}
	
	function tree($owner, $repo, $sha, $tree) {
	    $trees = Cache::read('trees');
	    $trees[$sha] = array('repo' => $repo, 'sha' => $sha, 'owner' => $owner, 'tree' => $tree);
	    sort($trees);
	    Cache::write('trees', array_unique($trees));
	}
	
	function view($owner, $repo) {
	    $viewed = Cache::read('viewed');
	    $viewed[] = array('repo' => $repo, 'owner' => $owner);
	    sort($viewed);
	    Cache::write('viewed', array_unique($viewed));
	}
	
	function read($key = '') {
	    return Cache::read($key);
	}
	
}
?>
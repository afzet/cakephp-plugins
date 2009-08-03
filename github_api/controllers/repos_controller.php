<?php

class ReposController extends GithubApiAppController {
    
    // defaults
    var $name = 'Repos';
    var $uses = array('GithubApi.Repo', 'GithubApi.GithubCache');
    
    // keys
    var $keys = array('keywords', 'viewed', 'trees', 'blobs');
    
    function index() {   
        $this->search();
        $this->render('search');
    }
    
    function search() {
        if (!empty($this->data)) {
            $data = $this->Repo->find('search', array('repo' => $this->data['Repo']['name']));
            $this->set('data', $data);
        }
    }
    
    function browse($owner, $repo) {
    	$viewed = $this->GithubCache->read('viewed', array($owner, $repo));    	
    	if (!empty($viewed)):
    		$this->redirect(array('action' => 'tree', $owner, $repo, $viewed));
    	else:
	        $info = $this->Repo->find('branches', array('owner' => $owner, 'repo' => $repo));
	        foreach ($info['branches'] as $key => $value):
	            if ($key == 'master'):
	            	$this->GithubCache->write('viewed', array($owner, $repo), $value);
	            	$this->redirect(array('action' => 'tree', $owner, $repo, $value));
	            endif;
	        endforeach;
    	endif;
    }
    
    function commits($owner, $repo) {
        $data = $this->Repo->find('commits', array('owner' => $owner, 'repo' => $repo));
        $data['info'] = $this->__setInfo($repo, $owner);
        $this->set('data', $data);
    }
    
    function tree($owner, $repo, $sha) {
    	$tree = $this->GithubCache->read('tree', array($owner, $repo, $sha));       	
    	if (empty($cachedTree)):
    		$tree = $this->Repo->find('tree', array('owner' => $owner, 'repo' => $repo, 'sha' => $sha));
    		$this->GithubCache->write('tree', array($owner, $repo, $sha), $tree);
    	endif;
    	
    	// structure data 
    	$this->__genTree($tree, $owner, $repo, $sha);
    }
    
    function subtree($owner, $repo, $sha) {
    	$tree = $this->GithubCache->read('tree', array($owner, $repo, $sha));       	
    	if (empty($cachedTree)):
    		$tree = $this->Repo->find('subtree', array('owner' => $owner, 'repo' => $repo, 'sha' => $sha));
    		$this->GithubCache->write('tree', array($owner, $repo, $sha), $tree);
    	endif;
    	
    	// structure data 
    	$this->__genTree($tree, $owner, $repo, $sha);
    }
    
    function blob($owner, $repo, $sha, $file) {
    	$blob = $this->GithubCache->read('blob', array($owner, $repo, $sha, $file));
        if (empty($blob)): 
	        $blob = $this->Repo->find('file', array('owner' => $owner, 'repo' => $repo, 'sha' => $sha, 'file' => $file));
	        $this->GithubCache->write('blob', array($owner, $repo, $sha, $file), $blob);
        endif;
		$this->set('data', $blob['blob']);
		$info = array('owner' => $owner, 'repo' => $repo, 'sha' => $sha, 'file' => $file, 'previous' => $this->referer());
		$this->set('info', $info);
    }
    
    function __setInfo($repo, $owner) {        
        $info['repo'] = $repo;
        $info['owner'] = $owner;
        $info['previous'] = $this->referer();
        return $info;
    }
    
	function __genTree($tree, $owner, $repo, $sha) {
		for ($i = 0; $i < count($tree['tree']); $i++):
            $data['tree'][$i]['name'] = $tree['tree'][$i]['name'];
            $data['tree'][$i]['sha'] = $tree['tree'][$i]['sha'];
            $data['tree'][$i]['type'] = $tree['tree'][$i]['type'];
            
            // last commit details
            $details = $this->Repo->find('commits', array('owner' => $owner, 'repo' => $repo, 'file' => $tree['tree'][$i]['name']));
            
            $data['tree'][$i]['message'] = $details['commits'][0]['message'];
            $data['tree'][$i]['author'] = $details['commits'][0]['committer']['name'];
            $data['tree'][$i]['date'] = $details['commits'][0]['authored_date'];
            $data['tree'][$i]['tree'] = $details['commits'][0]['tree'];            
        endfor;
        $data['info'] = $this->__setInfo($repo, $owner);
        $data['info']['tree'] = $sha;
		$this->set('data', $data);
        $this->render('tree');
	}
}
?>
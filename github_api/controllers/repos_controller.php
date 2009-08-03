<?php

class ReposController extends GithubApiAppController {
    
    // defaults
    var $name = 'Repos';
    var $components = array('GithubApi.CacheApi');
    var $uses = array('GithubApi.Repo');
    
    // keys
    var $keys = array('keywords', 'viewed', 'trees', 'blobs');
    
    function index() {   
        foreach ($this->keys as $key) {
            $data[$key] = $this->CacheApi->read($key);
        }
        $this->set(compact('data'));
    }
    
    function search($term = '') {
        if (!empty($this->data) || !empty($term)) {
            if (isset($this->data)) $repo = $this->data['Repo']['name'];
            else $repo = $term;
            $this->CacheApi->search($repo);
            $data = $this->Repo->find('search', array('repo' => $repo));
            if (!empty($data)) $this->set('data', $data);
            else $this->Session->setFlash('No repos found!');
        }
        $this->readCache('keywords');
    }
    
    function browse($owner, $repo) {
        $this->CacheApi->view($owner, $repo);
        $info = $this->Repo->find('branches', array('owner' => $owner, 'repo' => $repo)); 
        foreach ($info['branches'] as $key => $value):
            if ($key == 'master') $this->redirect(array('action' => 'tree', $owner, $repo, $value));
        endforeach;
    }
    
    function commits($owner, $repo) {
        $data = $this->Repo->find('commits', array('owner' => $owner, 'repo' => $repo));
        // echo '<pre>'; print_r($data); die;
        $data['info'] = $this->__setInfo($repo, $owner);
        $this->set('data', $data);
    }
    
    function tree($owner, $repo, $sha) {
        //if (($tree = $this->__trees($sha)) == false) {
            $tree = $this->Repo->find('tree', array('owner' => $owner, 'repo' => $repo, 'sha' => $sha));
            $this->CacheApi->tree($owner, $repo, $sha, $tree);
        //}
        
        for ($i = 0; $i < count($tree['tree']); $i++):
            $data['tree'][$i]['name'] = $tree['tree'][$i]['name'];
            $data['tree'][$i]['sha'] = $tree['tree'][$i]['sha'];
            $data['tree'][$i]['type'] = $tree['tree'][$i]['type'];
            
            // last commit details
            $details = $this->Repo->find('commits', array('owner' => $owner, 'repo' => $repo, 'file' => $tree['tree'][$i]['name']));
            
            $data['tree'][$i]['message'] = $details['commits'][0]['message'];
            $data['tree'][$i]['author'] = $details['commits'][0]['committer']['name'];
            $data['tree'][$i]['date'] = $details['commits'][0]['committed_date'];
            $data['tree'][$i]['tree'] = $details['commits'][0]['tree'];
            
        endfor;
        $data['info'] = $this->__setInfo($repo, $owner);
		$data['viewed'] = $this->CacheApi->read('viewed');
		$this->set('data', $data);
		
    }
    
    function blob($owner, $repo, $sha, $file) {
        $data = $this->Repo->find('file', array(
                'owner' => $owner, 'repo' => $repo, 'sha' => $sha, 'file' => $file
            ));
		$this->set('data', $data['blob']);
		
		$info = array('owner' => $owner, 'repo' => $repo, 'sha' => $sha, 'file' => $file, 'previous' => $this->referer());
		$this->set('info', $info);
    }
    
    function __setInfo($repo, $owner) {        
        $info['repo'] = $repo;
        $info['owner'] = $owner;
        $info['previous'] = $this->referer();
        return $info;
    }
    
    function readCache($key) {
        return $this->CacheApi->read($key);
    }
    
    function __trees($sha) {
        $trees = $this->CacheApi->read('trees');
        if (!empty($trees)) {
            if (isset($trees[$sha])) return true;
            else return false;
        }
        return false;
    }
}
?>
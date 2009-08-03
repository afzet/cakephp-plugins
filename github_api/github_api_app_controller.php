<?php

class GithubApiAppController extends AppController {
        
    var $helpers = array('Html', 'Form', 'Javascript', 'Time');
    
    function beforeFilter() {
    	$this->plugin = 'github_api';
    }
    
    function beforeRender() {
    	$this->layout = 'github';
    }
    
    function message($message, $redirect = array()) {
        $this->Session->setFlash($message);
        if (!empty($redirect)) $this->redirect($redirect, null, false); 
    }
    
    function echoDebug($data) {
        echo '<pre>'; print_r($data); die;
    }    
    

}
?>
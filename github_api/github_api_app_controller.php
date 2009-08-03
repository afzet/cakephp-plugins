<?php

class GithubApiAppController extends AppController {
        
    var $helpers = array('Html', 'Form', 'Javascript', 'Time');
    
    function beforeFilter() {
        
        // you need to have this function defined somewhere – I guess bootstrap.php in best place
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
<?php

class GithubApiAppController extends AppController {
    
    var $helpers = array('Html', 'Form', 'Javascript');
    var $uses = array('GithubApi.Github');
    
    function message($message, $redirect = array()) {
        $this->Session->setFlash($message);
        if (!empty($redirect)) $this->redirect($redirect, null, false); 
    }
    
    function echoDebug($data) {
        echo '<pre>'; print_r($data); die;
    }
}
?>
<?php

class UsersController extends DreamhostAppController {
	
	var $name = 'Users';
	var $uses = array('Dreamhost.DreamhostUser');
	
	function index() {
		$data = $this->DreamhostUser->getList();
		$this->set(compact('data'));
	}
}
?>
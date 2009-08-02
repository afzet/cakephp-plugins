<?php

class DomainsController extends DreamhostAppController {
	
	var $name = 'Domains';
	var $uses = array('Dreamhost.DreamhostDomain', 'Dreamhost.DreamhostRegistered');
	
	function index() {
		$data = $this->DreamhostDomain->getList();
		$this->set(compact('data'));
	}
	
	function registered() {
		$data = $this->DreamhostRegistered->find('all');
		$this->set(compact('data'));
	}
}
?>
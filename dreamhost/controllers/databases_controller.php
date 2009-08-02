<?php

class DatabasesController extends DreamhostAppController {
	
	var $name = 'Databases';
	var $uses = array('Dreamhost.DreamhostHostname');
	var $components = array('Dreamhost.Dreamhost');
	
	function beforeFilter() {
		parent::beforeFilter();
	}
	
	function index() {
		$data = $this->DreamhostDomain->getList();
		$this->set(compact('data'));
	}
	
	function hostnames() {
		$data = $this->DreamhostHostname->find('all');
		$this->set(compact('data'));
	}
	
	function users() {
		$data = $this->DreamhostDatabase->find('mysql-list_users');
		$this->set(compact('data'));
	}
	
	function delete_hostname($hostname, $id) {
		$response = $this->DreamhostDreamhost->delete('mysql-remove_hostname', array('hostname' => $hostname));
		switch ($response) {
			case 'hostname_removed':
			case 'success':
				$this->Session->setFlash('Hostname Deleted');
				break;
			case 'no_hostname':
			case 'invalid_hostname':
			case 'internal_error_removing_hostname':
				$this->Session->setFlash('Hostname Not Deleted');
				break;
		}
		$this->DreamhostHostname->del($id);
		$this->redirect('hostnames', null, false);
	}
	
	function add_host() {
		if (!empty($this->data)) {
			$hostname = implode('.', $this->data['DreamhostDatabase']);
			$response = $this->DreamhostDreamhost->save(array('hostname' => $hostname));
			$response = str_replace('_', ' ', $response);
			$response = ucwords($response);
			$this->Session->setFlash($response);
			$this->redirect(array('controller' => 'crons', 'action' => 'hostnames'), null, false);
		}
		$domain = $this->Dreamhost->hostnames();
		$this->set(compact('domain'));
	}
	
	function domains() {
		$domains = $this->DreamhostDomain->find('list', array('fields' => array('Domain.id', 'DreamhostDomain.domain')));
		foreach ($domains as $key => $value) {
			$domain[$value] = $value;
		}
		return $domain;
	}
}
?>
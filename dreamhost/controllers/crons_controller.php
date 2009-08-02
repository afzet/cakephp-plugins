<?php

class CronsController extends DreamhostAppController {
	
	var $name = 'Crons';
	var $uses = array('Dreamhost.DreamhostUser', 'Dreamhost.DreamhostDomain', 'Dreamhost.DreamhostRegistered', 'Dreamhost.DreamhostHostname');
	var $components = array('Dreamhost.Dreamhost');
	
	function beforeFilter() {
		parent::beforeFilter();
	}
	
	function setup() {
		echo 'Pulling data from dreamhost';
		$this->users(0);
		$this->domains(0);
		$this->registered(0);
		$this->hostnames(0);
		$this->Session->setFlash('First Data Aggregation done');
		$this->redirect(array('controller' => 'domains'));
	}
	
	function users($redirect = 1) {
		$data = $this->Dreamhost->find('user-list_users');
		$this->DreamhostUser->truncate();
		foreach ($data as $key => $value) {
			
			$users['DreamhostUser'] = (array)$value;
			if ($this->DreamhostUser->check($users) == 0) {
				$this->DreamhostUser->create();
				$this->DreamhostUser->save($users);
				$new++;
			}
			else {
				$this->DreamhostUser->save($users['User']);
				$old++;
			}
		}
		if ($redirect == 1) {			
			$this->Session->setFlash('Database updated');
			$this->redirect(array('controller' => 'users', 'action' => 'index'));
		}
	}
	
	function domains($redirect = 1) {
		$data = $this->Dreamhost->find('domain-list_domains');
		$this->DreamhostDomain->truncate();
		foreach ($data as $key => $value) {
			$domain['DreamhostDomain'] = (array)$value;
			if (isset($value->user) && $value->user != null) {
				$domain['DreamhostDomain']['user_id'] = $this->DreamhostUser->getUser($value->user);
			}
			
			
			if ($this->DreamhostDomain->check($domain) == 0) {
				$this->DreamhostDomain->create();
				$this->DreamhostDomain->save($domain);
			}
			else {
				$this->DreamhostDomain->save($domain['DreamhostDomain']);
			}
		}
		if ($redirect == 1) {	
			$this->Session->setFlash('Database updated');
			$this->redirect(array('controller' => 'domains', 'action' => 'index'));
		}		
	}
	
	
	function hostnames($redirect = 1) {
		$this->domains(0);
		$data = $this->Dreamhost->find('mysql-list_hostnames');
		$this->DreamhostHostname->truncate();
		foreach ($data as $key => $value) {
			$hostname['DreamhostHostname'] = (array)$value;
			$hostname['DreamhostHostname']['domain_id'] = $this->DreamhostDomain->getDomain($value->domain);
			if ($this->DreamhostHostname->check($hostname) == 0) {
				
				$this->DreamhostHostname->create();
				$this->DreamhostHostname->save($hostname);
			}
			else {
				$this->DreamhostHostname->save($hostname['DreamhostHostname']);
			}
		}
		if ($redirect == 1) {	
			$this->Session->setFlash('Database updated');
			$this->redirect(array('controller' => 'databases', 'action' => 'hostnames'));
		}		
	}
	
	function registered($redirect = 1) {
		$data = $this->Dreamhost->find('domain-list_registrations');
		$this->DreamhostRegistered->truncate();
		foreach ($data as $key => $value) {
			$registered['DreamhostRegistered'] = (array)$value;
			
			if ($this->DreamhostRegistered->check($registered) == 0) {
				$this->DreamhostRegistered->create();
				$this->DreamhostRegistered->save($registered);
			}
			else {
				$this->DreamhostReserved->save($registered['DreamhostRegistered']);
			}
		}
		if ($redirect == 1) {	
			$this->Session->setFlash('Database updated');
			$this->redirect(array('controller' => 'domains', 'action' => 'registered'));
		}
		
	}
}
?>
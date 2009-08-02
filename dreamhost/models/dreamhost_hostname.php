<?php

class DreamhostHostname extends DreamhostAppModel {
	
	var $name = 'DreamhostHostname';
	var $belongsTo = array(
		'DreamhostDomain' => array(
			'className' => 'DreamhostDomain',
			'foreignKey' => 'dreamhost_domain_id'	
		)
	);
	
	function getList() {		
		return $this->find('all', array(
			'conditions' => array(
				'DreamhostDomain.type !=' => 'mysqldns'
			),
			'fields' => array(
				'DreamhostDomain.domain', 
				'DreamhostDomain.path', 
				'DreamhostDomain.home', 
				'DreamhostUser.username', 
				'DreamhostUser.password', 
				'DreamhostUser.shell', 
				'DreamhostUser.type'
			)
		));
	}
	
	function check($data) {
		return $this->find('count', array(
			'conditions' => array(
				'domain' => $data['DreamhostHostname']['domain']
			)
		));
		return $domain;
	}
	
	function truncate() {
		$this->query('TRUNCATE TABLE ' . $this->useTable);
	}
}
?>
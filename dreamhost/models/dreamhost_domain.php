<?php

class DreamhostDomain extends DreamhostAppModel {
	
	var $name = 'DreamhostDomain';
	var $actAs = array('Containable');
	var $belongsTo = array(
		'DreamhostUser' => array(
			'className' => 'DreamhostUser',
			'foreignKey' => 'dreamhost_user_id'	
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
				'DreamhostUser.type')
			)
		);
	}	
		
	function getDreamhostDomain($domain) {
		$domains = $this->find('first', array(
			'conditions' => array(
				'DreamhostDomain' => $domain	
			),
			'fields' => array(
				'DreamhostDomain.id'
			)
		));
		return $domains['DreamhostDomain']['id'];
	}
	
	function check($data) {
		return $this->find('count', array(
			'conditions' => array(
				'domain' => $data['DreamhostDomain']['domain']
			)
		));
	}
	
	function truncate() {
		$this->query('TRUNCATE TABLE ' . $this->useTable);
	}
}
?>
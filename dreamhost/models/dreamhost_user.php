<?php

class DreamhostUser extends DreamhostAppModel {
	
	var $name = 'DreamhostUser';
	
	function getList() {		
		return $this->find('all', array(
			'fields' => array('DreamhostUser.username', 'DreamhostUser.home', 'DreamhostUser.password', 'DreamhostUser.shell', 'DreamhostUser.type')
		));
	}
	
	function check($data) {
		return $this->find('count', array(
			'conditions' => array(
				'username' => $data['DreamhostUser']['username']	
			)
		));
	}
	
	function getUser($username) {
		$user = $this->find('first', array(
			'conditions' => array(
				'username' => $username	
			),
			'fields' => array('DreamhostUser.id')
		));
		return $user['DreamhostUser']['id'];
	}
	
	function truncate() {
		$this->query('TRUNCATE TABLE ' . $this->useTable);
	}
}
?>
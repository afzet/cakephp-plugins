<?php

class DreamhostRegistered extends DreamhostAppModel {
	
	var $name = 'DreamhostRegistered';
	var $useTable = 'dreamhost_registered';
	
	function check($data) {
		return $this->find('count', array(
			'conditions' => array(
				'domain' => $data['DreamhostRegistered']['domain']
			)
		));
	}
	
	function truncate() {
		$this->query('TRUNCATE TABLE ' . $this->useTable);
	}
}
?>
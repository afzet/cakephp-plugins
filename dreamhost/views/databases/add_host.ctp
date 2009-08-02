<h2>Add MySQL Hostname</h2>

<?php
echo $form->create('DreamhostDatabase', array('action' => 'add_host'));
echo $form->input('prefix');
echo $form->input('domain', array('type' => 'select', 'empty' => 'Select Domain', 'options' => $domain));
echo $form->end('Add Hostname');
?>
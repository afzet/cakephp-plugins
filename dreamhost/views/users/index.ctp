<h2>Active Users</h2>
<? echo $html->link('Update From Dreamhost', array('controller' => 'crons', 'action' => 'users')); ?>
<table>
	<tr>
		<th>Username</th>		
		<th>Password</th>		
		<th>Server</th>	
		<th>Shell</th>	
		<th>Access</th>	
	</tr>
	<?php foreach($data as $key => $value) { ?>
	<tr>
		<td><?php echo $value['DreamhostUser']['username']; ?></td>
		<td><?php echo $value['DreamhostUser']['password']; ?></td>
		<td><?php echo $value['DreamhostUser']['home']; ?></td>
		<td><?php echo $value['DreamhostUser']['shell']; ?></td>
		<td><?php echo $value['DreamhostUser']['type']; ?></td>
	</tr>
	<?php } ?>
</table>


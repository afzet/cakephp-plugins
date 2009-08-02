<h2>Active Domains</h2>
<? echo $html->link('Update From Dreamhost', array('controller' => 'crons', 'action' => 'domains')); ?>
<table>
	<tr>
		<th>Name</th>		
		<th>Path</th>	
		<th>FTP Address</th>	
		<th>Username</th>	
		<th>Password</th>	
		<th>Access</th>	
	</tr>
	<?php foreach($data as $key => $value) { ?>
	<tr>
		<td><?php echo $value['DreamhostDomain']['domain']; ?></td>
		<td><?php echo $value['DreamhostDomain']['path']; ?></td>
		<td><?php echo $value['DreamhostDomain']['home']; ?></td>
		<td><?php echo $value['DreamhostUser']['username']; ?></td>
		<td><?php echo $value['DreamhostUser']['password']; ?></td>
		<td><?php echo $value['DreamhostUser']['shell'] . ' ' .$value['DreamhostUser']['type']; ?></td>
	</tr>
	<?php } ?>
</table>


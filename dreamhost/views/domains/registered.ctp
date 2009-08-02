<h2>Registered Domains</h2>
<? echo $html->link('Update From Dreamhost', array('controller' => 'crons', 'action' => 'registered')); ?>
<table>
	<tr>
		<th>Name</th>		
		<th>Created</th>	
		<th>Updated</th>	
		<th>Expires</th>	
		<th>DNS (Primary)</th>	
		<th>DNS (Secondary)</th>
		<th>DNS (Tietary)</th>		
	</tr>
	<?php foreach($data as $key => $value) { ?>
	<tr>
		<td><?php echo $value['DreamhostRegistered']['domain']; ?></td>
		<td><?php echo $value['DreamhostRegistered']['modified']; ?></td>
		<td><?php echo $value['DreamhostRegistered']['created']; ?></td>
		<td><?php echo $value['DreamhostRegistered']['expires']; ?></td>
		<td><?php echo $value['DreamhostRegistered']['ns1']; ?></td>
		<td><?php echo $value['DreamhostRegistered']['ns2']; ?></td>
		<td><?php echo $value['DreamhostRegistered']['ns3']; ?></td>
	</tr>
	<?php } ?>
</table>
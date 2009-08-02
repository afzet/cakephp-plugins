<h2>Current Hostnames</h2>
<?php echo $html->link('Update From Dreamhost', array('controller' => 'crons', 'action' => 'hostnames')); ?> | 
<?php echo $html->link('Add Hostname', array('action' =>'add_host'), null, null, false) ?>
<table>
	<tr>
		<th>Domain</th>		
		<th>Server</th>		
		<th>Action</th>		
	</tr>
	<?php foreach($data as $key => $value) { ?>
	<tr>
		<td><?php echo $value['DreamhostDomain']['domain']; ?></td>
		<td><?php echo $value['DreamhostHostname']['home']; ?></td>
		<td>
			<?php
				echo $html->link('Delete', array('action' =>'delete_hostname', $value['DreamhostDomain']['domain'], $value['DreamhostHostname']['id']), null, 'Are you sure?', false)
			?>			
		</td>
	</tr>
	<?php } ?>
</table>
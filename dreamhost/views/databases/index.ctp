<h2>Current Databases</h2>
<table>
	<tr>
		<th>Name</th>		
		<th>Disk Usuage (MB)</th>	
		<th>Type</th>		
	</tr>
	<?php foreach($data as $key => $value) { ?>
	<tr>
		<td><?php echo $value->db; ?></td>
		<td><?php echo $value->disk_usage_mb; ?></td>
		<td><?php echo $value->description; ?></td>
	</tr>
	<?php } ?>
</table>
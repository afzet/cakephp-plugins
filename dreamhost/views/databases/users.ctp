<h2>Current Databases Users</h2>
<table>
	<tr>
		<th>Username</th>		
		<th>Database</th>	
		<th>Hostname</th>	
		<th>Alter</th>	
		<th>Index</th>		
		<th>Create</th>		
		<th>Update</th>		
		<th>Select</th>		
		<th>Insert</th>		
		<th>Drop</th>		
		<th>Delete</th>			
	</tr>
	<?php foreach($data as $key => $value) { ?>
	<tr>
		<td><?php echo $value->username; ?></td>
		<td><?php echo $value->db; ?></td>
		<td>
			<?php 
				if ($value->host == '') echo 'localhost';
				else echo $value->host;
			?>			
		</td>
		<td><?php echo $value->alter_priv; ?></td>
		<td><?php echo $value->index_priv; ?></td>
		<td><?php echo $value->create_priv; ?></td>
		<td><?php echo $value->update_priv; ?></td>
		<td><?php echo $value->select_priv; ?></td>
		<td><?php echo $value->insert_priv; ?></td>
		<td><?php echo $value->drop_priv; ?></td>
		<td><?php echo $value->delete_priv; ?></td>
	</tr>
	<?php } ?>
</table>
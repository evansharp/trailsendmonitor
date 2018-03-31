<div class="pure-g">
	<div class="pure-u-1-3"></div>
	<div class="pure-u-1-3"></div>
	<div class="pure-u-1-3"><h2>Edit Streams</h2></div>

	<div class="pure-u-1">
		<form method="post" action="edit">
		<table class="pure-table pure-table-horizontal">
			<thead>
			<tr>
				<th>Device Id</th>
				<th>Name</th>
				<th>Description</th>
				<th>Device Serial #</th>
				<th>Shunt Resistance</th>
				<th>Actions</th>
			</tr>
			</thead>
			<tbody>
			<?php
			// vars in loop are db column names passed through the streams model
			foreach($streams as $stream):?>
				<tr>
				<td><input class='stealthy' name='id' size='4' value='<?php echo $stream['id'];?>'></td>
				<td><?php echo $stream['name'];?></td>
				<td><?php echo $stream['description'];?></td>
				<td><?php echo $stream['device-serial'];?></td>
				<td><?php echo $stream['shunt_resistance'];?></td>
				<td>
					<a href='<?php echo base_url(); ?>stream/delete/<?php echo $stream['id']; ?>' class='table-action delete-stream' title="Delete"> <i class='fa fa-fw fa-lg fa-trash-o'></i> </a>
					<a href='<?php echo base_url(); ?>stream/edit/<?php echo $stream['id']; ?>' class='table-action' title="Edit">  <i class='fa fa-fw fa-lg fa-pencil'></i> </a>
					<a href='<?php echo base_url(); ?>stream/raw/<?php echo $stream['id']; ?>' class='table-action' title="View Raw Data">  <i class='fa fa-fw fa-lg fa-table'></i> </a>
					<?php if($stream['disabled']){
						$toggle_position = "toggle-off";
					}else{
						$toggle_position = "toggle-on";
					}?>
					<a href='<?php echo base_url(); ?>stream/toggle/<?php echo $stream['id']; ?>' class='table-action' title="Enable/ Disable">  <i class='fa fa-fw fa-lg fa-<?php echo $toggle_position; ?>'></i> </a>
				</td>
				</tr>
			<?php endforeach;?>
			</tbody>
		</table>
		</form>
	</div>
</div>

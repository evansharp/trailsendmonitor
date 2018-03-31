<div class="pure-g">
	<div class="pure-u-1-3"></div>
	<div class="pure-u-1-3"></div>
	<div class="pure-u-1-3"><h2>Edit a Stream</h2></div>

	<form class="pure-form" method="post" action="<?php echo base_url(); ?>stream/edit/<?php echo $stream['id']; ?>">
		<div class="pure-u-1-3"></div>
		<div class="pure-u-1-3">
			<fieldset class="pure-group">
				<input type="text" length="49" size="35" id="new_stream_name" name="new_stream_name" placeholder="Device Name" value="<?php echo $stream['name'];?>">
				<input type="text" length="49" size="35" id="new_stream_serial" name="new_stream_serial" placeholder="Serial Number" value="<?php echo $stream['device-serial'];?>">
				<input type="number" length="4" size="4" id="new_stream_resistance" name="new_stream_resistance" step="0.0001" placeholder="Shunt Resistence (ohms)" value="<?php echo $stream['shunt_resistance'];?>">
			</fieldset>
			<fieldset class="pure-group">
				<textarea id="new_stream_desc" name="new_stream_desc" cols="40" rows="4" placeholder="Description"><?php echo $stream['description'];?></textarea>
			</fieldset>
		</div>
		<div class="pure-u-1-3"></div>
		<div class="pure-u-1-3"></div>
		<div class="pure-u-1-3">

				<button type="submit" class="pure-button pure-button-primary">Save</button>

		</div>
		<div class="pure-u-1-3"></div>

</div>

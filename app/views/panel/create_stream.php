<div class="pure-g">
	<div class="pure-u-1-3"></div>
	<div class="pure-u-1-3"></div>
	<div class="pure-u-1-3"><h2>Create a Stream</h2></div>

	<form class="pure-form" method="post" action="<?php echo base_url(); ?>streams/create">
		<div class="pure-u-1-3"></div>
		<div class="pure-u-1-3">
			<fieldset class="pure-group">
				<input type="text" length="49" size="35" id="new_stream_name" name="new_stream_name" placeholder="Name">
				<input type="text" length="49" size="35" id="new_stream_serial" name="new_stream_serial" placeholder="Device Serial Number">
				<input type="number" length="4" size="4" id="new_stream_resistance" name="new_stream_resistance" step="0.001" placeholder="Shunt Resistence (ohms)">
			</fieldset>
			<fieldset class="pure-group">
				<textarea id="new_stream_desc" name="new_stream_desc" cols="40" rows="4" placeholder="Description"></textarea>
			</fieldset>
		</div>
		<div class="pure-u-1-3"></div>
		<div class="pure-u-1-3"></div>
		<div class="pure-u-1-3">

				<button type="submit" class="pure-button pure-button-primary">Create Stream</button>

		</div>
		<div class="pure-u-1-3"></div>

</div>

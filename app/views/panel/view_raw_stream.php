<div class="pure-g">
	<div class="pure-u-1-3"></div>
	<div class="pure-u-1-3"></div>
	<div class="pure-u-1-3"><h2><?php echo $stream['name'];?>'s Raw Data</h2></div>
</div>
<div class="pure-g">
	<form action="<?php echo base_url(); ?>stream/raw/<?php echo $stream['id']; ?>" method="post">

	<div class="pure-u-1-3">Start Time: <input name="raw_fetch_start_time" type="datetime-local"  autocomplete required></div>
	<div class="pure-u-1-3">End Time: <input name="raw_fetch_end_time" type="datetime-local" autocomplete required></div>
	<div class="pure-u-1-3">
		<select name="label" class="pure-input-1">
			<option value="volts">Volts</option>
			<option value="amps">Amps</option>
		</select>
		<input type="submit" value="Fetch" class="pure-button pure-button-primary align-right">
	</div>

	</form>
</div>
<div class="pure-g">
	<?php if( $range ):?>
		
		<div class="pure-u-1-3"><?php echo $range['start']; ?></div>
		<div class="pure-u-1-3"><?php echo $range['end']; ?></div>
		<div class="pure-u-1-3"></div>

	<?php endif;


	// if the range selection has been done, print the data in a tabel
	if( $raw_data ): ?>
	<br>
	<br>
	<br>
	<div class="pure-u-1">
		<table class="pure-table pure-table-horizontal">
			<thead>
			<tr>
				<th>Time</th>
				<th>Value</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach($raw_data as $datum):?>

				<tr>
					<td><?php echo $datum['timestamp'];?></td>
					<td><?php echo $datum['value'];?></td>
				</tr>

			<?php endforeach;?>
			</tbody>
		</table>
	</div>

	<?php else: ?>
		<div class="pure-u-1">
			<em> No data for selected range </em>
		</div>
	<?php endif; ?>

</div>

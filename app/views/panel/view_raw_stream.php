<div class="pure-g">
	<div class="pure-u-1-3"></div>
	<div class="pure-u-1-3"></div>
	<div class="pure-u-1-3"><h2><?php echo $stream['name'];?>'s Raw Data</h2></div>
</div>
<div class="pure-g">
	<form action="<?php echo base_url(); ?>stream/raw/<?php echo $stream['id']; ?>" method="post">

	<div class="pure-u-1-3">
		Start Time: <input name="raw_fetch_start_time" type="datetime-local" autocomplete required  step="1" value="<?php if(isset( $range['start'] )) echo $range['start']; ?>">
	</div>
	<div class="pure-u-1-3">
		End Time: <input name="raw_fetch_end_time" type="datetime-local" autocomplete required  step="1" value="<?php if(isset($range['end'])) echo $range['end']; ?>">
	</div>
	<div class="pure-u-1-3">
		<input type="submit" value="Fetch" class="pure-button pure-button-primary align-right">
	</div>
	<div class="pure-u-1-3">
		<button id="fill_start_day_ago" class="pure-button">A Day Ago</button>
		<button id="fill_start_hour_ago" class="pure-button">An Hour Ago</button>
		<button id="fill_start_now" class="pure-button">Now</button>
	</div>
	<div class="pure-u-1-3">
		<button id="fill_end_day_ago" class="pure-button">A Day Ago</button>
		<button id="fill_end_hour_ago" class="pure-button">An Hour Ago</button>
		<button id="fill_end_now" class="pure-button">Now</button>
	</div>
	<div class="pure-u-1-3"></div>
	</form>

</div>
<div class="pure-g">
	<?php
	// if the range selection has been done, print the data in a tabel
	if( $raw_data ): ?>
	<div class="pure-u-1-3"><h3> <?php echo ucfirst($result_label); ?> Data</h3></div>
	<div class="pure-u-1-3"></div>
	<div class="pure-u-1-3"></div>

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
					<td><?php echo date(DATE_RFC2822, strtotime( $datum['timestamp']));?></td>
					<td><?php echo $datum['value'];?></td>
				</tr>

			<?php
			//("F j, Y, g:i:s a"
		endforeach;?>
			</tbody>
		</table>
	</div>

	<?php else: ?>
		<div class="pure-u-1">
			<em> No data for selected range </em>
		</div>
	<?php endif; ?>

</div>

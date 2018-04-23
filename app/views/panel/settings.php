<div class="pure-g">
	<div class="pure-u-1-3"></div>
	<div class="pure-u-1-3"></div>
	<div class="pure-u-1-3"><h2>Settings</h2></div>
</div>
<div class="pure-g">
<?php foreach($settings as $setting): ?>

	<form action="settings/update" method="post" class="pure-form">
		<input type="hidden" name="setting_name" value="<?php echo $setting['name'];?>">
		<div class="pure-u-1-3"><?php echo ucwords( str_replace("_", " ", $setting['name'] ) );?></div>
		<div class="pure-u-1-3"><input type="text" name="setting_value" length="25" value="<?php echo $setting['value'];?>"></div>
		<div class="pure-u-1-3"> <input type="submit" class="pure-button" value="Save"> </div>
	</form>

<?php endforeach; ?>
</div>

<div class="pure-g">
	<div class="pure-u-1-1"><h3> Resets </h3> </div>
	<div class="pure-u-1-4">
		<form action="settings/reset_battery_net_ah" method="post" class="pure-form">
			<input type="submit" class="pure-button" value="Reset Battery Ahs">
		</form>
	</div>
	<div class="pure-u-1-4"></div>
	<div class="pure-u-1-4"></div>
	<div class="pure-u-1-4"></div>
</div>

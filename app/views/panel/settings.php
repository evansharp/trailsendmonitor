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
</div>

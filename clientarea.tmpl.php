<table width="100%" cellspacing="0" cellpadding="2" border="1" style="text-align: left;">
<tr>
	<th>Status</th>
	<td><?php echo htmlspecialchars_decode($info['status']); ?></td>
</tr>
<?php if(isset($info['hostname'])) { ?>
<tr>
	<th>Hostname</th>
	<td><?php echo $info['hostname']; ?></td>
</tr>
<?php } ?>
<?php if(isset($info['ip'])) { ?>
<tr>
	<th>External IP</th>
	<td><?php echo $info['ip']; ?></td>
</tr>
<?php } ?>
<?php if(isset($info['privateip'])) { ?>
<tr>
	<th>Private IP</th>
	<td><?php echo $info['privateip']; ?></td>
</tr>
<?php } ?>
<?php if(isset($info['os'])) { ?>
<tr>
	<th>Operating System</th>
	<td><?php echo $info['os']; ?></td>
</tr>
<?php } ?>
<?php if(isset($info['login_details'])) { ?>
<tr>
	<th>Login Details</th>
	<td><?php echo $info['login_details']; ?></td>
</tr>
<?php } ?>
<?php if(isset($info['bandwidthUsedGB']) && isset($extra['bandwidth'])) { ?>
<tr>
	<th>Bandwidth Usage</th>
	<td><?php echo $info['bandwidthUsedGB']; ?> GB / <?php echo $extra['bandwidth']; ?> GB</td>
</tr>
<?php } ?>
</table>

<hr>

<div style="text-align:left;">
<h4>Actions</h4>

<form method="POST" action="clientarea.php?action=productdetails&id=<?php echo $params['serviceid']; ?>">
<input type="hidden" name="serveraction" value="custom" />
<button type="submit" class="searchinput" name="a" value="start">Start</button>
<button type="submit" class="searchinput" name="a" value="reboot">Reboot</button>
<button type="submit" class="searchinput" name="a" value="stop">Stop</button>
<button type="submit" class="searchinput" name="a" value="rescue">Rescue</button>
<?php if(isset($info['diskswap'])) { ?>
	<button type="submit" class="searchinput" name="a" value="diskswap">Swap boot order</button>
<?php } ?>
<a href="clientarea.php?action=productdetails&id=<?php echo $params['serviceid']; ?>&serveraction=custom&a=vnc" target="_blank"><button type="button" class="searchinput">VNC</button></a>
</form>

<h4>Reinstallation</h4>

<form method="POST" action="clientarea.php?action=productdetails&id=<?php echo $params['serviceid']; ?>">
<input type="hidden" name="serveraction" value="custom" />
<select name="os">
	<?php foreach($images as $image) { ?>
		<option value="<?php echo $image['image_id']; ?>"><?php echo $image['name']; ?></option>
	<?php } ?>
</select>
<button class="searchinput" name="a" value="reimage">Reinstall</button>
</form>

<h4>Graphs</h4>

<p>
<a href="clientarea.php?action=productdetails&id=<?php echo $params['serviceid']; ?>&serveraction=custom&a=graph&key=bandwidth" target="_blank"><button type="button" class="searchinput">Bandwidth</button></a>
<a href="clientarea.php?action=productdetails&id=<?php echo $params['serviceid']; ?>&serveraction=custom&a=graph&key=cpu" target="_blank"><button type="button" class="searchinput">CPU</button></a>
<a href="clientarea.php?action=productdetails&id=<?php echo $params['serviceid']; ?>&serveraction=custom&a=graph&key=io" target="_blank"><button type="button" class="searchinput">I/O</button></a>
</p>

<h4>rDNS</h4>

<?php
foreach($info['addresses'] as $address) {
	if(!$address['external'] || $address['version'] != 4) {
		continue;
	}
	if(!array_key_exists('reverse', $address) ||
	strpos($address['reverse'], 'rdns.lunanode.com') !== false) {
	$address['reverse'] = '';
	}
	?>
	<form method="POST" action="clientarea.php?action=productdetails&id=<?php echo $params['serviceid']; ?>">
	<input type="hidden" name="serveraction" value="custom" />
	<input type="hidden" name="a" value="rdns" />
	<input type="hidden" name="ip" value="<?php echo $address['addr']; ?>" />
	<?php echo $address['addr']; ?>
	<input type="text" name="reverse" value="<?php echo $address['reverse']; ?>" />
	<button type="submit" class="searchinput">Update</button>
	</form>
<?php } ?>

</div>

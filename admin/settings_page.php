<?php
// Check for valid url
if(!defined('ABSPATH')) {
	die("Better luck next time!!!");
}
?>
<div class="wrap">
<h2>WP Notify Settings</h2>
	<form  method="post" action="options.php">
	<?php 
		settings_fields('wp-notify-group');
		$wp_notify = get_option('wp_notify_options');
	?>
		<!-- Notify Status -->
		<div id="poststuff" class="metabox-holder has-right-sidebar"> 
			<div style="float:left;width:60%;">
				<div class="postbox">
					<h3 style="cursor:pointer;"><span>Notify Status</span></h3>
					<table class="form-table">
					<tr valign="top">
						<th scope="row" style="width:30%;"><label for="wp_notify_options_status">Show notifications.</label></th>
						<td><input id="wp_notify_options_status" type="checkbox" class="" name="wp_notify_options[status]" value="1" <?php if($wp_notify[status] == '1') echo "checked=checked"?>/></td>
					</tr>
					</table>
				</div>
			</div>
		</div>
		<!-- About Plugin -->
		<div id="poststuff" class="has-right-sidebar"> 
			<div style="float:right;width:35%;">
				<div class="postbox">
					<h3 style="cursor:pointer;"><span>About WP Notify</span></h3>
					<table class="form-table">
						<tr valign="top"><th><a href="http://apps.tutorboy.com/p/wp-notify/">Plugin Homepage</a></th></tr>
						<tr valign="top"><th><a href="http://tutorboy.com/">Tutorboy.com</a></th></tr>
					</table>
				</div>
			</div>
		</div>
		
		<!-- Notification windowss color option -->
		<div id="poststuff" class="metabox-holder has-right-sidebar"> 
			<div style="float:left;width:60%;">
				<div class="postbox">
					<h3 style="cursor:pointer;"><span>Notify Window Colors</span></h3>
					<table class="form-table">
						<tr valign="top">
						<th scope="row" style="width:20%;"><label for="wp_notify_options_bg_color">Background color</label></th>
						<td><input id="wp_notify_options_bg_color" type="text" autocomplete="off" class="color regular-text code" name="wp_notify_options[bg_color]" value="<?= $wp_notify[bg_color]; ?>"/></td></tr>
						<tr valign="top">
						<th scope="row" style="width:20%;"><label for="wp_notify_options_text_color" >Text color</label></th>
						<td><input id="wp_notify_options_text_color" type="text" class="color regular-text code" name="wp_notify_options[text_color]" value="<?= $wp_notify[text_color]; ?>"/></td></tr>
						<tr valign="top">
						<th scope="row" style="width:20%;"><label for="wp_notify_options_border_color">Border color</label></th>
						<td><input id="wp_notify_options_border_color" type="text" class="color regular-text code" name="wp_notify_options[border_color]" value="<?= $wp_notify[border_color]; ?>"/></td>
						</tr>
						<tr valign="top" class="alternate">
						<th scope="row" style="width:20%;"><label for="wp_notify_options_button_bg_color">Close button color</label></th>
						<td><input id="wp_notify_options_button_bg_color" type="text" class="color regular-text code" name="wp_notify_options[button_bg_color]" value="<?= $wp_notify[button_bg_color]; ?>"/></td>
						</tr>
						<tr valign="top" class="alternate">
						<th scope="row" style="width:20%;"><label for="wp_notify_options_button_border_color">Close button border color</label></th>
						<td><input id="wp_notify_options_button_border_color" type="text" class="color regular-text code" name="wp_notify_options[button_border_color]" value="<?= $wp_notify[button_border_color]; ?>"/></td>
						</tr>
						<tr valign="top" class="alternate">
						<th scope="row" style="width:20%;"><label for="wp_notify_options_button_text_color">Close button text color</label></th>
						<td><input id="wp_notify_options_button_text_color" type="text" class="color regular-text code" name="wp_notify_options[button_text_color]" value="<?= $wp_notify[button_text_color]; ?>"/></td>
						</tr>
					</table>
				</div><!-- postbox-->
				
			</div>
		</div><!-- poststuff-->
		
		
		<!-- Display Options -->
		<div id="poststuff" class="metabox-holder has-right-sidebar"> 
			<div style="float:left;width:60%;">
				<div class="postbox">
					<h3 style="cursor:pointer;"><span>Display Options</span></h3>
					<table class="form-table">
						<tr valign="top">
							<th scope="row"><label for="wp_notify_options_style">Notify Style</label></th>
							<td>
								<select name="wp_notify_options[style]" id="wp_notify_options_style">
								<option value="stackoverflow" <?php if ($wp_notify[style] == "stackoverflow"){ echo "selected";}?> >StackOverFlow (default)</option>
								<option value="safariAlert" <?php if ($wp_notify[style] == "safariAlert"){ echo "selected";}?> >Safari Alert </option>
								<option value="facebook" <?php if ($wp_notify[style] == "facebook"){ echo "selected";}?> >FaceBook </option>
								</select>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="wp_notify_options_event">Show Notify window on </label></th>
							<td>
								<select name="wp_notify_options[event]" id="wp_notify_options_event">
								<option value="onLoad" <?php if ($wp_notify[event] == "onLoad"){ echo "selected";}?> >On Page Load (default)</option>
								<option value="mousemove" <?php if ($wp_notify[event] == "mousemove"){ echo "selected";}?> >On Mouse Move </option>
								<option value="onScroll" <?php if ($wp_notify[event] == "onScroll"){ echo "selected";}?> >On Page Scroll </option>
								</select>
							</td>
						</tr>
						<tr><th scope="row"></th>
							<td >
							<input id="type_custom" type="radio" name="wp_notify_options[type]" value="custom" <?php if($wp_notify[type] == 'custom') echo "checked"?> ><label for="type_custom">Use Custom Message</label>
<input id="type_other" type="radio" name="wp_notify_options[type]" value="other" <?php if($wp_notify[type] == 'other') echo "checked"?>><label for="type_other">Other Notifications</label></td>
						</tr>
						
						<tr valign="top" id="custom_notify">
							<th scope="row"><label for="wp_notify_options_custom_message">Custom Messsagebr><small>(HTML tags are allowed)</small></label></th>
							<td><textarea id="wp_notify_options_custom_message" cols="60" rows="5" name="wp_notify_options[custom_message]" ><?= $wp_notify[custom_message]; ?></textarea></td>
						</tr>
						
						<tr valign="top" id="other_notify">
							<th scope="row">Other Notifications</th>
							<td>
							<input type="radio" id="recent_post" name="wp_notify_options[other_types]" value="recent_post" <?php if($wp_notify[other_types] == 'recent_post') echo "checked"?> ><label for="recent_post">Recent Post(s)</label>
							<input type="radio" id="scheduled_post" name="wp_notify_options[other_types]" value="scheduled_post" <?php if($wp_notify[other_types] == 'scheduled_post') echo "checked"?> ><label for="scheduled_post">Scheduled Post(s)</label>
							</td>
						</tr>
						
						<tr valign="top">
							<th scope="row" style="width:20%;"><label for="wp_notify_options_post_count">Number of Posts</label></th>
						<td><input type="text" class="" id="wp_notify_options_post_count" name="wp_notify_options[post_count]" value="<?= $wp_notify[post_count]; ?>"/></td>
						</tr>
						
					</table>
				</div><!-- postbox-->
				<p class="submit">
						<input type="submit" class="button-primary" value="<?php _e('Save All Changes') ?>" />
				</p>
			</div>
		</div><!-- poststuff-->
	</form>
</div>

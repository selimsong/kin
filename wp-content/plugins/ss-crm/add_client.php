<?php 

if (!empty($_POST['client_name'])){
	$wpdb->insert( $wpdb->prefix . "ss_crm", array( 'client_name' =>  addslashes($_POST['client_name']), 
	   'contact_name' => addslashes($_POST['contact_name']), 'mobile' => addslashes($_POST['mobile']),'remark' => addslashes($_POST['remark'])) );
	wp_redirect('?page=ss-crm/default.php');
	exit();
}

?>

<div class="wrap">
<div id="icon-users" class="icon32"><br/></div>
<h2><?php echo esc_html( "新增客户" ); ?></h2>

<form method="post" action="?page=ss-crm/add_client.php">
<?php settings_fields('general'); ?>

<table class="form-table">
<tr valign="top">
<th scope="row"><label for="blogname">客户名:</label></th>
<td><input name="client_name" type="text"  value="" class="regular-text" /></td>
</tr>
<tr valign="top">
<th scope="row"><label>联系人:</label></th>
<td><input name="contact_name" type="text"  value="" class="regular-text" />
<p class="description"><?php _e('desc of the contact') ?></p></td>
</tr>
<tr valign="top">
<th scope="row"><label for="mobile">手机:</label></th>
<td><input name="mobile" type="text"  value="" class="regular-text" />
</td>
</tr>
<tr valign="top">
<th scope="row"><label for="remark">备注:</label></th>
<td><textarea name="remark"   rows="5" cols="80"></textarea>
</td>
</tr>
<tr>
<th scope="row"><label for="timezone_string">时区</label></th>
<td>
<select id="timezone_string" name="timezone_string">
<option value="Asia/Kuala_Lumpur">吉隆坡</option>
<option value="Asia/Singapore">新加坡</option>
</select>
</td>
</tr>
</table>
<?php submit_button(); ?>
</form>

</div>


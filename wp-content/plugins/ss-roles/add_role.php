<?php 
if (!empty($_POST['client_name'])){
	$wpdb->insert( $wpdb->prefix . "ss_crm", array( 'client_name' =>  addslashes($_POST['client_name']), 
	   'contact_name' => addslashes($_POST['contact_name']), 'mobile' => addslashes($_POST['mobile']),'remark' => addslashes($_POST['remark'])) );
	wp_redirect('?page=client-list&action=add');
	exit();
}

?>

<div class="wrap">
<div id="icon-users" class="icon32"><br/></div>
<h2><?php echo esc_html( "新增角色" ); ?></h2>

<form method="post" action="?page=ss-crm/add_client.php">
<?php settings_fields('general'); ?>

<table class="form-table">
<tr valign="top">
<th scope="row"><label for="blogname">角色名:</label></th>
<td><input name="client_name" type="text"  value="" class="regular-text" /></td>
</tr>

<tr>
<th scope="row"><label for="timezone_string">时区</label></th>
<td>
<fieldset><legend class="screen-reader-text"><span>Membership</span></legend><label for="users_can_register">
<input name="users_can_register" type="checkbox" id="users_can_register" value="1">
Anyone can register</label>
</fieldset>
</td>
</tr>
</table>
<?php submit_button(); ?>
</form>

</div>


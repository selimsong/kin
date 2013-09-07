<?php 
if (!empty($_POST['role_name'])){
	print_r($_POST);
	exit();
	//$wp_roles = new WP_Roles();
	add_role($_POST['role_name'], $_POST['role_name'], array('showme' => 1));
	wp_redirect('?page=ss-role&action=addsuccess');
	exit();
}

?>

<div class="wrap">
<div id="icon-users" class="icon32"><br/></div>
<h2><?php echo esc_html( "新增角色" ); ?></h2>

<form method="post" action="?page=ss-role&action=add">
<?php settings_fields('general'); ?>

<table class="form-table">
<tr valign="top">
<th scope="row"><label for="blogname">角色名:</label></th>
<td><input name="role_name" type="text"  value="" class="regular-text" /></td>
</tr>

<tr>
<th scope="row"><label for="timezone_string">切换模版</label></th>
<td>
<fieldset>
<label>
<input name="setting[]" type="checkbox" value="switch_themes">
允许</label>
</fieldset>
</td>
</tr>

<tr>
<th scope="row"><label for="timezone_string">编辑用户</label></th>
<td>
<fieldset>
<label>
<input name="setting[]" type="checkbox" value="edit_users">
允许</label>
</fieldset>
</td>
</tr>

<tr>
<th scope="row"><label for="timezone_string">编辑用户</label></th>
<td>
<fieldset>
<label>
<input name="setting[]" type="checkbox" value="level_10">
允许</label>
</fieldset>
</td>
</tr>

</table>
<?php submit_button(); ?>
</form>

</div>


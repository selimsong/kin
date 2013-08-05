<?php 

if (!empty($_GET['movie'])):
	$qry= "SELECT  id,client_name,contact_name,mobile,remark  FROM ".$wpdb->prefix."ss_crm  where id ='".addslashes($_GET['movie'])."' ";
    $data = $wpdb->get_row($qry, ARRAY_A);
    if (!empty($data)):
?>

<div class="wrap">
<div id="icon-users" class="icon32"><br/></div>
<h2><?php echo esc_html( "新增客户" ); ?></h2>

<form method="post" action="?page=client-list&action=save">
<?php settings_fields('general'); ?>

<table class="form-table">
<tr valign="top">
<th scope="row"><label for="blogname">客户名:</label></th>
<td><input name="client_name" type="text"  value="<?php echo $data['client_name'] ?>" class="regular-text" /></td>
</tr>
<tr valign="top">
<th scope="row"><label>联系人:</label></th>
<td><input name="contact_name" type="text"  value="<?php echo $data['contact_name'] ?>" class="regular-text" />
<p class="description"><?php _e('desc of the contact') ?></p></td>
</tr>
<tr valign="top">
<th scope="row"><label for="mobile">手机:</label></th>
<td><input name="mobile" type="text"  value="<?php echo $data['mobile'] ?>" class="regular-text" />
</td>
</tr>
<tr valign="top">
<th scope="row"><label for="remark">备注:</label></th>
<td><textarea name="remark" rows="5" cols="80"><?php echo $data['remark'] ?></textarea>
<input type="hidden" name="id" value="<?php echo $data['id'] ?>"  />
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

<?php 
    else:
     echo  'no record';
	endif;
endif;
?>

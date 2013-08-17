<?php
/*
Plugin Name: SS-Roles - User Roles Management
Description: User Roles Management for WordPress.
Author: selim song
Version: 0.0.1
*/
define( 'ROLE_Path', dirname(__FILE__) . "/");
require(ABSPATH . WPINC . '/pluggable.php');

add_action('admin_menu', 'ss_roles_menu_page');


function ss_roles_menu_page(){

	add_submenu_page( 'users.php', 'Roles', 'Roles', 'manage_options', 'ss-role', 'ss_roles' );
}

function ss_roles() {
	if ('add' == $_GET['action']) {
		include_once(ROLE_Path.'add_role.php');
	}else{
		include_once(ROLE_Path.'home.php');
	}
	
}






/**

$result = add_role('selim3', 'my sContributor3', array(
		'read' => true, // True allows that capability
		'edit_posts' => true,
		'delete_posts' => false, // Use false to explicitly deny
));


var_dump($result);
if (null != $result) {
	echo 'Yay!  New role created!';
} else {
	echo 'Oh... the basic_contributor role already exists.';
}

//remove_role( 'selim' );

// Add caps for Administrator role
$role = get_role('administrator');
$role->add_cap('switch_themes');
$role->add_cap('edit_themes');
$role->add_cap('activate_plugins');
$role->add_cap('edit_plugins');
$role->add_cap('edit_users');
$role->add_cap('edit_files');
$role->add_cap('manage_options');
$role->add_cap('moderate_comments');
$role->add_cap('manage_categories');
$role->add_cap('manage_links');
$role->add_cap('upload_files');
$role->add_cap('import');
$role->add_cap('unfiltered_html');
$role->add_cap('edit_posts');
$role->add_cap('edit_others_posts');
$role->add_cap('edit_published_posts');
$role->add_cap('publish_posts');
$role->add_cap('edit_pages');
$role->add_cap('read');
$role->add_cap('level_10');
$role->add_cap('level_9');
$role->add_cap('level_8');
$role->add_cap('level_7');
$role->add_cap('level_6');
$role->add_cap('level_5');
$role->add_cap('level_4');
$role->add_cap('level_3');
$role->add_cap('level_2');
$role->add_cap('level_1');
$role->add_cap('level_0');











$current_user =   wp_get_current_user();  
$user_id  = $current_user->ID;
//echo $user_id;

$wp_roles = new WP_Roles();
$all_roles = $wp_roles->roles;

//print_r($all_roles);

//$editable_roles = apply_filters('editable_roles', $all_roles);
//print_r($editable_roles);


//$user_roles = array_intersect( array_values( $profileuser->roles ), array_keys( get_editable_roles() ) );
//$user_role  = array_shift( $user_roles );
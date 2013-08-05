<?php
/*
Plugin Name: SS-CRM - Customer Relationship Management
Description: Integrated Customer Relationship Management for WordPress.
Author: selim song
Version: 0.0.1
*/
define( 'CRM_Path', dirname(__FILE__) . "/");


add_action('admin_menu', 'register_my_custom_menu_page');


register_activation_hook( __FILE__, 'ss_install' );

$ss_db_version = '0.1';

add_action('init', 'app_output_buffer');

function app_output_buffer() {
	ob_start();
}

function register_my_custom_menu_page(){
	add_menu_page('crm menue', '客户管理', 'manage_options', 'client-list', 'client_list', '', 6 );
	add_submenu_page('client-list', 'add client', '新增客户', 'manage_options', CRM_Path . '/add_client.php');
	add_submenu_page('client-list', 'new client2', '设置', 'manage_options', 'my-custom-submenu-page', 'my_custom_submenu_page_callback' );
}

function client_list(){
	if ($_GET['action']) {
		include_once(CRM_Path.'edit_client.php');
	}else{
	    include_once(CRM_Path.'default.php');
	}
	
}


function ss_install(){
	global $wpdb, $ss_db_version;
	
	$table_name = $wpdb->prefix . "ss_crm";

	$sql = "CREATE TABLE `$table_name` (
	  `id` mediumint(9) NOT NULL auto_increment,
	  `client_name` tinytext NOT NULL,
	  `contact_name` tinytext NOT NULL,
	  `mobile` tinytext NOT NULL,
	  `remark` longtext NOT NULL,
	   PRIMARY KEY  (`id`)
   ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
	add_option( "ss_db_version", $ss_db_version );
}
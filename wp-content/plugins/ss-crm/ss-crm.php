<?php
/*
Plugin Name: SS-CRM - Customer Relationship Management
Description: Integrated Customer Relationship Management for WordPress.
Author: selim song
Version: 0.0.1
*/

define( 'CRM_Path', basename(dirname( __FILE__ )) );


add_action('admin_menu', 'register_my_custom_menu_page');


register_activation_hook( __FILE__, 'ss_install' );

$ss_db_version = '0.1';


function register_my_custom_menu_page(){
	add_menu_page('crm menue', '客户管理', 'manage_options', CRM_Path . '/default.php', '', '', 6 );
	add_submenu_page(CRM_Path . '/default.php', 'new client', '新增客户', 'manage_options', CRM_Path . '/add_client.php');
	add_submenu_page(CRM_Path . '/default.php', 'new client2', '设置', 'manage_options', 'my-custom-submenu-page', 'my_custom_submenu_page_callback' );
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
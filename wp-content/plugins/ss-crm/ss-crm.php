<?php
/*
Plugin Name: SS-CRM - Customer Relationship Management
Description: Integrated Customer Relationship Management for WordPress.
Author: selim song
Version: 0.0.1
*/

define( 'CRM_Path', basename(dirname( __FILE__ )) );

add_action('admin_menu', 'register_my_custom_menu_page');

function register_my_custom_menu_page(){
	add_menu_page( 'crm menue', '客户管理', 'manage_options', CRM_Path . '/default.php', '', '', 6 );
}
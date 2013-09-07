<?php
/*
Plugin Name: SS-USERS - USERS Manager
Description: USERS Manager
Author: selim song
Version: 0.0.1
*/
define( 'USERS_Path', dirname(__FILE__) . "/");


add_action('admin_menu', 'register_users_page');


register_activation_hook( __FILE__, 'ssUsers_install' );

$ss_db_version = '0.1';

add_action('init', 'app_output_buffer');

function app_output_buffer() {
	ob_start();
}

function register_users_page(){
	add_menu_page('crm menue', '客户管理', 'manage_options', 'client-list', 'client_list', '', 6 );
	add_submenu_page('client-list', 'add client', '新增客户', 'manage_options', CRM_Path . '/add_client.php');
	add_submenu_page('client-list', 'new client2', '设置', 'manage_options', 'my-custom-submenu-page', 'my_custom_submenu_page_callback' );
}

function client_list(){
	global $wpdb;
	if ('edit' == $_GET['action']) {
		include_once(CRM_Path.'edit_client.php');
	}else{
		$_message = NULL;
		if (!empty($_POST['submit'])) {
			$result = $wpdb->update($wpdb->prefix.'ss_crm', array( 'client_name' =>  addslashes($_POST['client_name']), 
	           'contact_name' => addslashes($_POST['contact_name']), 'mobile' => addslashes($_POST['mobile']),'remark' => addslashes($_POST['remark'])), array( 'id' => addslashes($_POST['id']) ) );
		    if ($result) {
		    	$_message =  $_POST['client_name'] . ' 更新完成';
		    }
		}
		if('add' == $_GET['action']){
			$_message = '新增成功 !';
		}elseif ('delete' == $_GET['action']){
			$result = $wpdb->delete($wpdb->prefix.'ss_crm', array( 'id' => addslashes($_GET['movie']) ) );
			if ($result){
			   $_message = '删除成功 !';
			}
		}
	    
	    include_once(CRM_Path.'home.php');
	}
	
}


function ssUsers_install(){
	global $wpdb, $ss_db_version;
	
	$table_name = $wpdb->prefix . "ss_users";

	$sql = "CREATE TABLE `$table_name` (
	  `id` bigint(20) NOT NULL auto_increment,
	  `user_login` varchar(60) NOT NULL,
	  `user_pass` varchar(60) NOT NULL,
	  `user_email` varchar(60)  NOT NULL,
	  `user_email` varchar(60)  NOT NULL,
	  `user_registered` datetime NOT NULL,
	   PRIMARY KEY  (`id`)
   ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
	add_option( "ss_db_version", $ss_db_version );
}
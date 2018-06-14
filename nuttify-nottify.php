<?php 
    /*
    Plugin Name: Nuttify Nottify
    Plugin URI: http://www.nuttify.com
    Description: Sends notification if someone create a post or edit a post. A custom build plugin for the client
    Author: Peejay Gran
    Version: 1.0
    Author URI: http://www.nuttify.com
    */
?>

<?php

/** Step 2 (from text above).  */
//initialize email menu
add_action( 'admin_menu', 'nut_email_nottify' );

/** Step 1. */
//setup email page option
function nut_email_nottify() {
	add_options_page( 'Nuttify Email Nottify', 'Nuttify Email Nottify', 'manage_options', 'nuttify-email-nottify', 'nuttify_email_nottify_options' );
	
	add_action("admin_init","nut_email_nottify_settings");
}

function nut_email_nottify_settings(){
	register_setting( 'nut-nottify-group', 'nut_post_value' );
	register_setting( 'nut-nottify-group', 'nut_from_email' );
	register_setting( 'nut-nottify-group', 'nut_to' );
	register_setting( 'nut-nottify-group', 'nut_bcc' );
	register_setting( 'nut-nottify-group', 'nut_subject' );
	register_setting( 'nut-nottify-group', 'nut_message' );
}

/** Step 3. */
function nuttify_email_nottify_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	 
	include("views/nut-options.php");
	
}

//equeue admin script  for getting option post and script triggerer to send notification
add_action( 'admin_print_scripts', 'nut_email_nottify_js' );
function nut_email_nottify_js(){
	 
	echo '<script type="text/javascript">';
	echo 'var nut_post_value = "' . get_option('nut_post_value') . '"';
	echo '</script>';
	
	wp_enqueue_script("nut-nottify","/wp-content/plugins/nuttify-nottify/assets/js/nuttify-nottify.js",array(),"1.0",true);
	
}


//execute notification when published and edited triggered
add_action("wp_ajax_nut_email_process","nut_email_process");
function nut_email_process(){
	
	$id_user = $_POST['post_author'];
	$user_info = get_userdata($id_user);
	
	$post_title = $_POST['post_title'];
	$post_status = $_POST['status'];
	
	$username = $user_info->user_login;
	
	$message = get_option('nut_message');
	
	$message = str_replace("{post_title}",$post_title,$message);
	$message = str_replace("{post_author}",$username,$message);
	$message = str_replace("{post_status}",$post_status,$message);
	
	$to = get_option('nut_to');
	$subject = get_option('nut_subject');
	$body = $message;
	$headers = array('Content-Type: text/html; charset=UTF-8','From: <' . get_option('nut_from_email') . '>' . "\r\n");

	echo $body;
	$result = wp_mail( $to, $subject, $body, $headers );
	
}





?>
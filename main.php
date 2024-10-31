<?php
/**
 * Plugin Name: Post revision column
 * Description: Adds post revision columns in post edit listings for all the post types.
 * Version: 1.0
 * Author: Carlton
 * Author URI: http://wordpress.org/
 * License: GPL2
 */
define( 'PR_SLASH' , '/' );

/* plugin url */
define( 'PR_URL', plugins_url('', __FILE__) );

/* Define all necessary variables first */
define( 'PR_CSS', PR_URL. "/assets/css/" );
define( 'PR_JS',  PR_URL. "/assets/js/" );
define( 'PR_IMG',  PR_URL. "/assets/img/" );

global $pr, $pr_admin;
// Includes PHP files located in 'lib' folder
foreach( glob ( dirname(__FILE__). "/lib/*.php" ) as $lib_filename ) {

    require_once( $lib_filename );

}

/* Initialize post revision object */
$pr_admin   =   new pr_admin();
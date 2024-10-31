<?php
if( !class_exists('pr_revisions') ){

    class pr_revisions {
        
        public $pr_setting;

        /* Constructor */
        function __construct() {

            //add_action( 'wp_enqueue_scripts', array( $this, 'cd_scripts' ) );

        }

        /* Add scripts to admin */
        function cd_scripts(){

            wp_enqueue_script('cd-admin', CD_JS.'custom.js', array('jquery'));
            wp_enqueue_style( 'cd-style', CD_CSS.'style.css', array(), false, 'all' );

        }

    };

}
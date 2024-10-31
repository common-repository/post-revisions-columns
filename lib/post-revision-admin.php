<?php
if( !class_exists('pr_admin') ){

    class pr_admin {

        public $pr_admin_setting;

        /* Constructor */
        function __construct() {

            add_action( 'admin_enqueue_scripts', array( $this, 'pr_admin_scripts' ) );
            add_action( 'admin_menu', array( $this, 'pr_admin_setting_page' ) );
            add_action('admin_init', array($this, 'init'));
        }
        
        function init(){
            
            $built_in    =   array('attachment', 'revision','nav_menu_item');
            $post_type  =   get_post_types();          
            $post_type  =   array_diff( $post_type, $built_in );

            /* Add Column in all post types accept $built_in one */
            foreach( $post_type as $postType ){

                add_filter( "manage_{$postType}_posts_columns", array($this,'pr_column_heading') );
                add_action("manage_{$postType}_posts_custom_column", array($this,'pr_column_content'), 10, 2);
            }
        }

        /* Add scripts to admin */
        function pr_admin_scripts(){

            wp_enqueue_script('pr-admin', CD_JS.'custom-admin.js', array('jquery'));
            wp_enqueue_style( 'pr-style', CD_CSS.'style-admin.css', array(), false, 'all' );

        }

        /* Add option page */
        function pr_admin_setting_page(){

            //add_options_page( 'Post revision column settings', 'Post revision column settings', 'administrator', 'pr-settings', array( $this, 'pr_renderer' ));
        }
        
        /* Setting page function */
        function pr_renderer(){ ?>

            <div class="pr-option-settings">

            </div><?php

        }

        /*Add Columns */
        function pr_column_heading( $defaults ){
            
            $defaults['no_of_revisions'] = 'No. of revisions';
            $defaults['date_of_revision'] = 'Date of last revision';
            $defaults['author_of_revision'] = 'Author of last revision';

            return $defaults;

        }
        /*Get Column content */
        function pr_column_content( $column_name, $post_ID ){
            
            $revisions  =   get_posts( array( 'post_type'=>'revision', 'post_parent'=>$post_ID, 'posts_per_page'=>-1, 'post_status'=>'inherit' ) );

            if ($column_name == 'no_of_revisions') {

                echo empty($revisions) ? 0 : count($revisions);
            }

            if ($column_name == 'author_of_revision') {

                if( !empty( $revisions ) ){

                    $author =   get_user_by('id', $revisions[0]->post_author);
                    $author =   $author->data->display_name;
                    echo $author;

                }else{
                    
                    echo '---';
                }
            }

            if ($column_name == 'date_of_revision') {

                echo empty($revisions) ? '---' : date( 'm-d-Y', strtotime($revisions[0]->post_date) );
            }

        }

    };

}
<?php

if ( ! defined ('ABSPATH') ) exit;

/*
Plugin Name: Creative Reviews
Plugin URI: https://CreativePatriot.com
Description: Google and Yelp Reviews
Author: Joshua Almasin
Version: 1.0.0
License: GPLv2 or later
*/

define( 'CR_VERSION' , '1.0.0' );
define ('CR_BASE_PATH', plugin_dir_path( __FILE__ ));

if ( file_exists( CR_BASE_PATH . '/vendor/autoload.php' )) {
    require_once CR_BASE_PATH . '/vendor/autoload.php';
}

new App\CreativeReviews();
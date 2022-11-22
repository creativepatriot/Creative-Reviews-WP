<?php

namespace App;
use App\Api\API;
use App\Manage\Settings;

class CreativeReviews {

    public function __construct() 
    {
        add_action('admin_menu', array( new Settings, 'settingsPage') );
        add_action('admin_post_save_api', array( new Settings, 'cr_api_save' ));
        add_action('admin_post_save_bid', array( new Settings, 'cr_bid_save' ));
        add_shortcode( 'testme', array( new API, 'short') );

    }

}
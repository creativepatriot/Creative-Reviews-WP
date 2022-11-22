<?php

namespace App\Api;

class API {

    public function __construct() 
    {
        add_shortcode( 'testme', array( $this, 'short') );
    }

    public function callAPI() 
    {
        $APIKEY = get_option('cr_yelp_api_key');
        $id = "";
        $yelpURL = "https://api.yelp.com/v3/businesses/";

        $businessID = get_option( 'bidyelp' );

        $yelpEndUrl = "/reviews";

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $yelpURL . $businessID . $yelpEndUrl );

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . $APIKEY
        ));

        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

    public function short() 
    {

        /**
         * Need to check if API key was invalid if so then send a error to front end
         */

        $output = $this->callAPI();
        $arr = json_decode($output);
        include( CR_BASE_PATH . '/views/shortcodes/yelp-single.php');
        
        return $html;
    }
}
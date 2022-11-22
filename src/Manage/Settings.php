<?php

namespace App\Manage;

class Settings {
    
    public function settingsPage()
    {
        add_menu_page( 
            'Creative Reviews',
            'Creative Reviews',
            'manage_options',
            'creative_reviews',
            array($this, 'customPage')
        );
    }

    public function customPage()
    {
        include( CR_BASE_PATH . '/views/settings.php');
    }

    public function cr_api_save()
    {
        $cr_save = $_POST['save'];
        // Filter out disallowed HTML
        $cr_save = wp_kses( $cr_save, array());

        if ( isset ( $cr_save )) {

            delete_transient( 'cr_error' );
            delete_transient( 'cr_success' );

            // nonce check
            if ( isset( $_POST['_wpnonce'] ) && $_POST['_wpnonce'] ) {
                // Check if carries from valid request
                if ( check_admin_referer( 'save_api', '_wpnonce' ) ) {
                    // Clear from CSRF
                    if ( isset( $_POST['yelpapi'] ) && isset( $_POST['googleapi'] ) ){
                        if ( !empty($_POST['yelpapi'] ) && !empty($_POST['googleapi'] ) ) {
                            $yelpAPI = $_POST['yelpapi'];
                            $googleAPI = $_POST['googleapi'];
        
                            $yelpAPI = wp_kses( $yelpAPI, array() );
                            $googleAPI = wp_kses( $googleAPI, array() );

                            // Save To Options
                            update_option( 'cr_yelp_api_key', $yelpAPI );
                            update_option( 'cr_google_api_key', $googleAPI );

                            set_transient( 'cr_success', 'API Keys have been saved!', 5 );
                            // Save Error MSG and Redirect
                            set_transient( 'cr_error', 'API Keys must not be empty', 5 );
                            $location = $_SERVER['HTTP_REFERER'];
                            wp_safe_redirect($location);
                            exit();
                        }else {
                            // Save Error MSG and Redirect
                            set_transient( 'cr_error', 'API Keys must not be empty', 5 );
                            $location = $_SERVER['HTTP_REFERER'];
                            wp_safe_redirect($location);
                            exit();
                        }
                    }

                }
            }
        }
    }

    public function cr_bid_save()
    {
        $cr_save = $_POST['save_bids'];

        $cr_save = wp_kses( $cr_save, array() );

        if ( isset( $cr_save ) ) {
            // nonce check
            if ( isset( $_POST['_wpnonce'] ) && $_POST['_wpnonce'] ) {
                if( check_admin_referer( 'save_bid', '_wpnonce' ) ){
                    if ( isset( $_POST['bidyelp']) && isset( $_POST['bidgoogle'] ) ) {
                        $googleID = $_POST['bidgoogle'];
                        $yelpID = $_POST['bidyelp'];
                        
                        $googleID = wp_kses( $googleID, array() );
                        $yelpID = wp_kses( $yelpID, array() );

                        update_option( 'bidgoogle', $googleID );
                        update_option( 'bidyelp' , $yelpID );

                        set_transient( 'cr_success', 'Added Business IDs', 5 );
                        $location = $_SERVER['HTTP_REFERER'];
                        wp_redirect( $location );
                        exit();
                    }
                }
            }
        }
    }
}
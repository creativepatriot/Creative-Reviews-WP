<style>
    .input-group {
        margin-bottom: 10px;
    }
</style>


<div class="wrap">
    <h1>Creative Reviews Settings</h1>
    <?php 
        if (get_transient( 'cr_error' ) !== null  && !empty(get_transient( 'cr_error')) ) {
            echo '<div class="notice notice-error is-dismissible">' . get_transient( 'cr_error' ) .'</div>';            
        }

        if ( get_transient( 'cr_success' ) !== null && !empty(get_transient( 'cr_success' )) ){
            echo '<div class="notice notice-success is-dismissible">' . get_transient( 'cr_success' ) .'</div>';            
        }
    ?>
    </div>
    <div>
        <h2>API KEY Settings:</h2>
        <form action="<?php echo esc_url(admin_url('admin-post.php')) ?>" method="post">
        <?php wp_nonce_field( 'save_api', '_wpnonce' ); ?>    
        <div class="input-group">
                <input type="text" name="yelpapi" placeholder="Yelp API Key" <?php if ( get_option('cr_yelp_api_key') !== null ) echo 'value="'. get_option( 'cr_yelp_api_key' ) . '"'; ?>>
            </div>
            <div class="input-group">
                <input type="text" name="googleapi" placeholder="Google API Key" <?php if ( get_option('cr_google_api_key') !== null ) echo 'value="'. get_option( 'cr_google_api_key' ) . '"'; ?>>
            </div>
            <input type="hidden" name="action" value="save_api">
            <input type="submit" name="save" value="Save">
        </form>
    </div>
    <div style="margin-top:50px;">
        <h2>Business ID Settings:</h2>
        <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
            <?php wp_nonce_field( 'save_bid', '_wpnonce' ); ?>
            <div class="input-group">
                <input type="text" name="bidyelp" placeholder="Business ID Yelp" <?php if ( get_option('bidyelp') !== null ) echo 'value="'. get_option( 'bidyelp' ) . '"'; ?>>
            </div>
            <div class="input-group">
                <input type="text" name="bidgoogle" placeholder="Business ID Google" <?php if ( get_option('bidgoogle') !== null ) echo 'value="'. get_option( 'bidgoogle' ) . '"'; ?>>
            </div>
            <input type="hidden" value="save_bid" name="action">
            <input type="submit" value="Save" name="save_bids">
        </form>
    </div>
</div>


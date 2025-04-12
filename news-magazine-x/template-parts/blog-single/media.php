<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Get the post format
$post_format = get_post_format() ? : 'standard';

if ( have_posts() ) :

    // Loop Start
    while ( have_posts() ) : the_post();

        echo '<div class="newsx-single-post-media">';
            if ( 'standard' === $post_format ) {
                the_post_thumbnail();
            
            // Load Post Formats from Plugin
            } else if ( class_exists( 'Newsx_Core_Pro' ) ) {
                $newsx_core_pro = new Newsx_Core_Pro();
                $newsx_core_pro_public = new Newsx_Core_Pro_Public( $newsx_core_pro->get_plugin_name(), $newsx_core_pro->get_version() );
                $newsx_core_pro_public->load_post_format_template( $post_format );
            }
        echo '</div>';

    endwhile; // Loop End

    // Reset the loop
    rewind_posts();

endif; // have_posts()

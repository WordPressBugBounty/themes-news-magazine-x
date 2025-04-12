<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>

    <!-- Site Footer -->
    <footer id="site-footer" class="newsx-site-footer">
        <?php // Include Templates

        // Top Section
        get_template_part( 'template-parts/footer/sections/top-section' );

        // Middle Section
        get_template_part( 'template-parts/footer/sections/middle-section' );

        // Bottom Section
        get_template_part( 'template-parts/footer/sections/bottom-section' );

        // Back to Top Button
        get_template_part( 'template-parts/footer/elements/back-to-top' );

        ?>
    </footer>

	</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
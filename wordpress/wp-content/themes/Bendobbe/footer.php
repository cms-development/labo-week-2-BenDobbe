<footer id="colophon" class="page-footer" role="contentinfo">
	<div class="container">
        <div class="row">
            <div class="col s12">
            <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'bendobbe' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'bendobbe' ), 'WordPress' ); ?></a>
            <?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'menu_id' => 'footer-menu' ) ); ?>
            </div>
        </div>
    </div>
</footer><!-- #colophon -->

<?php wp_footer(); ?>

</body>

</html>
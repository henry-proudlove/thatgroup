<?php
/**
 * @package WordPress
 * @subpackage themename
 */
?>

	</div><!-- #main  -->

	<footer id="colophon" role="contentinfo">
			<div id="site-generator">
				<small>&copy Copyright <?php echo date('Y') . " " . esc_attr( get_bloginfo( 'name', 'display' ) ); ?> <a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'themename' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s.', 'themename' ), 'WordPress' ); ?></a></small>
				<?php wp_nav_menu( array( 'theme_location' => 'footer' ) ); ?>
			</div>
	</footer><!-- #colophon -->
</div><!-- #page -->
	
<?php wp_footer(); ?>

<script src="<?php echo get_template_directory_uri();?>/js/jquery.validate.min.js"></script>
<script src="<?php echo get_template_directory_uri();?>/js/scripts.js"></script>

</body>
</html>
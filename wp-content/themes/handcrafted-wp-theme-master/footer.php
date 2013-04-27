<?php
/**
 * @package WordPress
 * @subpackage themename
 */
?>

	</div><!-- #main  -->
	<span id="classfix" <?php body_class(); ?>></span>
	<footer id="colophon" role="contentinfo">
			<div id="site-generator">
				<small><span id="tag">THAT Group: All Style, All Substance.</span> 	<span id="cr">&copy Copyright <?php echo date('Y') . " " . esc_attr( get_bloginfo( 'name', 'display' ) ); ?></span></small>
			</div>
	</footer><!-- #colophon -->
</div><!-- #page -->
<script src="<?php echo get_template_directory_uri();?>/js/jquery.validate.min.js"></script>
<script src="<?php echo get_template_directory_uri();?>/js/scripts.js"></script>
<?php wp_footer(); ?>
	
</body>
</html>
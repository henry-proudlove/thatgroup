<?php
/**
 * @package WordPress
 * @subpackage themename
 */
?>

	</div><!-- #main  -->
	<footer id="colophon" role="contentinfo">
			<div id="site-generator">
				<small><span id="tag">THAT Group: All Style, All Substance.</span> 	<span id="cr">&copy Copyright <?php echo date('Y') . " " . esc_attr( get_bloginfo( 'name', 'display' ) ); ?></span></small>
			</div>
	</footer><!-- #colophon -->
</div><!-- #page -->
<div class="loader-holder" style="display:none;">
</div>
<div id="border">
	<div class="b-top"></div>
	<div class="b-right"></div>
	<div class="b-left"></div>
</div><!--- URGH! this is disgusting markup -->
<script type="text/javascript">
	var siteURL = '<?php echo get_site_url(); ?>';
</script>
<script src="<?php echo get_template_directory_uri();?>/js/jquery.cycle.all.js"></script>
<script src="<?php echo get_template_directory_uri();?>/js/scripts.js"></script>
<?php wp_footer(); ?>
	
</body>
</html>
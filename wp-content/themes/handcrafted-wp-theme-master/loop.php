<?php
/**
 * @package WordPress
 * @subpackage themename
 */
?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>
	<nav id="nav-above" role="article">
		<h1 class="section-heading"><?php _e( 'Post navigation', 'themename' ); ?></h1>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'themename' ) ); ?></div>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'themename' ) ); ?></div>
	</nav><!-- #nav-above -->
<?php endif; ?>
<section id="load">
	<?php /* Start the Loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>
	
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
			<a class="ajax-link" href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'themename' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
				<header class="entry-header">
					<time class="entry-date"><?php the_date('d.m.y'); ?></time>
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</header><!-- .entry-header -->	
				<div class="entry-summary">
					<?php the_excerpt(); ?>
				</div><!-- .entry-summary -->
			</a>
		</article><!-- #post-<?php the_ID(); ?> -->
	
	<?php endwhile; ?>
</section><!--#load-->

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
	<nav id="nav-below" role="article">
		<h1 class="section-heading"><?php _e( 'Post navigation', 'themename' ); ?></h1>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'themename' ) ); ?></div>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'themename' ) ); ?></div>
	</nav><!-- #nav-below -->
<?php endif; ?>

<?php
/**
 * Template Name: About Page
 * Description: Template for About Page
 *
 * @package WordPress
 * @subpackage themename
 */
 
get_header(); ?>

		<div id="primary">
			<div id="content" class="about">

				<?php the_post(); ?>

				<article id="about-page" <?php post_class('main-article'); ?> role="article">
					<header class="entry-header">
						<h1 class="entry-title"><span id="all-sty">All Style. </span><span id="all-sub">All Substance</span></h1>
					</header><!-- .entry-header -->
					<div class="entry-content">
						<?php the_content(); ?>
					</div><!-- .entry-content -->
					<footer class="entry-meta">
						<?php edit_post_link( __( 'Edit', 'themename' ), '<span class="edit-link">', '</span>' ); ?>
					</footer><!-- .entry-meta -->
				</article><!-- #post-<?php the_ID(); ?> -->
				<section id="people" class="thumbs">
					<div id="people-img">
						<div id="people-holder">
							<div class="hit-area one"></div>
							<div class="hit-area two"></div>
							<div class="hit-area three"></div>
							<div class="hit-area four"></div>
							<div class="hit-area five"></div>
							<div class="hit-area six"></div>
							<div class="img"></div>
						</div>
					</div><!--#people-img-->
					<ul id="people-list" class="clearfix">
					<?php
					$args = array('post_type' => 'people' , 'posts_per_page' => '-1');
					$wp_query = new WP_Query($args);
					if( $wp_query->have_posts() ): while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
						<li class="people-item">
							<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'themename' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
								<header class="entry-header">
									<h2 class="entry-role"><?php echo $post->jobtitle; ?></h2>
									<h1 class="entry-title">
										<span class="name"><?php the_title(); ?></span>
										<span class="quali">
											<?php echo implode( ',', clean_quali($post->quali) ); ?>
										</span>
									</h1>
							</a>
						</li>
					<?php endwhile; ?>
					<?php endif;?>
					</ul><!--.people-list-->
				</section><!--#people-->
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>
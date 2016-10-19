<?php
/**
 * The template for displaying agencies archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package real-estate-lite
 */

get_header(); ?>

	<div id="primary" class="content-area col-center">
		<main id="main" class="site-main twelve-col" role="main">
		<?php if ( have_posts() ) : ?>
			<header class="page-header">
				<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
				<?php the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>
			</header><!-- .page-header -->

			<?php
			/**
			 * realia_before_agency_archive
			 */
			do_action( 'realia_before_agency_archive' );
			?>

			<?php while ( have_posts() ) : the_post(); ?>
				<?php echo Realia_Template_Loader::load( 'agencies/row' ); ?>
			<?php endwhile; ?>

			<?php
			/**
			 * realia_after_agency_archive
			 */
			do_action( 'realia_after_agency_archive' );
			?>

			<?php the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'real-estate-lite' ),
				'next_text'          => __( 'Next page', 'real-estate-lite' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'real-estate-lite' ) . ' </span>',
			) ); ?>
		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>
		
		</main><!-- #main -->

	</div><!-- #primary -->


<?php get_footer(); ?>

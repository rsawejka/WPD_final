<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package rsawejka-book-theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php


		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				wpd_final_book_theme_posted_on();
				wpd_final_book_theme_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

    <?php //wpd_final_book_theme_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content();

		?>
	</div><!-- .entry-content -->


</article><!-- #post-<?php the_ID(); ?> -->

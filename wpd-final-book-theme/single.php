<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package rsawejka-book-theme
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php

        while ( have_posts() ) :
            the_title();
            echo '<div style="height: 200px; width: 150px;">';
            the_post_thumbnail();
           echo  '</div>';
            the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			//the_post_navigation(
				//array(
			//		'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'wpd-final-book-theme' ) . '</span> <span class="nav-title">%title</span>',
			//		'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'wpd-final-book-theme' ) . '</span> <span class="nav-title">%title</span>',
			//	)
			//);

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
           // the_excerpt();
		endwhile; // End of the loop.

		?>
        <aside id="secondary" class="widget-area">
            <?php dynamic_sidebar( 'test' ); ?>
        </aside>
	</main><!-- #main -->

<?php
get_footer();

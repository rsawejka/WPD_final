<?php
/**
 *
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package rsawejka-book-theme
 */

get_header();
?>

	<main id="primary" class="site-main">
        <div class="booksMartinLikes">
        <?php
        the_content();
        ?>
        </div>
	</main><!-- #main -->

<?php
get_footer();

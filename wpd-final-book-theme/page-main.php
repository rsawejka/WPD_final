<?php
/**
 *Template Name: page-main
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


<div class="homePageFlex">
    <div class="homeWidget">
        <aside id="secondary" class="widget-area">
            <?php dynamic_sidebar( 'test' ); ?>
        </aside>
    </div>

    <main id="primary" class="site-main">
        <h1><?php the_title(); ?></h1>
    <?php
    the_content();
    ?>
    </main><!-- #main -->

</div>



<?php
get_footer();

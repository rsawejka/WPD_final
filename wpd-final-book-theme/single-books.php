<?php
/**
 * Template Name: page-books
 * Template Post Type: books, book
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package rsawejka-book-theme
 */

get_header();

?>

    <main id="primary" class="site-main singleBookPage">
        <div class="singlePageWrapper">
        <?php
        $id = get_the_ID();
        $query = new \WP_Query(array('post_type' => 'books'));
        if ( $query->have_posts() ) :

             echo '<div class="singlePostPic">';
            the_post_thumbnail();
            echo  '</div>';
            echo '<div class="singePageContent">';
           echo '<h1>';
           the_title();
            echo '</h1>';
           // the_post();
           // $post = get_post();
          //  echo $post->author;


            get_template_part( 'template-parts/content', get_post_type() );



            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;
            echo '</div>';
            // the_excerpt();
        endif; // End of the loop.

        ?>

        </div>
    </main><!-- #main -->

<?php
get_footer();

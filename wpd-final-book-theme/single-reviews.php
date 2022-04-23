<?php
/**
 * Template Name: page-reviews
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package rsawejka-book-theme
 */

use booksPlugin\ReviewMeta;

get_header();
?>
<div class="booksMartinLikes flex">
        <?php
if ( have_posts() ) {
    while ( have_posts() ) {
        $author = get_post_meta(get_the_ID(), ReviewMeta::reviewerName, true);
        $bookid= get_post_meta(get_the_ID(), ReviewMeta::bookId, true);

        the_post(); ?>
<div>
    <?php echo get_the_post_thumbnail($bookid); ?>
   <?php echo '<h4 class="reviewBookTitle"><a href=' . get_permalink($bookid) . '>' . get_the_title($bookid) . '</a></h4>'?>
</div>

    <div>
        <h2 class="singleReviewHeader"><?php the_title(); ?></h2>

        <h2 class="singleReviewHeader">By: <?php echo $author ?></h2>

        <div class="singleReviewPost"><?php the_content(); ?></div>
    </div>

    <?php }
}

        ?>
</div>


<?php
get_footer();

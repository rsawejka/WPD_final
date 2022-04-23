<?php
/**
 * Template Name: page-allbooks
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package rsawejka-book-theme
 */

get_header();
?>

    <main id="primary" class="site-main singleBookPage">
    <h1 class="allBooksHeader">All Books</h1>
        <?php
        $query = new \WP_Query(array('post_type' => 'books'));
        echo "<div class='allBooks'>";
        if ($query->have_posts()) {
            while ($query->have_posts()) {

                $query->the_post();

                echo "<div class='indevidualBook'>";
                echo "<div class='postThumb'><a href=" . get_the_permalink() . ">";
                the_post_thumbnail();

                echo "</a></div>";
                echo '<a class="allBooksHref" href="' . get_the_permalink() . '">' . get_the_title() . "</a>" .
                    "<div> Published Date: " . get_post_meta(get_the_ID(), "publishedDate", true) . "</div>";

                echo "</div>";

            }

        } else {
            echo "<div>No Posts</div>";
        }
        echo "</div>";
        ?>


    </main><!-- #main -->

<?php
get_footer();

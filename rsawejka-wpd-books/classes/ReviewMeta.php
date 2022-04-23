<?php


namespace booksPlugin;


/**
 * Class ReviewMeta
 * @package booksPlugin
 */
class ReviewMeta extends Singleton
{
//the one place that the keys are stored in the database are refrenced
    /**
     * const reviewerName keyword for the reviewerName
     */
    const reviewerName = 'reviewerName';
    /**
     * const reviewerLocation keyword for the reviewerLocation
     */
    const reviewerLocation =  'reviewerLocation';
    /**
     * const rating keyword for the rating
     */
    const rating =  'rating';
    /**
     * const bookId keyword for the bookId
     */
    const bookId =  'bookId';


    //this needs to be redefined to make it unique to this class
    /**
     * @var $instance the instance of the page
     */
    protected static $instance;

    //set up our post type

    /**
     * ReviewMeta constructor.
     */
    protected function __construct(){
        add_action('admin_init', array($this, 'registerReviewMetaBoxes'));

        add_action('save_post_' . ReviewPostType::POST_TYPE, array($this, 'saveReviewMeta'));
    }

    //output the meta box on the page


    public function directionReviewMetaBox(){
        $post = get_post();
        $reviewerName = get_post_meta($post->ID, self::reviewerName, true);
        $reviewerLocation = get_post_meta($post->ID, self::reviewerLocation, true);
        $rating = get_post_meta($post->ID, self::rating, true);
        $bookId = get_post_meta($post->ID, self::bookId, true);
        ?>
        <p>
            <label for="reviewerName">Reviewer name: </label>
            <input type="text" id="reviewerName" name="reviewerName" value="<?= $reviewerName ?>">
        </p>
        <p>
            <label for="reviewerLocation">Reviewer location: </label>
            <input type="text" id="reviewerLocation" name="reviewerLocation" value="<?= $reviewerLocation ?>">
        </p>
        <p>
           <!-- <label for="rating">Rating(1-5): </label>
            <input name="rating" type="text" id="rating" value="//$rating needs php tags ?>">-->
            <label for="rating">Rating: </label>
            <select name="rating">
            <option <?php if ($_POST['rating'] = $rating && $rating == 1): echo "selected" ?> <?php endif; ?> value="1">1</option>
            <option <?php if($_POST['rating'] = $rating  && $rating == 2): echo "selected" ?> <?php endif; ?> value="2">2</option>
            <option <?php if($_POST['rating'] = $rating  && $rating == 3): echo "selected" ?> <?php endif; ?> value="3">3</option>
            <option <?php if($_POST['rating'] = $rating  && $rating == 4): echo "selected" ?> <?php endif; ?> value="4">4</option>
            <option <?php if($_POST['rating'] = $rating  && $rating == 5): echo "selected" ?> <?php endif; ?> value="5">5</option>
            </select>
        </p>
                <label for="bookId">Select The Book: </label>
                <select name="bookId" name="bookId" id="bookId">

                <?php
                $args = array(
                    'post_type' => 'books',
                    'posts_per_page' => -1,

                );

                $pages = get_posts($args);
                foreach ( $pages as $page ) {


                    ?>
                    <option <?php if($bookId == $page->ID): ?> selected<?php endif; ?> value="<?=   $page->ID  ?>"><?= $page->post_title ?></option>

<?php
                }

                ?>
     <?php



        ?>



        </select>




        <?php

    }

    //register the custom metabox
    //if have a few meta boxes you can register here too.

    function registerReviewMetaBoxes(){
        add_meta_box('review_meta', 'Directions', array($this, 'directionReviewMetaBox'), ReviewPostType::POST_TYPE, 'normal');

        //register other meta boxes here

    }


    public function saveReviewMeta(){
        //get the current post that is being edited
        $post = get_post();

        //get each field and update it
        if(isset($_POST['reviewerName'])){
            //validate/sanitize
            $reviewerName = sanitize_text_field($_POST['reviewerName']);

            //single funtion will insert/update
            update_post_meta($post->ID, self::reviewerName, $reviewerName);
        }
        if(isset($_POST['reviewerLocation'])){
            //validate/sanitize
            $reviewerLocation = sanitize_text_field($_POST['reviewerLocation']);

            //single funtion will insert/update
            update_post_meta($post->ID, self::reviewerLocation, $reviewerLocation);
        }
        if(isset($_POST['rating'])){
            //validate/sanitize
            $rating = sanitize_text_field($_POST['rating']);

            //single funtion will insert/update
            update_post_meta($post->ID, self::rating, $rating);
        }
        if(isset($_POST['bookId'])){
            //validate/sanitize
            $bookId = ($_POST['bookId']);

            //single funtion will insert/update
            update_post_meta($post->ID, self::bookId, $bookId);
        }


    }
}
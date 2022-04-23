<?php


namespace booksPlugin;


/**
 * Class BookMeta
 * @package booksPlugin
 */
class BookMeta extends Singleton
{
    //the one place that the keys are stored in the database are refrenced
    /**
     * const author keyword for the author
     */
    const author = 'author';
    /**
     * const publisher keyword for the publisher
     */
    const publisher =  'publisher';
    /**
     * const publishedDate keyword for the publishedDate
     */
    const publishedDate =  'publishedDate';
    /**
     * const pageCount keyword for the pagecount
     */
    const pageCount =  'pageCount';
    /**
     * const price keyword for the price
     */
    const price =  'price';


    //this needs to be redefined to make it unique to this class
    /**
     * @var $instance the instance of the page
     */
    protected static $instance;

    //set up our post type

    /**
     * BookMeta constructor.
     */
    protected function __construct(){
        add_action('admin_init', array($this, 'registerMetaBoxes'));

        add_action('save_post_' . BookPostType::POST_TYPE, array($this, 'saveBookMeta'));
    }

    //output the meta box on the page

    public function directionMetaBox(){
        $post = get_post();
        $author = get_post_meta($post->ID, self::author, true);
        $publisher = get_post_meta($post->ID, self::publisher, true);
        $publishedDate = get_post_meta($post->ID, self::publishedDate, true);
        $pageCount = get_post_meta($post->ID, self::pageCount, true);
        $price = get_post_meta($post->ID, self::price, true);
        ?>
        <p>
            <label for="author">Author: </label>
            <input type="text" id="author" name="author" value="<?= $author ?>">
        </p>
        <p>
            <label for="publisher">Publisher: </label>
            <input type="text" id="publisher" name="publisher" value="<?= $publisher ?>">
        </p>
        <p>
            <label for="publishedDate">Published date: </label>
            <input type="text" id="publishedDate" name="publishedDate" value="<?= $publishedDate ?>">
        </p>
        <p>
            <label for="pageCount">Page count: </label>
            <input type="text" id="pageCount" name="pageCount" value="<?= $pageCount ?>">
        </p>
        <p>
            <label for="price">Price: </label>
            <input type="text" id="price" name="price" value="<?= $price ?>">
        </p>

        <?php

    }

    //register the custom metabox
    //if have a few meta boxes you can register here too.

    function registerMetaBoxes(){
        add_meta_box('book_meta', 'Directions', array($this, 'directionMetaBox'), BookPostType::POST_TYPE, 'normal');

        //register other meta boxes here

    }


    public function saveBookMeta(){
        //get the current post that is being edited
        $post = get_post();

        //get each field and update it
        if(isset($_POST['author'])){
            //validate/sanitize
            $author = sanitize_text_field($_POST['author']);

            //single funtion will insert/update
            update_post_meta($post->ID, self::author, $author);
        }
        if(isset($_POST['publisher'])){
            //validate/sanitize
            $publisher = sanitize_text_field($_POST['publisher']);

            //single funtion will insert/update
            update_post_meta($post->ID, self::publisher, $publisher);
        }
        if(isset($_POST['publishedDate'])){
            //validate/sanitize
            $publishedDate = sanitize_text_field($_POST['publishedDate']);

            //single funtion will insert/update
            update_post_meta($post->ID, self::publishedDate, $publishedDate);
        }
        if(isset($_POST['pageCount'])){
            //validate/sanitize
            $pageCount = sanitize_text_field($_POST['pageCount']);

            //single funtion will insert/update
            update_post_meta($post->ID, self::pageCount, $pageCount);
        }
        if(isset($_POST['price'])){
            //validate/sanitize
            $price = sanitize_text_field($_POST['price']);

            //single funtion will insert/update
            update_post_meta($post->ID, self::price, $price);
        }
    }
}
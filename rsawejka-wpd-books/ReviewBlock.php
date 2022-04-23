<?php


namespace booksPlugin;


/*
Plugin Name: Review Block
Description: display a random review using a short code
Version: 1.0.0
Author: Ryan Sawejka
Text Domain: rsawejka-wpd-books
 */

/**
 * Class ReviewBlock
 * @package booksPlugin
 */
class ReviewBlock{
    //static attribute to hold the single instance
    /**
     * @var $instance the instance of the page
     */
    private static $instance;

    //make constructor private so objects cannot be created outside of file

    /**
     * ReviewBlock constructor.
     */
    private function __construct(){
        //here is where we define all of our hooks (actions/filters), shortcodes, widgets
        add_shortcode("review", array($this, 'reviewShortcode'));

        //would be the same of any hook
        //add_action('login_enqueue_scripts', array($this. 'recover_login_logo')

    }

    //prevent cloning


    private  function __clone(){}

      //method that will create a new instance or return the exsisting one
      //this insures that there will only be one
    /**
     * @return mixed make sure output is new instance
     */
    public static function getInstance(){
          if(self::$instance == null){
              self::$instance == new self();
          }

          return self::$instance;
      }
      //any actions/filter methods need to be public

    /**
     * @return string return the short code
     */
    function reviewShortcode()
    {

        $args = array(
            'post_type' => 'reviews',
            'posts_per_page' => '1',
            'orderby' => 'rand',
        );

        $query = new \WP_Query($args);

        if ($query->have_posts()) :
            while ($query->have_posts()) :

                $query->the_post();
                $bookid= get_post_meta(get_the_ID(), ReviewMeta::bookId, true);
                $author = get_post_meta(get_the_ID(), ReviewMeta::reviewerName, true);
                $reviewerLocation = get_post_meta(get_the_ID(), ReviewMeta::reviewerLocation, true);
                $rating = get_post_meta(get_the_ID(), ReviewMeta::rating, true);
                $result = '<div class="reviewBlock">';

                $result .= '<h2 class="postTitle"><a href="' . get_permalink($bookid) .  '">' . get_the_title() . '</a></h2>';

                $result .= '<div class="rating">';
                if($rating == 5){

                    $result .=   '<span class="dashicons dashicons-star-filled red"></span>
                              <span class="dashicons dashicons-star-filled red"></span>
                              <span class="dashicons dashicons-star-filled red"></span>
                              <span class="dashicons dashicons-star-filled red"></span>
                              <span class="dashicons dashicons-star-filled red"></span>';
                }elseif ($rating == 4){
                    $result .='<span class="dashicons dashicons-star-filled red"></span>
                    <span class="dashicons dashicons-star-filled red"></span>
                    <span class="dashicons dashicons-star-filled red"></span>
                    <span class="dashicons dashicons-star-filled red"></span>';
                }elseif ($rating == 3){
                    $result .=     '<span class="dashicons dashicons-star-filled red"></span>
                    <span class="dashicons dashicons-star-filled red"></span>
                    <span class="dashicons dashicons-star-filled red"></span>';
                }elseif ($rating == 2){
                    $result .=     '<span class="dashicons dashicons-star-filled red"></span>
                    <span class="dashicons dashicons-star-filled red"></span>';
                }else{
                    $result .=     '<span class="dashicons dashicons-star-filled red"></span>';
                }
                $result .= '</div>';



                $result .= '<div class="ABTheExcerpt">' . get_the_excerpt() . '</div>';
                $result .= '<div class="ABTheAuthorLocation"><span>By:  '. $author . '</span>' . " ";
                $result .= '<span class="dashicons dashicons-location reviewerLocation">' . $reviewerLocation . '</span></div>';
                $result .= '</div>';//closing for review block
            endwhile;

            wp_reset_postdata();

        endif;
        return $result;
    }



}


//instantiate our plug in(create the class object and run the constructor)
ReviewBlock::getInstance();
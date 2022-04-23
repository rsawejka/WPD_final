<?php


namespace booksPlugin;


/**
 * Class ReviewPostType
 * @package booksPlugin
 */
class ReviewPostType extends Singleton
{

    /**
     * const POST_TYPE keyword for the post type
     */
    const POST_TYPE = 'reviews';
    //this needs to be redefined to make it unique to this class
    /**
     * @var $instance the instance of the page
     */
    protected static $instance;

    //set up our post type

    /**
     * ReviewPostType constructor.
     */
    protected function __construct()
    {
        //add our hooks
        add_action('init', array($this, 'registerReviewPostType'));

        add_filter('the_content', array($this, 'reviewContent'));
    }

    // Register Custom Post Type


    function registerReviewPostType()
    {

        $labels = array(
            'name' => _x('Reviews', 'Post Type General Name', TEXT_DOMAIN),
            'singular_name' => _x('Review', 'Post Type Singular Name', TEXT_DOMAIN),
            'menu_name' => __('Reviews', TEXT_DOMAIN),
            'name_admin_bar' => __('Review', TEXT_DOMAIN),
            'archives' => __('Review Archives', TEXT_DOMAIN),
            'attributes' => __('Review Attributes', TEXT_DOMAIN),
            'parent_item_colon' => __('Parent Item:', TEXT_DOMAIN),
            'all_items' => __('All Reviews', TEXT_DOMAIN),
            'add_new_item' => __('Add New Review', TEXT_DOMAIN),
            'add_new' => __('Add Review', TEXT_DOMAIN),
            'new_item' => __('New Review', TEXT_DOMAIN),
            'edit_item' => __('Edit Review', TEXT_DOMAIN),
            'update_item' => __('Update Review', TEXT_DOMAIN),
            'view_item' => __('View Review', TEXT_DOMAIN),
            'view_items' => __('View Review', TEXT_DOMAIN),
            'search_items' => __('Search Item', TEXT_DOMAIN),
            'not_found' => __('Not found', TEXT_DOMAIN),
            'not_found_in_trash' => __('Not found in Trash', TEXT_DOMAIN),
            'featured_image' => __('Featured Image', TEXT_DOMAIN),
            'set_featured_image' => __('Set featured image', TEXT_DOMAIN),
            'remove_featured_image' => __('Remove featured image', TEXT_DOMAIN),
            'use_featured_image' => __('Use as featured image', TEXT_DOMAIN),
            'insert_into_item' => __('Insert into item', TEXT_DOMAIN),
            'uploaded_to_this_item' => __('Uploaded to this item', TEXT_DOMAIN),
            'items_list' => __('Items list', TEXT_DOMAIN),
            'items_list_navigation' => __('Items list navigation', TEXT_DOMAIN),
            'filter_items_list' => __('Filter items list', TEXT_DOMAIN),
        );
        $args = array(
            'label' => __('Review', TEXT_DOMAIN),
            'description' => __('plug in for Reviews', TEXT_DOMAIN),
            'labels' => $labels,
            'supports' => array('title', 'editor', 'excerpt'),
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-star-filled',
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'can_export' => true,
            'has_archive' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'capability_type' => 'post',
            'show_in_rest' => false,
        );
        register_post_type(self::POST_TYPE, $args);

    }

    /**
     * @param $content the content for the page
     * @return string a string of the page content
     */
    public function reviewContent($content)
    {
        //$content is the content that WP generated

        $post = get_post();


        //only do this for reviews
        if ($post->post_type == ReviewPostType::POST_TYPE) {
            $reviewerName = get_post_meta($post->ID, ReviewMeta::reviewerName, true);
            $reviewerLocation = get_post_meta($post->ID, ReviewMeta::reviewerLocation, true);
            $rating = get_post_meta($post->ID, ReviewMeta::rating, true);

            /*$content = "<div>$content</div>
                        <div class='reviewBox'>
                        <h3>Reviews</h3>
                        ";

            if($rating == 5){
                $content .=   '<span class="dashicons dashicons-star-filled red"></span>
                              <span class="dashicons dashicons-star-filled red"></span>
                              <span class="dashicons dashicons-star-filled red"></span>
                              <span class="dashicons dashicons-star-filled red"></span>
                              <span class="dashicons dashicons-star-filled red"></span>';
                }elseif ($rating == 4){
                    $content .='<span class="dashicons dashicons-star-filled red"></span>
                    <span class="dashicons dashicons-star-filled red"></span>
                    <span class="dashicons dashicons-star-filled red"></span>
                    <span class="dashicons dashicons-star-filled red"></span>';
                }elseif ($rating == 3){
                    $content .=     '<span class="dashicons dashicons-star-filled red"></span>
                    <span class="dashicons dashicons-star-filled red"></span>
                    <span class="dashicons dashicons-star-filled red"></span>';
                }elseif ($rating == 2){
                    $content .=     '<span class="dashicons dashicons-star-filled red"></span>
                    <span class="dashicons dashicons-star-filled red"></span>';
                }else{
                $content .=     '<span class="dashicons dashicons-star-filled red"></span>';
                }
                $content .="<p>Reviewer Name: $reviewerName</p>
                            <p>Reviewer Location: $reviewerLocation</p>";

                $content .="<div>$post->post_content</div>";*/

        }
        return $content;
    }


}
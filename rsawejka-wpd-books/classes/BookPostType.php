<?php


namespace booksPlugin;


/**
 * Class BookPostType
 * @package booksPlugin
 */
class BookPostType extends Singleton
{
    /**
     *
     */
    const POST_TYPE = 'books';
    //this needs to be redefined to make it unique to this class
    /**
     * @var $instance the instance of the page
     */
    protected static $instance;

    //set up our post type

    /**
     * BookPostType constructor.
     */
    protected function __construct(){
        //add our hooks
        add_action('init', array($this, 'registerBookPostType'));

        add_filter('the_content', array($this, 'bookContenet'));
    }

    // Register Custom Post Type


    function registerBookPostType() {

        $labels = array(
            'name'                  => _x( 'Books', 'Post Type General Name', TEXT_DOMAIN ),
            'singular_name'         => _x( 'Book', 'Post Type Singular Name', TEXT_DOMAIN ),
            'menu_name'             => __( 'Books', TEXT_DOMAIN ),
            'name_admin_bar'        => __( 'Book', TEXT_DOMAIN ),
            'archives'              => __( 'Book Archives', TEXT_DOMAIN ),
            'attributes'            => __( 'Book Attributes', TEXT_DOMAIN ),
            'parent_item_colon'     => __( 'Parent Item:', TEXT_DOMAIN ),
            'all_items'             => __( 'All books', TEXT_DOMAIN ),
            'add_new_item'          => __( 'Add New Item', TEXT_DOMAIN ),
            'add_new'               => __( 'Add book', TEXT_DOMAIN ),
            'new_item'              => __( 'New book', TEXT_DOMAIN ),
            'edit_item'             => __( 'Edit book', TEXT_DOMAIN ),
            'update_item'           => __( 'Update book', TEXT_DOMAIN ),
            'view_item'             => __( 'View book', TEXT_DOMAIN ),
            'view_items'            => __( 'View book', TEXT_DOMAIN ),
            'search_items'          => __( 'Search Item', TEXT_DOMAIN ),
            'not_found'             => __( 'Not found', TEXT_DOMAIN ),
            'not_found_in_trash'    => __( 'Not found in Trash', TEXT_DOMAIN ),
            'featured_image'        => __( 'Featured Image', TEXT_DOMAIN ),
            'set_featured_image'    => __( 'Set featured image', TEXT_DOMAIN ),
            'remove_featured_image' => __( 'Remove featured image', TEXT_DOMAIN ),
            'use_featured_image'    => __( 'Use as featured image', TEXT_DOMAIN ),
            'insert_into_item'      => __( 'Insert into item', TEXT_DOMAIN ),
            'uploaded_to_this_item' => __( 'Uploaded to this item', TEXT_DOMAIN ),
            'items_list'            => __( 'Items list', TEXT_DOMAIN ),
            'items_list_navigation' => __( 'Items list navigation', TEXT_DOMAIN ),
            'filter_items_list'     => __( 'Filter items list', TEXT_DOMAIN ),
        );
        $args = array(
            'label'                 => __( 'Book', TEXT_DOMAIN ),
            'description'           => __( 'plug in for books', TEXT_DOMAIN ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'menu_icon'             => 'dashicons-book',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'post',
            'show_in_rest'          => true,
        );
        register_post_type( self::POST_TYPE, $args );

    }

    /**
     * @param $content the page content
     * @return string the string of all the content
     */
    public function bookContenet($content){
        //$content is the content that WP generated


        $post = get_post();

        //only do this for books
        if($post->post_type == BookPostType::POST_TYPE){
          $author = get_post_meta($post->ID, BookMeta::author, true);
          $publisher = get_post_meta($post->ID, BookMeta::publisher, true);
          $publishedDate = get_post_meta($post->ID, BookMeta::publishedDate, true);
          $pageCount = get_post_meta($post->ID, BookMeta::pageCount, true);
          $price = get_post_meta($post->ID, BookMeta::price, true);



           $content = "
                        <h2>Summary</h2>
                        <p>$content</p>
                        <table>
                        <tr><td><h3>Book Info</h3></td></tr>
                        <tr><td>Author: $author</td></tr>
                        <tr><td>Publisher: $publisher</td></tr>
                        <tr><td>Published date: $publishedDate</td></tr>
                        <tr><td>Page count: $pageCount</td></tr>
                        <tr><td>Price: $price</td></tr>
                        </table>";

            $content .="<h2>Reviews</h2><div class='reviewFlex'>";
            $query = new \WP_Query(array('post_type' => ReviewPostType::POST_TYPE, 'meta_key' => ReviewMeta::bookId, 'meta_value' => $post->ID));

            while ($query->have_posts()) {
                $rating = $post->rating;
                $content .= "<div class='card padding-bottom'>";

                $content .= "<div>";
                $query->the_post();
                $post = get_post();

                $content .= "<div class='reviewCard'><h3>" . $post->reviewerName . "</h3>";
                $content .= "<h3>" . $post->reviewerLocation . "</h3></div>";
                $content .= "<div class='rating'><span>Rating: </span>";
                if( $post->rating == 5){
                    $content .=   '<span class="dashicons dashicons-star-filled white"></span>
                              <span class="dashicons dashicons-star-filled white"></span>
                              <span class="dashicons dashicons-star-filled white"></span>
                              <span class="dashicons dashicons-star-filled white"></span>
                              <span class="dashicons dashicons-star-filled white"></span></div>';
                }elseif ( $post->rating == 4){
                    $content .='<span class="dashicons dashicons-star-filled white"></span>
                    <span class="dashicons dashicons-star-filled white"></span>
                    <span class="dashicons dashicons-star-filled white"></span>
                    <span class="dashicons dashicons-star-filled white"></span></div>';
                }elseif ( $post->rating == 3){
                    $content .=     '<span class="dashicons dashicons-star-filled white"></span>
                    <span class="dashicons dashicons-star-filled white"></span>
                    <span class="dashicons dashicons-star-filled white"></span></div>';
                }elseif ( $post->rating == 2){
                    $content .=     '<span class="dashicons dashicons-star-filled white"></span>
                    <span class="dashicons dashicons-star-filled white"></span></div>';
                }else{
                    $content .=     '<span class="dashicons dashicons-star-filled white"></span></div>';
                }
                $excerpt = get_the_excerpt();

                $excerpt = substr($excerpt, 0, 200);
                $content .= "<div>" . $excerpt . "</div>";
                $content .= "<div class='reviewLink'><a href=" . get_the_permalink($post->ID) . ">Read More</a></div>";




                $content .= "</div>";
                $content .= "</div>";


            }
            $content .= "</div>";
        }

        //return out side of if statement
        return $content;
    }





}
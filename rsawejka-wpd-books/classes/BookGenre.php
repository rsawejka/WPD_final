<?php


namespace booksPlugin;


/**
 * Class BookGenre
 * @package booksPlugin
 */
class BookGenre extends Singleton
{
    /**
     * const TAX keyword for the taxonomy
     */
    const TAX = 'bookGenre';
    //this needs to be redefined to make it unique to this class
    /**
     * @var $instance the instance of the page
     */
    protected static $instance;

    //set up our post type

    /**
     * BookGenre constructor.
     */
    protected function __construct(){
        //add our hooks
        add_action('init', array($this, 'bookGenre'));
    }

    // Register Custom Taxonomy

    function bookGenre() {

        $labels = array(
            'name'                       => _x( 'Genre', 'Taxonomy General Name', TEXT_DOMAIN ),
            'singular_name'              => _x( 'Genre', 'Taxonomy Singular Name', TEXT_DOMAIN ),
            'menu_name'                  => __( 'Genres', TEXT_DOMAIN ),
            'all_items'                  => __( 'All Genres', TEXT_DOMAIN ),
            'parent_item'                => __( 'Parent Item', TEXT_DOMAIN ),
            'parent_item_colon'          => __( 'Parent Item:', TEXT_DOMAIN ),
            'new_item_name'              => __( 'New Genre Name', TEXT_DOMAIN ),
            'add_new_item'               => __( 'Add New Genre', TEXT_DOMAIN ),
            'edit_item'                  => __( 'Edit Genre', TEXT_DOMAIN ),
            'update_item'                => __( 'Update Genre', TEXT_DOMAIN ),
            'view_item'                  => __( 'View Genre', TEXT_DOMAIN ),
            'separate_items_with_commas' => __( 'Separate items with commas', TEXT_DOMAIN ),
            'add_or_remove_items'        => __( 'Add or remove items', TEXT_DOMAIN ),
            'choose_from_most_used'      => __( 'Choose from the most used', TEXT_DOMAIN ),
            'popular_items'              => __( 'Popular Items', TEXT_DOMAIN ),
            'search_items'               => __( 'Search Items', TEXT_DOMAIN ),
            'not_found'                  => __( 'Not Found', TEXT_DOMAIN ),
            'no_terms'                   => __( 'No items', TEXT_DOMAIN ),
            'items_list'                 => __( 'Items list', TEXT_DOMAIN ),
            'items_list_navigation'      => __( 'Items list navigation', TEXT_DOMAIN ),
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
            'show_in_rest'               => true,
        );
        register_taxonomy( self::TAX, array( BookPostType::POST_TYPE ), $args );

    }
}
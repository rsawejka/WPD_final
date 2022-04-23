<?php


class BookList extends WP_Widget
{
public function __construct()
{
    $widget_options = array('description' => "Genre List");
    parent::__construct("ryan-sawejka-fiveforfive-widget", "Genre List");
}
public function form($instance)
{
$title = $instance['title'] ?? 'Default Title';


?>
    <p>
        <label for="<?=$this->get_field_id('title') ?>">Title</label>
        <input type="text"
               name="<?=$this->get_field_name('title') ?>"
               id="<?=$this->get_field_id('title') ?>"
               value="<?= $title ?>"
               class="widefat">
    </p>
<?php
}
    public function update($new_instance, $old_instance)
    {
        //choose what to update
        //and validate/sanitize
        $instance = array();
        $instance['title'] = strip_tags($new_instance['title']);

        //return whatever you want to be saved in the database for this widget
        return $instance;
    }
    public function widget($args, $instance)
    {
        //$args are the arguemnts passed in from the resister_sidebar() function in the functions file
        echo $args['before_widget'];
        //output title if its not empty
        if (!empty($instance['title'])) {
            echo $args['before_title'] . $instance['title'] . $args['after_title'];
        }
        //body of widget
        echo nl2br($instance['body']);

        $the_query = new WP_Query(array(

            'post_type' => 'books',



        ));

        if ($the_query->have_posts()) {

            echo '<ul id="genreList">';
            while ($the_query->have_posts()) {

               $the_query->the_post();


                echo '<a href="' . get_the_permalink() . '">' .
                    "<li> Item: ". get_the_title() . "</li>" //.
                  //  "<li> Item: ". get_the_category_list() . "</li>"
                ;
                /* function get_genres( $args = '' )
                 {
                     $defaults = array('taxonomy' => 'genre');
                     $args = wp_parse_args($args, $defaults);

                     $args['taxonomy'] = apply_filters( 'get_categories_taxonomy', $args['taxonomy'], $args );
                     $genres = get_terms( $args );

                     return $genres;
                 }*/

            }
            echo '</ul>';
        } else {
            // no posts found
        }
        //$content is the content that WP generated




        wp_reset_postdata();

        echo $args['after_widget'];
    }
    }
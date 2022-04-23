<?php


/**
 * Class BookList
 */
class BookList extends WP_Widget
{
    /**
     * BookList constructor.
     */
    public function __construct()
    {
        $widget_options = array('description' => "Book List");
        parent::__construct("ryan-sawejka-fiveforfive-widget", "Book List");
    }

    /**
     * @param array $instance the instance on the site
     * @return string|void
     */
    public function form($instance)
    {
        $title = $instance['title'] ?? 'Default Title';
        $amount = $instance['amount'] ?? 5;


        ?>
        <p>
            <label for="<?= $this->get_field_id('title') ?>">Title</label>
            <input type="text"
                   name="<?= $this->get_field_name('title') ?>"
                   id="<?= $this->get_field_id('title') ?>"
                   value="<?= $title ?>"
                   class="widefat">
        </p>
        <p>
            <label for="<?= $this->get_field_id('amount') ?>">Number Of Posts</label>
            <input type="text"
                   name="<?= $this->get_field_name('amount') ?>"
                   id="<?= $this->get_field_id('amount') ?>"
                   value="<?= $amount ?>"
                   class="widefat">
        </p>
        <?php
    }

    /**
     * @param array $new_instance most updated instance
     * @param array $old_instance old instance just incase
     * @return array an array of all the data inputted by user
     */
    public function update($new_instance, $old_instance)
    {
        //choose what to update
        //and validate/sanitize
        $instance = array();
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['amount'] = strip_tags($new_instance['amount']);

        //return whatever you want to be saved in the database for this widget
        return $instance;
    }

    /**
     * @param array $args the arguments for the expression
     * @param array $instance the instance of the page
     */
    public function widget($args, $instance)

    {

        //$args are the arguemnts passed in from the resister_sidebar() function in the functions file
        echo $args['before_widget'];
        //output title if its not empty
        if (!empty($instance['title'])) {
            echo $args['before_title'] . $instance['title'] . $args['after_title'];
        }
        //body of widget
        //echo nl2br($instance['body']);

        $the_query = new WP_Query(array(

            'post_type' => 'books',
            'posts_per_page' => $instance['amount'],
            'orderby' => 'rand'


        ));

        if ($the_query->have_posts()) {
            echo '<ul id="fiveBooks">';
            while ($the_query->have_posts()) {

                $the_query->the_post();
                echo '<div class="entryWrapper">';
                echo '<a href="' . get_the_permalink() . '">' .
                    "<li> " . get_the_title() . "<span class='dashicons dashicons-arrow-right-alt arrows'></li></span></a>" .
                    "<li class='date'> Published Date: " . get_post_meta(get_the_ID(), "publishedDate", true) . "</li>";
                echo '</div>';
            }
            echo '</ul>';

        } else {
            echo "<div>No Posts</div>";
        }


        wp_reset_postdata();
        echo $args['after_widget'];
    }
}
<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package rsawejka-book-theme
 */

?>

</div><!--mainWrapper-->
<footer>
    <nav id="site-navigation" class="main-navigation headerNav">
        <?php
        wp_nav_menu(
            array(
                'theme_location' => 'menu-1',
                'menu_id'        => 'primary-menu',
            )
        );
        ?>

    </nav>
    <div><span>&copy;</span>Ryan Sawejka</div>
</footer>
</div><!-- #page -->


</body>
</html>

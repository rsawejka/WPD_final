<?php
/**
 * @wordpress-plugin
 * Plugin Name: Books
 * Description: George rr Martin books
 * Author: Ryan Sawejka
 * Version: 1.0.0
 * Text Domain: rsawejka-wpd-books
 */

namespace booksPlugin;
define('TEXT_DOMAIN', 'rsawejka-wpd-books');

include __DIR__ . '/classes/Singleton.php';
include __DIR__ . '/classes/BookPostType.php';
include __DIR__ . '/classes/ReviewPostType.php';
include __DIR__ . '/classes/BookGenre.php';
include __DIR__ . '/classes/ReviewMeta.php';
include __DIR__ . '/classes/BookMeta.php';


BookPostType::getInstance();
BookGenre::getInstance();
BookMeta::getInstance();
ReviewMeta::getInstance();
ReviewPostType::getInstance();


register_activation_hook(__FILE__, 'booksPlugin/activate_book_plugin');
function activate_book_plugin(){

    //make sure the post type is registered before cache is cleared.
    $bookPostType =  BookPostType::getInstance();
    $bookPostType ->registerBookPostType();

    $reviewPostType =  ReviewPostType::getInstance();
    $reviewPostType ->registerReviewPostType();

    ReviewPostType::getInstance() -> registerReviewPostType();
    BookGenre::getInstance() -> bookGenre();
    //clears the cache so the permalinks for our custom post types works.
    flush_rewrite_rules();
};


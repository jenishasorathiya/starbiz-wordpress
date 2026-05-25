<?php
/**
 * Extra theme features
 *
 * @package starbiz
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Add excerpt support for pages
add_post_type_support( 'page', 'excerpt' );
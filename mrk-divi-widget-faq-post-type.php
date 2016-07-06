<?php
/*
 * Plugin Name: FAQ - Post Type Divi Widget
 * Plugin URI: http://mrkdevelopment.com
 * Description: Addon for Divi Widget for FAQ post type.
 * Version: 1.0
 * Author: M R K Development
 * Author URI: http://mrkdevelopment.com
 * License: GPLv2 or later
 */
if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}


// constants
define('MRK_FAQ_DIVI_WIDGET_DIR', __DIR__);
define('MRK_FAQ_DIVI_WIDGET_URL', plugins_url('/'.basename(__DIR__)));


require_once MRK_FAQ_DIVI_WIDGET_DIR.'/src/class-mrk-divi-widget-faq-post-type-activate.php';
register_activation_hook(__FILE__, array('MRK_Divi_Widget_Faq_Post_Type_Activate', 'activate'));


/**
 * Defines variables for
 * @return [type] [description]
 */
function register_mrk_divi_widget_faq_post_type()
{
    require_once MRK_FAQ_DIVI_WIDGET_DIR . '/src/widgets/MrkDiviWidgetFaqPostType.php';
}

add_action('et_builder_ready', 'register_mrk_divi_widget_faq_post_type', 1);

// Register Custom Post Type - FAQ
function custom_post_type_faq()
{
    $labels = array(
        'name'                  => _x( 'FAQs', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'FAQ', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'FAQs', 'text_domain' ),
        'name_admin_bar'        => __( 'FAQ', 'text_domain' ),
        'archives'              => __( 'Item Archives', 'text_domain' ),
        'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
        'all_items'             => __( 'All Items', 'text_domain' ),
        'add_new_item'          => __( 'Add New Item', 'text_domain' ),
        'add_new'               => __( 'Add New', 'text_domain' ),
        'new_item'              => __( 'New Item', 'text_domain' ),
        'edit_item'             => __( 'Edit Item', 'text_domain' ),
        'update_item'           => __( 'Update Item', 'text_domain' ),
        'view_item'             => __( 'View Item', 'text_domain' ),
        'search_items'          => __( 'Search Item', 'text_domain' ),
        'not_found'             => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        'featured_image'        => __( 'Featured Image', 'text_domain' ),
        'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
        'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
        'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
        'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
        'items_list'            => __( 'Items list', 'text_domain' ),
        'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
    );
    $rewrite = array(
        'slug'                  => 'faqs',
        'with_front'            => false,
        'pages'                 => false,
        'feeds'                 => true,
    );
    $args = array(
        'label'                 => __( 'FAQ', 'text_domain' ),
        'description'           => __( 'FAQ Post Type', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array('title', 'editor'),
        'taxonomies'            => array( 'faq_category' ),
        'hierarchical'          => false,
        'public'                => false,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-welcome-learn-more',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'rewrite'               => $rewrite,
        'capability_type'       => 'post',
    );
    register_post_type( 'faq', $args );
}
add_action( 'init', 'custom_post_type_faq', 0 );

// Register Custom Taxonomy
function custom_faq_taxonomy()
{
    $labels = array(
        'name'                       => _x( 'FAQ Categories', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'FAQ', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Taxonomy', 'text_domain' ),
        'all_items'                  => __( 'All Items', 'text_domain' ),
        'parent_item'                => __( 'Parent Item', 'text_domain' ),
        'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
        'new_item_name'              => __( 'New Item Name', 'text_domain' ),
        'add_new_item'               => __( 'Add New Item', 'text_domain' ),
        'edit_item'                  => __( 'Edit Item', 'text_domain' ),
        'update_item'                => __( 'Update Item', 'text_domain' ),
        'view_item'                  => __( 'View Item', 'text_domain' ),
        'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
        'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
        'popular_items'              => __( 'Popular Items', 'text_domain' ),
        'search_items'               => __( 'Search Items', 'text_domain' ),
        'not_found'                  => __( 'Not Found', 'text_domain' ),
        'no_terms'                   => __( 'No items', 'text_domain' ),
        'items_list'                 => __( 'Items list', 'text_domain' ),
        'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
    );
    $rewrite = array(
        'slug'                       => 'faq_categories',
        'with_front'                 => true,
        'hierarchical'               => false,
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => false,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'rewrite'                    => $rewrite,
    );
    register_taxonomy( 'faq_category', array( 'faq' ), $args );
}

add_action( 'init', 'custom_faq_taxonomy', 0 );



if ( ! function_exists( 'et_builder_include_faq_categories_option' ) ) :
function et_builder_include_faq_categories_option($args = array())
{
    $defaults = apply_filters( 'et_builder_include_categories_defaults', array (
        'use_terms' => true,
        'term_name' => $args['render_options']['term_name'],
    ) );

    $args = wp_parse_args( $args, $defaults );

    $output = "\t" . "<% var et_pb_include_categories_temp = typeof et_pb_include_categories !== 'undefined' ? et_pb_include_categories.split( ',' ) : []; %>" . "\n";

    if ( $args['use_terms'] ) {
        $cats_array = get_terms( $args['term_name'] );
    } else {
        $cats_array = get_categories( apply_filters( 'et_builder_get_categories_args', 'hide_empty=0' ) );
    }

    if ( empty( $cats_array ) ) {
        $output = '<p>' . esc_html__( "You currently don't have any projects assigned to a category.", 'et_builder' ) . '</p>';
    }

    foreach ( $cats_array as $category ) {
        $contains = sprintf(
            '<%%= _.contains( et_pb_include_categories_temp, "%1$s" ) ? checked="checked" : "" %%>',
            esc_html( $category->term_id )
        );

        $output .= sprintf(
            '%4$s<label><input type="checkbox" name="et_pb_include_categories" value="%1$s"%3$s> %2$s</label><br/>',
            esc_attr( $category->term_id ),
            esc_html( $category->name ),
            $contains,
            "\n\t\t\t\t\t"
        );
    }

    $output = '<div id="et_pb_include_categories">' . $output . '</div>';

    return apply_filters( 'et_builder_include_categories_option_html', $output );
}
endif;

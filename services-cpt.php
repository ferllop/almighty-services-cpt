<?php
/*
Plugin Name: Services Custom Post Type
Plugin URI: https://ferranllop.com/
Description: Services Custom Post Type
Version: 1.0
Author: Ferran Llop
Author URI: https://ferranllop.com/
*/

add_action( 'init', 'almighty_services_post_type' );
if ( ! function_exists('almighty_services_post_type') ) {
	function almighty_services_post_type() {

		$labels = array(
			'name'                  => _x( 'Services', 'Post Type General Name', 'almighty-services-cpt' ),
			'singular_name'         => _x( 'Service', 'Post Type Singular Name', 'almighty-services-cpt' ),
			'menu_name'             => __( 'Services', 'almighty-services-cpt' ),
			'name_admin_bar'        => __( 'Services', 'almighty-services-cpt' ),
			'archives'              => __( 'Service Archives', 'almighty-services-cpt' ),
			'attributes'            => __( 'Service Attributes', 'almighty-services-cpt' ),
			'parent_item_colon'     => __( 'Parent Service:', 'almighty-services-cpt' ),
			'all_items'             => __( 'All Services', 'almighty-services-cpt' ),
			'add_new_item'          => __( 'Add New Service', 'almighty-services-cpt' ),
			'add_new'               => __( 'Add New', 'almighty-services-cpt' ),
			'new_item'              => __( 'New Service', 'almighty-services-cpt' ),
			'edit_item'             => __( 'Edit Service', 'almighty-services-cpt' ),
			'update_item'           => __( 'Update Service', 'almighty-services-cpt' ),
			'view_item'             => __( 'View Service', 'almighty-services-cpt' ),
			'view_items'            => __( 'View Service', 'almighty-services-cpt' ),
			'search_items'          => __( 'Search Service', 'almighty-services-cpt' ),
			'not_found'             => __( 'Not found', 'almighty-services-cpt' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'almighty-services-cpt' ),
			'featured_image'        => __( 'Featured Image', 'almighty-services-cpt' ),
			'set_featured_image'    => __( 'Set featured image', 'almighty-services-cpt' ),
			'remove_featured_image' => __( 'Remove featured image', 'almighty-services-cpt' ),
			'use_featured_image'    => __( 'Use as featured image', 'almighty-services-cpt' ),
			'insert_into_item'      => __( 'Insert into service', 'almighty-services-cpt' ),
			'uploaded_to_this_item' => __( 'Uploaded to this service', 'almighty-services-cpt' ),
			'items_list'            => __( 'Services list', 'almighty-services-cpt' ),
			'items_list_navigation' => __( 'Services list navigation', 'almighty-services-cpt' ),
			'filter_items_list'     => __( 'Filter services list', 'almighty-services-cpt' ),
		);
		$rewrite = array(
			'slug'                  => '/services',
			'with_front'            => false
		);
		$args = array(
			'label'                 => __( 'Service', 'almighty-services-cpt' ),
			'description'           => __( 'Post type for services', 'almighty-services-cpt' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'thumbnail' ),
			'taxonomies'            => [],
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-album',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => false,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'rewrite'               => $rewrite,
			'capability_type'       => 'page',
			'show_in_rest'          => true,
			'template'              => build_template()
		);
		register_post_type( 'services', $args );
	}
}

function build_template(){
	$result = array();

	$result[] = array( 'core/video', array(
		'align' => 'center',
	) );

	$result[] = array( 'core/paragraph', array(
		'placeholder' => 'Descripción del servicio'
	));

	$result[] = array( 'almighty-services-cpt/prices-columns', array() );

	return $result;
}


add_filter( 'post_type_link', 'remove_services_cpt_slug', 10, 3 );
function remove_services_cpt_slug( $post_link, $post, $leavename ) {

    if ( 'services' != $post->post_type || 'publish' != $post->post_status ) {
        return $post_link;
    }

    $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );

    return $post_link;
}

add_action( 'pre_get_posts', 'add_cpt_post_names_to_main_query' );
function add_cpt_post_names_to_main_query( $query ) {
 if ( ! $query->is_main_query() ) {
     return;
 }

 // if this query doesn't match our very specific rewrite rule.
 if ( ! isset( $query->query['page'] ) || 2 !== count( $query->query ) ) {
     return;
 }

 // if we're not querying based on the post name.
 if ( empty( $query->query['name'] ) ) {
     return;
 }
 
 // Add CPT to the list of post types WP will include when it queries based on the post name.
 $query->set( 'post_type', array( 'post', 'page', 'services' ) );
}

register_activation_hook(__FILE__,'my_custom_plugin_activate');
function my_custom_plugin_activate() {
    flush_rewrite_rules();
}

/*
* Register Custom Blocks
*/
require_once plugin_dir_path( __FILE__) . 'blocks/blocks.php';

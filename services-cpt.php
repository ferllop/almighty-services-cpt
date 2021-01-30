<?php
/*
Plugin Name: Services Custom Post Type
Plugin URI: https://ferranllop.com/
Description: Services Custom Post Type
Version: 1.0
Author: Ferran Llop
Author URI: https://ferranllop.com/
*/

add_action( 'init', 'almighty_services_post_type', 0 );
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
			'slug'                  => 'servicios',
			'with_front'            => true,
			'pages'                 => true,
			'feeds'                 => true,
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
			'has_archive'           => true,
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


/*
* Register Custom Blocks
*/
require_once plugin_dir_path( __FILE__) . 'blocks/blocks.php';

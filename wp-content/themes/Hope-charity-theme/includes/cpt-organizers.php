<?php
function cpt_organizer(){
	
	global $hope_options;
	
	if( $hope_options ){
		$url_rewrite = $hope_options['opt-organizers-post-slug'];
		if( $url_rewrite == '' ) { 
			$url_rewrite = 'organizer'; 
		} 
	} else {
		$url_rewrite = 'organizer';
	}

	register_post_type('post_organizers',
		array(
			'labels' => array(
				'name' => esc_attr__('Organizers', TEXT_DOMAIN),
				'singular_name' => esc_attr__('Organizer', TEXT_DOMAIN),
				'add_new' => esc_attr__('Add New Organizer', TEXT_DOMAIN),
				'add_new_item' => esc_attr__('Add New Organizer', TEXT_DOMAIN),
				'edit' => esc_attr__('Edit', TEXT_DOMAIN),
				'edit_item' => esc_attr__('Edit Organizer', TEXT_DOMAIN),
				'new_item' => esc_attr__('New Organizer', TEXT_DOMAIN),
				'view' => esc_attr__('View', TEXT_DOMAIN),
				'view_item' => esc_attr__('View Organizer', TEXT_DOMAIN),
				'search_items' => esc_attr__('Search Organizers', TEXT_DOMAIN),
				'not_found' => esc_attr__('No Organizers found', TEXT_DOMAIN),
				'not_found_in_trash' => esc_attr__('No Organizers found in Trash', TEXT_DOMAIN),
				'parent' => esc_attr__('Parent Organizer', TEXT_DOMAIN)
			),
			'description' => esc_attr__('Easily lets you add new organizer profiles to your system.', TEXT_DOMAIN),
			'public' => true,
			'show_ui' => true, 
			'_builtin' => false,
			'capability_type' => 'page',
			'hierarchical' => false,
			'rewrite' => array('slug' => $url_rewrite),
			'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
		)
	); 
	flush_rewrite_rules();
}

function tax_organizer() {
	
	global $hope_options;
	
	if( $hope_options ){
		$url_rewrite = $hope_options['opt-organizers-taxonomy-slug'];
		if( $url_rewrite == '' ) { 
			$url_rewrite = 'organizers'; 
		} 
	} else {
		$url_rewrite = 'organizers';
	}

	
	//Add category support
	register_taxonomy('organizer_item_types', 'post_organizers', array(
		// Hierarchical taxonomy (like categories)
		'hierarchical' => true, //Set to true for categories or false for tags
		'show_admin_column' => true,
		// This array of options controls the labels displayed in the WordPress Admin UI
		'labels' => array(
			'name' => esc_attr__('Organizer Titles', TEXT_DOMAIN),
			'singular_name' => esc_attr__('Organizer Titles', TEXT_DOMAIN),
			'search_items' =>  esc_attr__('Search Organizer Titles', TEXT_DOMAIN),
			'all_items' => esc_attr__('Popular Organizer Titles', TEXT_DOMAIN),
			'parent_item' => esc_attr__('Parent Organizer Titles', TEXT_DOMAIN),
			'parent_item_colon' => esc_attr__('Parent Organizer Title:', TEXT_DOMAIN),
			'edit_item' => esc_attr__('Edit Organizer Title', TEXT_DOMAIN),
			'update_item' => esc_attr__('Update Organizer Title', TEXT_DOMAIN),
			'add_new_item' => esc_attr__('Add New Organizer Title', TEXT_DOMAIN),
			'new_item_name' => esc_attr__('New Organizer Titles', TEXT_DOMAIN),
			'menu_name' => esc_attr__('Organizer Titles', TEXT_DOMAIN),
		),
		// Control the slugs used for this taxonomy
		'rewrite' => array(
			'slug' => $url_rewrite, // This controls the base slug that will display before each term
			'with_front' => false, // Don't display the category base before "/locations/"
			'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
		),
	));
	
	flush_rewrite_rules();	
}

add_action('init', 'cpt_organizer');
add_action('init', 'tax_organizer');
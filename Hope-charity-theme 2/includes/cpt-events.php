<?php

function cpt_event(){
	
	global $hope_options;
	
	if( $hope_options ){
		$url_rewrite = $hope_options['opt-events-post-slug'];
		if( $url_rewrite == '' ) { 
			$url_rewrite = 'event'; 
		} 
	} else {
		$url_rewrite = 'event';
	}

	register_post_type('post_events',
		array(
			'labels' => array(
				'name' =>  esc_attr__( 'Events', TEXT_DOMAIN ),
				'singular_name' => esc_attr__( 'Event entry', TEXT_DOMAIN ),
				'add_new' => esc_attr__( 'Add New Event entry', TEXT_DOMAIN ),
				'add_new_item' => esc_attr__( 'Add New Event entry', TEXT_DOMAIN ),
				'edit' => esc_attr__( 'Edit Event', TEXT_DOMAIN ),
				'edit_item' => esc_attr__( 'Edit Event entry', TEXT_DOMAIN ),
				'new_item' => esc_attr__( 'New Event entry', TEXT_DOMAIN ),
				'view' => esc_attr__( 'View', TEXT_DOMAIN ),
				'view_item' => esc_attr__( 'View Event entry', TEXT_DOMAIN ),
				'search_items' => esc_attr__( 'Search Events', TEXT_DOMAIN ),
				'not_found' => esc_attr__( 'No Events found', TEXT_DOMAIN ),
				'not_found_in_trash' => esc_attr__( 'No Events found in Trash', TEXT_DOMAIN ),
				'parent' => esc_attr__( 'Parent Event entry', TEXT_DOMAIN )
			),
			'description' => esc_attr__( 'Easily lets you add new events', TEXT_DOMAIN ),
			'public' => true,
			'show_ui' => true, 
			'_builtin' => false,
			'map_meta_cap' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'pages' => true,
			//'has_archive' => true, //SAVES IN AN ARCHIVE?
			'rewrite' => array('slug' => $url_rewrite),
			'supports' => array('title', 'editor', 'author', 'excerpt', 'thumbnail'),
			//'taxonomies' => array('category', 'post_tag')
		)
	); 
	flush_rewrite_rules();
}


function event_categories() {
	
	// create the array for 'labels'
    $labels = array(
		'name' => esc_html__( 'Event Categories', TEXT_DOMAIN ),
		'singular_name' => esc_html__( 'Event Categories', TEXT_DOMAIN ),
		'search_items' =>  esc_html__( 'Search Event Categories', TEXT_DOMAIN ),
		'popular_items' => esc_html__( 'Popular Event Categories', TEXT_DOMAIN ),
		'all_items' => esc_html__( 'All Event Categories', TEXT_DOMAIN ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => esc_html__( 'Edit Event Category', TEXT_DOMAIN ),
		'update_item' => esc_html__( 'Update Event Category', TEXT_DOMAIN ),
		'add_new_item' => esc_html__( 'Add Event Category', TEXT_DOMAIN ),
		'new_item_name' => esc_html__( 'New Event Category', TEXT_DOMAIN ),
		'separate_items_with_commas' => esc_html__( 'Separate Event Categories with commas', TEXT_DOMAIN ),
		'add_or_remove_items' => esc_html__( 'Add or remove Event Categories', TEXT_DOMAIN ),
		'choose_from_most_used' => esc_html__( 'Choose from the most used Event Categories', TEXT_DOMAIN )
    );
	
    // register your Flags taxonomy
    register_taxonomy( 'event_categories', 'post_events', array(
		'hierarchical' => true, //Set to true for categories or false for tags
		'labels' => $labels, // adds the above $labels array
		'show_ui' => true,
		'query_var' => true,
		'show_admin_column' => true,
		'rewrite' => array( 'slug' => 'event-category' ), // changes name in permalink structure
    ));
	
	flush_rewrite_rules();	
}


add_action('init', 'cpt_event');
add_action('init', 'event_categories');
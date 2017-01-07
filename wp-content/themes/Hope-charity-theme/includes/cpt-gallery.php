<?php //HOPE

function cpt_gallery(){
	
	$url_rewrite = 'gallery';
	
	global $hope_options;
	
	if( isset($hope_options['opt-gallery-post-type-slug']) && !empty($hope_options['opt-gallery-post-type-slug']) ) {
		$url_rewrite = $hope_options['opt-gallery-post-type-slug'];
	} 


	register_post_type('post_galleries',
		array(
			'labels' => array(
				'name' => esc_attr__( 'Gallery', TEXT_DOMAIN ),
				'singular_name' => esc_attr__( 'Gallery', TEXT_DOMAIN ),
				'add_new' => esc_attr__( 'Add New Gallery item', TEXT_DOMAIN ),
				'add_new_item' => esc_attr__( 'Add New Gallery item', TEXT_DOMAIN ),
				'edit' => esc_attr__( 'Edit', TEXT_DOMAIN ),
				'edit_item' => esc_attr__( 'Edit Gallery item', TEXT_DOMAIN ),
				'new_item' => esc_attr__( 'New Gallery item', TEXT_DOMAIN ),
				'view' => esc_attr__( 'View', TEXT_DOMAIN ),
				'view_item' => esc_attr__( 'View Gallery item', TEXT_DOMAIN ),
				'search_items' => esc_attr__( 'Search Gallery items', TEXT_DOMAIN ),
				'not_found' => esc_attr__( 'No Gallery items found', TEXT_DOMAIN ),
				'not_found_in_trash' => esc_attr__( 'No Gallery items found in Trash', TEXT_DOMAIN ),
				'parent' => esc_attr__( 'Parent Staff', TEXT_DOMAIN )
			),
			'description' => esc_attr__( 'Easily lets you add new gallery items', TEXT_DOMAIN ),
			'public' => true,
			'show_ui' => true, 
			'_builtin' => false,
			'map_meta_cap' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'pages' => true,
			//'has_archive' => true, //SAVES IN AN ARCHIVE?
			'rewrite' => array('slug' => $url_rewrite),
			'supports' => array('title', 'editor', 'author', 'excerpt'),
			//'taxonomies' => array('category', 'post_tag')
		)
	); 
	flush_rewrite_rules();
}

function gallery_categories() {
	
	// create the array for 'labels'
    $labels = array(
		'name' => esc_attr__( 'Gallery Categories', TEXT_DOMAIN ),
		'singular_name' => esc_attr__( 'Gallery Categories', TEXT_DOMAIN ),
		'search_items' =>  esc_attr__( 'Search Gallery Categories', TEXT_DOMAIN ),
		'popular_items' => esc_attr__( 'Popular Gallery Categories', TEXT_DOMAIN ),
		'all_items' => esc_attr__( 'All Gallery Categories', TEXT_DOMAIN ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => esc_attr__( 'Edit Gallery Category', TEXT_DOMAIN ),
		'update_item' => esc_attr__( 'Update Gallery Category', TEXT_DOMAIN ),
		'add_new_item' => esc_attr__( 'Add Gallery Category', TEXT_DOMAIN ),
		'new_item_name' => esc_attr__( 'New Gallery Category Name', TEXT_DOMAIN ),
		'separate_items_with_commas' => esc_attr__( 'Separate Gallery Categories with commas', TEXT_DOMAIN ),
		'add_or_remove_items' => esc_attr__( 'Add or remove Gallery Categories', TEXT_DOMAIN ),
		'choose_from_most_used' => esc_attr__( 'Choose from the most used Gallery Categories', TEXT_DOMAIN )
    );
	
    // register your Flags taxonomy
    register_taxonomy( 'gallerycats', 'post_galleries', array(
		'hierarchical' => true, //Set to true for categories or false for tags
		'labels' => $labels, // adds the above $labels array
		'show_ui' => true,
		'query_var' => true,
		'show_admin_column' => true,
		'rewrite' => array( 'slug' => 'gallery-category' ), // changes name in permalink structure
    ));
	
	flush_rewrite_rules();	
}

function gallery_tags() {
	
	// create the array for 'labels'
    $labels = array(
		'name' => esc_attr__( 'Gallery Tags', TEXT_DOMAIN ),
		'singular_name' => esc_attr__( 'Gallery Tags', TEXT_DOMAIN ),
		'search_items' =>  esc_attr__( 'Search Gallery Tags', TEXT_DOMAIN ),
		'popular_items' => esc_attr__( 'Popular Gallery Tags', TEXT_DOMAIN ),
		'all_items' => esc_attr__( 'All Gallery Tags', TEXT_DOMAIN ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => esc_attr__( 'Edit Gallery Category', TEXT_DOMAIN ),
		'update_item' => esc_attr__( 'Update Gallery Category', TEXT_DOMAIN ),
		'add_new_item' => esc_attr__( 'Add Gallery Category', TEXT_DOMAIN ),
		'new_item_name' => esc_attr__( 'New Gallery Category Name', TEXT_DOMAIN ),
		'separate_items_with_commas' => esc_attr__( 'Separate Gallery Tags with commas', TEXT_DOMAIN ),
		'add_or_remove_items' => esc_attr__( 'Add or remove Gallery Tags', TEXT_DOMAIN ),
		'choose_from_most_used' => esc_attr__( 'Choose from the most used Gallery Tags', TEXT_DOMAIN )
    );
	
    // register your Flags taxonomy
    register_taxonomy( 'gallerytags', 'post_galleries', array(
		'hierarchical' => false, //Set to true for categories or false for tags
		'labels' => $labels, // adds the above $labels array
		'show_ui' => true,
		'query_var' => true,
		'show_admin_column' => true,
		'rewrite' => array( 'slug' => 'gallery-tag' ), // changes name in permalink structure
    ));
	
	flush_rewrite_rules();	
}

add_action('init', 'cpt_gallery');
add_action('init', 'gallery_categories');
add_action('init', 'gallery_tags');
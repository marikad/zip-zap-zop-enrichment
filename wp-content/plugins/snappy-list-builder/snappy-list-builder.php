<?php
/*
Plugin Name: Snappy List Builder
Plugin URI: http://wordpressplugincourse.com/plugins/snappy-list-builder
Description: The ultimate email list building plugin for WordPress. Capture new subscribers. Reward subscribers with a custom download upon opt-in. Build unlimited lists. Import and export subscribers easily with .csv
Version: 1.0.1.2
Author: Marika Devan
Author URI: http://joelfunk.codecollege.ca
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: snappy-list-builder
*/


/* Hooks */

//register all our custom shortcodes on init
add_action('init', 'slb_register_shortcode');


//register custom admin column data
add_filter('manage_slb_subscriber_posts_custom_column', 'slb_subscriber_column_data', 1,2);


add_filter('manage_slb_list_posts_custom_column', 'slb_list_column_data', 1,2);

// 1.2
// hint: register custom admin column headers
add_filter('manage_edit-slb_subscriber_columns','slb_subscriber_column_headers');
add_filter('manage_edit-slb_list_columns','slb_list_column_headers');
add_action(
    'admin_head-edit.php',
    'slb_register_custom_admin_titles'
);

/* Shortcodes */

//requires all our custom shortcodes
function slb_register_shortcode(){
	//sl;b form is the name of our shortcode 
	//slb_form_shortcode is the funtion we want to run when our shortcode is called
add_shortcode('slb_form', 'slb_form_shortcode');
}

//return html string for form
function slb_form_shortcode($args, $content=""){

//get list id
	$list_id = 0;
	if (isset($args['id'])) $list_id = (int)$args['id'];
	

//setup output variable - form html

	$output = '
	<div class="slb">
		<form id="slb_form" name="slb_form" class="slb-form" action="/wp-admin/admin-ajax.php?action=slb_save_subscription" method="post">
		<input type="hidden" name="slb_list" value="'. $list_id .'"
			<p class="slb-input-container">
				<label>Your Name</label><br />
				<input type="text" name="slb_fname" placeholder="First Name" />
				<input type="text" name="slb_lname" placeholder="Last Name" />
			</p>
			
			<p class="slb-input-container">
				<label>Your Email;</label><br />
				<input type="email" name="slb_email" placeholder="First Name">
			</p>';
//if content is included in the form this if statement will run
			if(strlen($content)):
			$output .= '<div class="slb-content">' .  wpautop($content) . '</div>';

			endif;

			//completing out form html
			$output .= '<p class="slb-input-container">
				<input type="submit" name="slb_submit" value="Sign Me Up!">
			</p>
		</form>
	</div>
	
	';
//return our form
	return $output;

}

/*   Filters  */

function slb_subscriber_column_headers($columns){
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __('Subscriber Name'),
		'email' => __('Email Address'),
		);

	//returning new column
	return $columns;
}

function slb_subscriber_column_data($column, $post_id){

	//setup our return text
	$output = '';

	switch ($column) {
		case 'title':
			$fname = get_field('slb_fname', $post_id);
			$lname = get_field('slb_lname', $post_id);
			$output .= $fname .' '. $lname; 
			break;
			case 'email';
			//get the custom email data

			$email = get_field('slb_email', $post_id);
			$output .= $email;
			break;
	}

	echo $output;
}

// 3.6
// hint: registers special custom admin title columns
function slb_register_custom_admin_titles() {
    add_filter(
        'the_title',
        'slb_custom_admin_titles',
        100,
        2
    );
}
 
// 3.7
// hint: handles custom admin title "title" column the way WP 4.3 likes...
function slb_custom_admin_titles( $title, $post_id ) {
   
    global $post;
   
    $output = $title;
   
    if( isset($post->post_type) ):
                switch( $post->post_type ) {
                        case 'slb_subscriber':
                                $fname = get_field('slb_fname', $post_id );
                                $lname = get_field('slb_lname', $post_id );
                                $output = $fname .' '. $lname;
                                break;
                }
        endif;
   
    return $output;
}

function slb_list_column_headers($columns){
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __('Subscriber Name'),
		'email' => __('Email Address'),
		);

	//returning new column
	return $columns;
}

function slb_list_column_data($column, $post_id){

	//setup our return text
	$output = '';

	switch ($column) {
		case 'example':
			// $fname = get_field('slb_fname', $post_id);
			// $lname = get_field('slb_lname', $post_id);
			// $output .= $fname .' '. $lname; 
			break;
	

	}

	echo $output;
}

/* Action */
//save subscription data to an new or exisiting subscriber
// function slb_save_subscription(){
// 	//setup default result area

// 	$result = array(
// 		'status' => 0,
// 		'message' => 'Subscription was not saved. ',
// 		);

// //array for storing errors
// 	$errors = array();

// 	try {
// 		$list_id = (int)$_POST['slb_list'];

// 		//prepare subscriber data

// 		$subscriber_data = array(
// 			'fname' => esc_attr( $_POST['slb_fname'] ),
// 			'lname' => esc_attr( $_POST['slb_lname'] ),
// 			'email' => esc_attr( $_POST['slb_email'] ),

// 		);

// 		//attempt to create save subscriber

// 		$subscriber_id = slb_save_subscriber($subscriber_data);
// 		//if subscriber was saved successfully $subscriber_id will 
// 		if($subscriber_id):
// 	}
// }

?>
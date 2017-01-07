<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_gallery_posts extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			'num_of_posts' => '-1',
			'post_order' => 'DESC',
			'category_slug' => '',
			'tag_slug' => ''
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();
		
		if( $category_slug !== '' ){
		
			//Fetch gallery by category
			$arguments = array(
				'post_type' => 'post_galleries',
				'post_status' => 'publish',
				'order' => $post_order,
				//'posts_per_page' => -1,
				'posts_per_page' => $num_of_posts,
				//'tag' => get_query_var('tag')
				'tax_query' => array(
						array(
							'taxonomy' => 'gallerycats',
							'field' => 'slug',
							'terms' => array( $category_slug )
						)
				),
			);
			
		} elseif( $tag_slug !== '' ) {
			
			//Fetch gallery by tag
			$arguments = array(
				'post_type' => 'post_galleries',
				'post_status' => 'publish',
				'order' => $post_order,
				//'posts_per_page' => -1,
				'posts_per_page' => $num_of_posts,
				//'tag' => get_query_var('tag')
				'tax_query' => array(
						array(
							'taxonomy' => 'gallerytags',
							'field' => 'slug',
							'terms' => array( $tag_slug )
						)
				),
			);
			
		} else {
			
			//Fetch all gallery
			$arguments = array(
				'post_type' => 'post_galleries',
				'post_status' => 'publish',
				'order' => $post_order,
				//'posts_per_page' => -1,
				'posts_per_page' => $num_of_posts,
				//'tag' => get_query_var('tag')
			);
			
		}
		
		$post_query = new WP_Query($arguments);

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="container">
        
        	<div class="row">
            
            	<?php if ($post_query->have_posts()) : while ($post_query->have_posts()) : $post_query->the_post(); ?>
        		
					<?php get_template_part( 'content', 'gallerypost' ); ?>
                
                <?php endwhile; else: ?>
                
                	<div class="span12">
                    	<p><?php esc_attr_e('No gallery posts were found.', TEXT_DOMAIN); ?></p>
                    </div>
                
                     
                <?php endif; ?>
                            
                <?php wp_reset_postdata(); ?> 
            
            </div>
        
        </div>
        
        
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_gallery_posts",
    "name"      => __("Gallery Posts", TEXT_DOMAIN),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Hope Shortcodes", TEXT_DOMAIN),
    "params"    => array(
	
		array(
            "type" => "dropdown",
            "heading" => __("Number of Posts", TEXT_DOMAIN),
            "param_name" => "num_of_posts",
            "description" => __("Select the number of gallery posts you wish to display. Use -1 to display all gallery posts.", TEXT_DOMAIN),
			"value"      => array('-1' => '-1', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10' ), //Add default value in $atts
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Post Order", TEXT_DOMAIN),
            "param_name" => "post_order",
            "description" => __("Set the order in which gallery posts are displayed. DESC = descending / ASC = ascending", TEXT_DOMAIN),
			"value"      => array( 'DESC' => 'DESC', 'ASC' => 'ASC'), //Add default value in $atts
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Category Slug", TEXT_DOMAIN),
            "param_name" => "category_slug",
            "description" => __("Display gallery posts from a specific gallery category.", TEXT_DOMAIN),
			"value"      => '', //Add default value in $atts
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Tag Slug", TEXT_DOMAIN),
            "param_name" => "tag_slug",
            "description" => __("Display gallery posts from a specific gallery tag.", TEXT_DOMAIN),
			"value"      => '', //Add default value in $atts
        ),
		

    )

));
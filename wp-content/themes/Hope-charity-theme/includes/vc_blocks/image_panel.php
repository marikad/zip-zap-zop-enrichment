<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_image_panel extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			'tip' => '',
			'icon' => 'fa fa-file',
			'hover_icon' => 'fa fa-link',
			'title' => '',
			'link' => '#',
			'image' => '',
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			$img = wp_get_attachment_image_src($image, "large"); 
			$image = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="pm_image_panel">
    
            <div class="pm_image_panel_header">
                <?php if($tip !== ''){ ?>
                    <h4><span><?php esc_attr_e($title); ?></span><a target="_self" class="<?php esc_attr_e($icon); ?> pm_tip" title="<?php esc_attr_e($tip); ?>" href="<?php echo esc_url($link); ?>"></a></h4>
                <?php } else { ?>
                    <h4><span><?php esc_attr_e($title); ?></span><a target="_self" class="<?php esc_attr_e($icon); ?>" href="<?php echo esc_url($link); ?>"></a></h4>
                <?php } ?>            
            </div>
                
            <div class="pm-hover-item-image-panel">  
            <div class="pm-hover-item-icon"><a class="<?php esc_attr_e($hover_icon); ?>" href="<?php echo esc_url($link); ?>"></a></div>        
            <div class="pm-hover-item-details"></div>        
            <div class="pm-hover-item-image-panel-img"><img src="<?php echo esc_url($image); ?>" /></div>
            
        </div>   
        
        <?php //echo do_shortcode($content); ?>
        
        </div>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_image_panel",
    "name"      => __("Image Panel", TEXT_DOMAIN),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Hope Shortcodes", TEXT_DOMAIN),
    "params"    => array(
	
		array(
            "type" => "textfield",
            "heading" => __("Title", TEXT_DOMAIN),
            "param_name" => "title",
            //"description" => __("Enter a CSS class if required.", TEXT_DOMAIN),
			"value" => ''
        ),
	
		array(
            "type" => "textfield",
            "heading" => __("Tooltip message", TEXT_DOMAIN),
            "param_name" => "tip",
            //"description" => __("Enter a CSS class if required.", TEXT_DOMAIN),
			"value" => ''
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Link", TEXT_DOMAIN),
            "param_name" => "link",
            //"description" => __("Enter a CSS class if required.", TEXT_DOMAIN),
			"value" => '#'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Icon", TEXT_DOMAIN),
            "param_name" => "icon",
            "description" => __("Accepts a FontAwesome 4 icon value. (Ex. fa fa-file)", TEXT_DOMAIN),
			"value" => 'fa fa-file'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Hover Icon", TEXT_DOMAIN),
            "param_name" => "hover_icon",
            "description" => __("Accepts a FontAwesome 4 icon value. (Ex. fa fa-file)", TEXT_DOMAIN),
			"value" => 'fa fa-link'
        ),
		
				
		array(
            "type" => "attach_image",
            "heading" => __("Image", TEXT_DOMAIN),
            "param_name" => "image",
            "description" => __("Upload a background image for the image panel.", TEXT_DOMAIN)
        ),
		
		/*array(
            "type" => "textarea_html",
            "heading" => __("Content", TEXT_DOMAIN),
            "param_name" => "content",
            //"description" => __("Enter a CSS class if required.", TEXT_DOMAIN),
			"value" => ''
        ),*/

    )

));
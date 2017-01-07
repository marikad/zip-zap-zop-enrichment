<?php

/**
  ReduxFramework Sample Config File
  For full documentation, please visit: https://docs.reduxframework.com
 * */

if (!class_exists('Redux_Framework_sample_config')) {

    class Redux_Framework_sample_config {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if (  true == Redux_Helpers::isTheme(__FILE__) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings() {

            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            //$this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            //add_action( 'redux/loaded', array( $this, 'remove_demo' ) );
            
            // Function to test the compiler hook and demo CSS output.
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 3);
            
            // Change the arguments after they've been declared, but before the panel is created
            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );
            
            // Change the default value of a field after it's been set, but before it's been useds
            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );
            
            // Dynamically add a section. Can be also used to modify sections/fields
            //add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        /**

          This is a test function that will let you see when the compiler hook occurs.
          It only runs if a field set with compiler=>true is changed.

         * */
        function compiler_action($options, $css, $changed_values) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r($changed_values); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )

            /*
              // Demo of how to use the dynamic CSS and write your own static CSS file
              $filename = dirname(__FILE__) . '/style' . '.css';
              global $wp_filesystem;
              if( empty( $wp_filesystem ) ) {
                require_once( ABSPATH .'/wp-admin/includes/file.php' );
              WP_Filesystem();
              }

              if( $wp_filesystem ) {
                $wp_filesystem->put_contents(
                    $filename,
                    $css,
                    FS_CHMOD_FILE // predefined mode settings for WP files
                );
              }
             */
        }

        /**

          Custom function for filtering the sections array. Good for child themes to override or add to the sections.
          Simply include this function in the child themes functions.php file.

          NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
          so you must use get_template_directory_uri() if you want to use any of the built in icons

         * */
        function dynamic_section($sections) {
            //$sections = array();
            $sections[] = array(
                'title' => __('Section via hook', TEXT_DOMAIN),
                'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', TEXT_DOMAIN),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }

        /**

          Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

         * */
        function change_arguments($args) {
            //$args['dev_mode'] = true;

            return $args;
        }

        /**

          Filter hook for filtering the default value of any given field. Very useful in development mode.

         * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
            }
        }

        public function setSections() {

            /**
              Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $sample_patterns_path   = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url    = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns        = array();

            if (is_dir($sample_patterns_path)) :

                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();

                    while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {

                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode('.', $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[]  = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                        }
                    }
                endif;
            endif;

            ob_start();

            $ct             = wp_get_theme();
            $this->theme    = $ct;
            $item_name      = $this->theme->get('Name');
            $tags           = $this->theme->Tags;
            $screenshot     = $this->theme->get_screenshot();
            $class          = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', TEXT_DOMAIN), $this->theme->display('Name'));
            
            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview', TEXT_DOMAIN); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview', TEXT_DOMAIN); ?>" />
                <?php endif; ?>

                <h4><?php echo $this->theme->display('Name'); ?></h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(__('By %s', TEXT_DOMAIN), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', TEXT_DOMAIN), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . __('Tags', TEXT_DOMAIN) . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
            <?php
            if ($this->theme->parent()) {
                printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.', TEXT_DOMAIN) . '</p>', __('http://codex.wordpress.org/Child_Themes', TEXT_DOMAIN), $this->theme->parent()->display('Name'));
            }
            ?>

                </div>
            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            $sampleHTML = '';
            if (file_exists(dirname(__FILE__) . '/info-html.html')) {
                /** @global WP_Filesystem_Direct $wp_filesystem  */
                global $wp_filesystem;
                if (empty($wp_filesystem)) {
                    require_once(ABSPATH . '/wp-admin/includes/file.php');
                    WP_Filesystem();
                }
                $sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
            }

            /***** ACTUAL DECLARATION OF SECTIONS ******/
			    			
			
			
			//SPONSORS CAROUSEL
			$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('Sponsors Carousel', TEXT_DOMAIN),
			  'heading'   => __('Sponsors Carousel', TEXT_DOMAIN),
			  'desc'      => __('Use this area to manage options and slides for the sponsors carousel shortcode.', TEXT_DOMAIN),
			
			  'fields'    => array(
			  
			  	array(
					'id'        => 'opt-sponsor-target-window',
					'type'      => 'select',
					'title'     => __('Target Window', TEXT_DOMAIN),
					'subtitle'  => __('Set the browser target window for the sponsor url.', TEXT_DOMAIN),
					//'desc'      => __('This is the description field, again good for additional info.', TEXT_DOMAIN),
					
					//Must provide key => value pairs for select options
					'options'   => array(
						'_self' => '_self', 
						'_blank' => '_blank'
					),
					'default'   => '_blank'
				),//end of field
				
				
				array(
                        'id'        => 'opt-sponsors-carousel-message',
                        'type'      => 'text',
                        'title'     => __('Carousel Message', TEXT_DOMAIN),
                        'subtitle'  => __('Enter a short message for the carousel if desired.', TEXT_DOMAIN),
                        //'desc'      => __('NOTE: if you would like your slider to sit underneath the navigation bar than wrap your shortcode within the "sliderContainer" shortcode.', TEXT_DOMAIN),
                        //'validate'  => 'html',
						'default' => ''
                ),				
				
				
				  
				//Fields go here
				array(
					'id'        => 'opt-client-slides',
					'type'      => 'slides',
					'title'     => __('Client Slides', TEXT_DOMAIN),
					'subtitle'  => __('Unlimited slides with drag and drop sortings.', TEXT_DOMAIN),
					//'desc'      => __('This field will store all slides values into a multidimensional array to use into a foreach loop.', TEXT_DOMAIN),
					'placeholder'   => array(
						'title'         => __('Sponsor name', TEXT_DOMAIN),
						'description'   => __('Tooltip Message', TEXT_DOMAIN),
						'url'           => __('Sponsor URL', TEXT_DOMAIN),
					),
				),
											
			  )//end of fields
			
			);//end of section
			
			
			//PRETTYPHOTO OPTIONS
			$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('PrettyPhoto Options', TEXT_DOMAIN),
			  'heading'   => __('PrettyPhoto Options', TEXT_DOMAIN),
			  'desc'      => __('Use this area to manage controls for PrettyPhoto gallery carousel.', TEXT_DOMAIN),
			
			  'fields'    => array(
				  
				//Fields go here
				array(
					'id'        => 'ppAutoPlay',
					'type'      => 'select',
					'title'     => __('Enable Slideshow?', TEXT_DOMAIN),
					'subtitle'  => __('Allow the slider to animate to next slide automatically.', TEXT_DOMAIN),
					//'desc'      => __('This is the description field, again good for additional info.', TEXT_DOMAIN),
					
					//Must provide key => value pairs for select options
					'options'   => array(
						'true' => __('True', TEXT_DOMAIN),
						'false' => __('False', TEXT_DOMAIN),
					),
					'default'   => 'true'
				),//end of field
				
				/*array(
					'id'        => 'ppShowTitle',
					'type'      => 'select',
					'title'     => __('Show Caption?', TEXT_DOMAIN),
					'subtitle'  => __('Display the caption of each slide in the PrettyPhoto carousel.', TEXT_DOMAIN),
					//'desc'      => __('This is the description field, again good for additional info.', TEXT_DOMAIN),
					
					//Must provide key => value pairs for select options
					'options'   => array(
						'true' => __('True', TEXT_DOMAIN),
						'false' => __('False', TEXT_DOMAIN),
					),
					'default'   => 'true'
				),//end of field*/
				
				array(
					'id'            => 'ppSlideShowSpeed',
					'type'          => 'slider',
					'title'         => __('Slideshow Speed', TEXT_DOMAIN),
					//'desc'      => __('This example displays the value in a text box', TEXT_DOMAIN),
					'subtitle'          => __('Set the speed of the slideshow cycling. A value of around 5000 for this field is recommended.', TEXT_DOMAIN),
					'default'       => 5000,
					'min'           => 2000,
					'step'          => 5,
					'max'           => 10000,
					'display_value' => 'text'
				),//end of field
					
				array(
					'id'        => 'ppAnimationSpeed',
					'type'      => 'select',
					'title'     => __('Animation Speed', TEXT_DOMAIN),
					'subtitle'  => __('Select your desired speed of the slide animation.', TEXT_DOMAIN),
					//'desc'      => __('This is the description field, again good for additional info.', TEXT_DOMAIN),
					
					//Must provide key => value pairs for select options
					'options'   => array(
						'fast' => __('Fast', TEXT_DOMAIN),
						'slow' => __('Slow', TEXT_DOMAIN),
						'normal' => __('Normal', TEXT_DOMAIN),
					),
					'default'   => 'normal'
				),//end of field
				  
				array(
					'id'        => 'ppColorTheme',
					'type'      => 'select',
					'title'     => __('Color Theme', TEXT_DOMAIN),
					'subtitle'  => __('Set the color theme for the PrettyPhoto carousel.', TEXT_DOMAIN),
					//'desc'      => __('This is the description field, again good for additional info.', TEXT_DOMAIN),
					
					//Must provide key => value pairs for select options
					'options'   => array(
						'light_rounded' => __('Light Rounded', TEXT_DOMAIN),
						'dark_rounded' => __('Dark Rounded', TEXT_DOMAIN),
						'light_square' => __('Light Square', TEXT_DOMAIN),
						'dark_square' => __('Dark Square', TEXT_DOMAIN),
					),
					'default'   => 'light_rounded'
				),//end of field
				
				/*array(
					'id'        => 'ppSocialTools',
					'type'      => 'select',
					'title'     => __('Display Social Buttons?', TEXT_DOMAIN),
					'subtitle'  => __('Enable or disable the social icons in the prettyPhoto carousel.', TEXT_DOMAIN),
					//'desc'      => __('This is the description field, again good for additional info.', TEXT_DOMAIN),
					
					//Must provide key => value pairs for select options
					'options'   => array(
						'true' => __('True', TEXT_DOMAIN),
						'false' => __('False', TEXT_DOMAIN),
					),
					'default'   => 'true'
				),//end of field*/
				
													
			  )//end of fields
			  			
			);//end of section
			
			
			//Custom Slider
			$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('Custom Slider', TEXT_DOMAIN),
			  'heading'   => __('Custom Slider', TEXT_DOMAIN),
			  'desc'      => __('Use this area to manage a custom slider for the homepage.', TEXT_DOMAIN),
			
			  'fields'    => array(
				  
				//Fields go here
				array(
                        'id'        => 'opt-custom-slider',
                        'type'      => 'text',
                        'title'     => __('Custom Slider', TEXT_DOMAIN),
                        'subtitle'  => __('You can display a custom slider on the default index page by providing a slider shortcode here. <strong>NOTE:</strong> Be sure to disable the Feature Slider under Appearance -> Customize -> Feature Slider Options', TEXT_DOMAIN),
                        //'desc'      => __('NOTE: if you would like your slider to sit underneath the navigation bar than wrap your shortcode within the "sliderContainer" shortcode.', TEXT_DOMAIN),
                        //'validate'  => 'html',
						'default' => ''
                ),
				
											
			  )//end of fields
			
			);//end of section
			
			
			
			//Feature Slider
			$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('Feature Slider', TEXT_DOMAIN),
			  'heading'   => __('Feature Slider', TEXT_DOMAIN),
			  'desc'      => __('Use this area to manage fonts and slides for the Feature Slider. For Feature Slider controls go to <b>Appearance -> Customize -> Feature Slider Options</b>', TEXT_DOMAIN),
			
			  'fields'    => array(
			  			  
			  	//Caption Font
			  	array(
					'id'            => 'opt-slider-caption-font',
					'type'          => 'typography',
					'title'         => __('Title Font', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
					'subsets'       => true, // Only appears if google is true and subsets not set to false
					'font-size'     => true,
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					//'color'         => false,
					//'preview'       => false, // Disable the previewer
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-caption h1'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-caption h1'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling Pulse slider caption text.', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#FFFFFF',
						'font-weight'    => '300',
						'font-family'   => 'Roboto',
						'font-size'     => '40px',
					),
				),
				
				
				
				//Description Font
			  	array(
					'id'            => 'opt-slider-desc-font',
					'type'          => 'typography',
					'title'         => __('Message Font', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					//'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
					//'subsets'       => false, // Only appears if google is true and subsets not set to false
					//'font-size'     => false,
					//'line-height'   => false,
					'text-transform' => true,  // Defaults to false
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					//'color'         => false,
					//'preview'       => false, // Disable the previewer
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-caption-decription'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-caption-decription'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling Pulse slider description text.', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#ffffff',
						'font-weight'    => '300',
						'font-family'   => 'Roboto',
						'font-size'     => '16px',
					),
				),
				
				array(
					'id'            => 'opt-slider-btn-font',
					'type'          => 'typography',
					'title'         => __('Slide Button Font', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					//'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
					//'subsets'       => false, // Only appears if google is true and subsets not set to false
					//'font-size'     => false,
					//'line-height'   => false,
					'text-transform' => true,  // Defaults to false
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					//'color'         => false,
					//'preview'       => false, // Disable the previewer
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-slide-btn'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-slide-btn'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling Pulse slider description text.', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#000000',
						'font-weight'    => '700',
						'font-family'   => 'Open Sans',
						'font-size'     => '14px',
					),
				),

				
				//Slides
				array(
					'id'        => 'opt-pulse-slides',
					'type'      => 'slides',
					'title'     => __('Slides', TEXT_DOMAIN),
					'subtitle'  => __('Unlimited slides with drag and drop sortings.', TEXT_DOMAIN),
					//'desc'      => __('This field will store all slides values into a multidimensional array to use into a foreach loop.', TEXT_DOMAIN),
					'placeholder'   => array(
						'title'         => __('Title', TEXT_DOMAIN),
						'description'   => __('Message', TEXT_DOMAIN),
						'url'           => __('Button text - URL (ex. Learn More - http://www.yourdomain.com/more)', TEXT_DOMAIN), //"Button name - URL" format
					),
				),
				
											
			  )//end of fields
			
			);//end of section
			
			
			
			//CUSTOM POST SLUG
			$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('Custom Post Type Slugs', TEXT_DOMAIN),
			  'heading'   => __('Custom Post Type Slugs', TEXT_DOMAIN),
			  'desc'      => __('Use this area to define custom post slugs if required.', TEXT_DOMAIN),
			
			  'fields'    => array(
				  
				//Fields go here
				array(
                        'id'        => 'opt-events-post-slug',
                        'type'      => 'text',
                        'title'     => __('Events Post Type Slug', TEXT_DOMAIN),
                        'subtitle'  => __('NOTE: Do not use the slug name "events" as it is reserved for the actual post type itself. Instead try a more descriptive slug such as charity-events or upcoming-events. The new slug name you set here should match the slug name of your page (the page that loads the Events Template).', TEXT_DOMAIN),
                        //'desc'      => __('NOTE: if you would like your slider to sit underneath the navigation bar than wrap your shortcode within the "sliderContainer" shortcode.', TEXT_DOMAIN),
                        //'validate'  => 'html',
						'default' => ''
                ),
				
				
				array(
                        'id'        => 'opt-organizers-post-slug',
                        'type'      => 'text',
                        'title'     => __('Organizers Post Type Slug', TEXT_DOMAIN),
                        'subtitle'  => __('NOTE: Do not use the slug name "organizer" as it is reserved for the actual post type itself. Instead try a more descriptive slug such as charity-organizer or community-organizer. The new slug name you set here should match the slug name of your page (the page that loads the Organizers Template).', TEXT_DOMAIN),
                        //'desc'      => __('NOTE: if you would like your slider to sit underneath the navigation bar than wrap your shortcode within the "sliderContainer" shortcode.', TEXT_DOMAIN),
                        //'validate'  => 'html',
						'default' => ''
                ),
				
				
				array(
                        'id'        => 'opt-organizers-taxonomy-slug',
                        'type'      => 'text',
                        'title'     => __('Organizers Title Taxonomy Slug', TEXT_DOMAIN),
                        'subtitle'  => __('NOTE: Do not use the slug name "organizers" as it is reserved for the actual taxonomy itself. Also, this value needs to be unique and can not be the same as the Organizers Post Type slug otherwise you will get a 404 error page when viewing organizers by their assigned titles.', TEXT_DOMAIN),
                        //'desc'      => __('NOTE: if you would like your slider to sit underneath the navigation bar than wrap your shortcode within the "sliderContainer" shortcode.', TEXT_DOMAIN),
                        //'validate'  => 'html',
						'default' => ''
                ),
				
											
			  )//end of fields
			
			);//end of section
			
			
			//WOOCOMMERCE FONTS
			$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('Woocommerce Font Settings', TEXT_DOMAIN),
			  'heading'   => __('Woocommerce Font Settings', TEXT_DOMAIN),
			  'desc'      => __('Use this area to manage font styles for the Woocommerce shopping area.', TEXT_DOMAIN),
			
			  'fields'    => array(
			  
			  array(
					'id'            => 'opt-woo-product-archive-title-font',
					'type'          => 'typography',
					'title'         => __('Product Archive Title Font', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.products .product h3 a'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.products .product h3 a'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the product title font on the Woocommerce shop.', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#00b7c2',
						'font-weight'    => '300',
						'font-family'   => 'Roboto',
						'google'        => true,
						'font-size'   => '20px'
					),
				),//end of field
				
				
				array(
					'id'            => 'opt-woo-product-archive-link-font',
					'type'          => 'typography',
					'title'         => __('Product Archive Link Font', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.products .product a'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.products .product a'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the product links font on the Woocommerce shop.', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#00b7c2',
						'font-weight'    => '300',
						'font-family'   => 'Roboto',
						'google'        => true,
						'font-size'   => '14px'
					),
				),//end of field
				
				array(
					'id'            => 'opt-woo-price-font',
					'type'          => 'typography',
					'title'         => __('Price Font', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-product-meta-info-container .price'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-product-meta-info-container .price'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the product price font - applies to the shop and details page', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#606060',
						'font-weight'    => '300',
						'font-family'   => 'Roboto',
						'google'        => true,
						'font-size'   => '17px'
					),
				),//end of field
				
				array(
					'id'            => 'opt-woo-product-single-title-font',
					'type'          => 'typography',
					'title'         => __('Product Single Title Font', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.product_title'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.product_title'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the product title font on a product item details page.', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#00b7c2',
						'font-weight'    => '300',
						'font-family'   => 'Roboto',
						'google'        => true,
						'font-size'   => '28px'
					),
				),//end of field

								
				array(
					'id'            => 'opt-woo-tab-title-font',
					'type'          => 'typography',
					'title'         => __('Tab Title Font', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.woocommerce-tabs .tabs li a'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.woocommerce-tabs .tabs li a'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the tab title font for Woocommerce tab systems.', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#232323',
						'font-weight'    => '300',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '24px',
					),
				),//end of field
				
				
				
				array(
					'id'            => 'opt-woo-form-title-font',
					'type'          => 'typography',
					'title'         => __('Form Title Font', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.woocommerce-billing-fields h3', '.woocommerce-shipping-fields h3', '#order_review_heading'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.woocommerce-billing-fields h3', '.woocommerce-shipping-fields h3', '#order_review_heading'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the title font for Woocommerce forms.', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#565656',
						'font-weight'    => '300',
						'font-family'   => 'Roboto',
						'google'        => true,
						'font-size'     => '22px'
					),
				),//end of field
								
				
				array(
					'id'            => 'opt-woo-message-font',
					'type'          => 'typography',
					'title'         => __('Message Font', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.woocommerce-message'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.woocommerce-message'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the pop-up message font throughout Woocommerce sections. (ex. when adding an item to the cart)', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#383838',
						'font-weight'    => '300',
						'font-family'   => 'Roboto',
						'google'        => true,
						'font-size'   => '14px'
					),
				),//end of field


				
							
			  )//end of fields
			
			);//end of section
			
			
			
			//FONT SETTINGS
			$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('Font Settings', TEXT_DOMAIN),
			  'heading'   => __('Font Settings', TEXT_DOMAIN),
			  'desc'      => __('Use this area to manage global font settings for the Hope theme.', TEXT_DOMAIN),
			
			  'fields'    => array(
				  
				//Fields go here
				array(
					'id'            => 'opt-body-font',
					'type'          => 'typography',
					'title'         => __('Body Font', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('p', 'a', '.pm_single_post_comment_count'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('p', 'a', '.pm_single_post_comment_count'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing'=> true,  // Defaults to false
					'subtitle'      => __('Updates the main body font throughout the site.', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#7a7a7a',
						'font-weight'    => '300',
						'font-family'   => 'Arial',
						'google'        => true,
						'font-size'     => '12px',
					),
				),//end of field
				
				
				/*array(
					'id'            => 'opt-body-font',
					'type'          => 'typography',
					'title'         => __('Global Link Font', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array(''), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array(''), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing'=> true,  // Defaults to false
					'subtitle'      => __('Updates the main body font throughout the site.', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#00A8B2',
						'font-weight'    => '300',
						'font-family'   => 'Arial',
						'google'        => true,
						'font-size'     => '12px',
					),
				),//end of field*/
				
				
				array(
					'id'            => 'opt-main-nav-font',
					'type'          => 'typography',
					'title'         => __('Main Navigation Font', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.sf-menu a'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.sf-menu a'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the main navigation.', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#ffffff',
						'font-weight'    => '300',
						'font-family'   => 'Oswald',
						'google'        => true,
						'font-size'   => '13px',
						//'line-height'   => '40px',
					),
				),//end of field
				
								
				array(
					'id'            => 'opt-header1',
					'type'          => 'typography',
					'title'         => __('H1', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('h1'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('h1'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Update the font styling for the Header 1 tag.', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#cccccc',
						'font-weight'    => '300',
						'font-family'   => 'Arial',
						'google'        => true,
						'font-size'     => '48px',
					),
				),//end of field
				
				array(
					'id'            => 'opt-header2',
					'type'          => 'typography',
					'title'         => __('H2', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('h2'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('h2'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Update the font styling for the Header 2 tag.', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#474a4b',
						'font-weight'    => '300',
						'font-family'   => 'Roboto',
						'google'        => true,
						'font-size'     => '24px'
					),
				),//end of field
				
				array(
					'id'            => 'opt-header3',
					'type'          => 'typography',
					'title'         => __('H3', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('h3'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('h3'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Update the font styling for the Header 3 tag.', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#cccccc',
						'font-weight'    => '300',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '30px'
					),
				),//end of field
				
				array(
					'id'            => 'opt-header4',
					'type'          => 'typography',
					'title'         => __('H4', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('h4'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('h4'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Update the font styling for the Header 4 tag.', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#cccccc',
						'font-weight'    => '300',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'text-transform' => 'uppercase',
						'font-size'     => '30px',
					),
				),//end of field
				
				array(
					'id'            => 'opt-header5',
					'type'          => 'typography',
					'title'         => __('H5', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('h5'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('h5'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Update the font styling for the Header 5 tag.', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#f6d600',
						'font-weight'    => '300',
						'font-family'   => 'Oswald',
						'google'        => true,
						'font-size'     => '28px',
						'line-height'   => '32px',
						'text-transform' => 'uppercase',
					),
				),//end of field
				
				array(
					'id'            => 'opt-header6',
					'type'          => 'typography',
					'title'         => __('H6', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('h6'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('h6'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Update the font styling for the Header 6 tag.', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#5f5f5f',
						'font-weight'    => '100',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'   => '28px'
					),
				),//end of field
				
				
				array(
					'id'            => 'opt-breadcrumb-active-font',
					'type'          => 'typography',
					'title'         => __('Breadcrumb Font', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.breadcrumbs li','.breadcrumbs li a', '.woocommerce-breadcrumb li', '.woocommerce-breadcrumb li a'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.breadcrumbs li','.breadcrumbs li a', '.woocommerce-breadcrumb li', '.woocommerce-breadcrumb li a'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the breadcrumb trail font for the active link.', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#dbdbdb',
						'font-weight'    => '300',
						'font-family'   => 'Roboto',
						'google'        => true,
						'font-size'   => '12px'
					),
				),//end of field
				


				array(
					'id'            => 'opt-small-button-font',
					'type'          => 'typography',
					'title'         => __('Small Button Font', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.button-small span', '.button-small-theme span'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.button-small span', '.button-small-theme span'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font for the small button shortcode.', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#232323',
						'font-weight'    => '300',
						'font-family'   => 'Open sans',
						'google'        => true,
						'font-size'   => '14px'
					),
				),//end of field
				
				
				array(
					'id'            => 'opt-medium-button-font',
					'type'          => 'typography',
					'title'         => __('Medium Button Font', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.button-medium span', '.button-medium-theme span'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.button-medium span', '.button-medium-theme span'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font for the medium button shortcode.', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#232323',
						'font-weight'    => '300',
						'font-family'   => 'Open sans',
						'google'        => true,
						'font-size'   => '16px'
					),
				),//end of field
				
				
				array(
					'id'            => 'opt-large-button-font',
					'type'          => 'typography',
					'title'         => __('Large Button Font', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.button-large span', '.button-large-theme span'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.button-large span', '.button-large-theme span'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font for the large button shortcode.', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#232323',
						'font-weight'    => '300',
						'font-family'   => 'Open sans',
						'google'        => true,
						'font-size'   => '24px'
					),
				),//end of field
				
				
				array(
					'id'            => 'opt-global-button-font',
					'type'          => 'typography',
					'title'         => __('Global Button', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.header_donate_btn .button-small span'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.header_donate_btn .button-small span'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font for the global button in the header area', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#454545',
						'font-weight'    => '300',
						'font-family'   => 'Open sans',
						'google'        => true,
						'font-size'   => '14px'
					),
				),//end of field
				
				
				array(
					'id'            => 'opt-page-title-font',
					'type'          => 'typography',
					'title'         => __('Page Title', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm_page_title'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm_page_title'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the Page title.', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#ffffff',
						'font-weight'    => '300',
						'font-family'   => 'Roboto',
						'google'        => true,
						'font-size'   => '34px'
					),
				),//end of field
				
				
				array(
					'id'            => 'opt-page-header-message-font',
					'type'          => 'typography',
					'title'         => __('Page Header Message', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm_header_quote span'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm_header_quote span'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the Page Header Message.', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#ffffff',
						'font-weight'    => '300',
						'font-family'   => 'Roboto',
						'google'        => true,
						'font-size'   => '14px'
					),
				),//end of field
				
				array(
					'id'            => 'opt-gallery-post-title-font',
					'type'          => 'typography',
					'title'         => __('Gallery Post Title', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-gallery-item-title p'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-gallery-item-title p'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the Gallery post title.', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#ffffff',
						'font-weight'    => '300',
						'font-family'   => 'Poppins',
						'google'        => true,
						'font-size'   => '18px'
					),
				),//end of field
				
				array(
					'id'            => 'opt-comments-title-font',
					'type'          => 'typography',
					'title'         => __('Comments Title', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('#respond h3', '#comments'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('#respond h3', '#comments'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the Comments title.', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#00b7c2',
						'font-weight'    => '300',
						'font-family'   => 'Roboto',
						'google'        => true,
						'font-size'   => '16px',
						'line-height'   => '40px',
					),
				),//end of field
				
				array(
					'id'            => 'opt-panel-header-title-font',
					'type'          => 'typography',
					'title'         => __('Panel Header Title', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm_span_header h4', '.pm_image_panel_header h4'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm_span_header h4', '.pm_image_panel_header h4'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the Panel Header Title. Also applies to the Panel Header shortcode.', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#ffffff',
						'font-weight'    => '300',
						'font-family'   => 'Oswald',
						'google'        => true,
						'font-size'   => '18px',
						//'line-height'   => '40px',
					),
				),//end of field
				
				array(
					'id'            => 'opt-footer-widget-title-font',
					'type'          => 'typography',
					'title'         => __('Footer Widget Title', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.widget_footer h6'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.widget_footer h6'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the footer widget title.', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#ffffff',
						'font-weight'    => '300',
						'font-family'   => 'Oswald',
						'google'        => true,
						'font-size'   => '18px',
						//'line-height'   => '40px',
					),
				),//end of field
				
							
				
				array(
					'id'            => 'opt-footer-navigation-font',
					'type'          => 'typography',
					'title'         => __('Footer Navigation Font', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('#pm-footer-nav li a'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('#pm-footer-nav li a'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the footer navigation.', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#515151',
						'font-weight'    => '300',
						'font-family'   => 'Oswald',
						'google'        => true,
						'font-size'   => '13px',
						//'line-height'   => '40px',
					),
				),//end of field
				
				
				array(
					'id'            => 'opt-footer-body-font',
					'type'          => 'typography',
					'title'         => __('Footer Font', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.footer p', '.pm_footer_info_copyright li'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.footer p', '.pm_footer_info_copyright li'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the footer area.', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#ffffff',
						'font-weight'    => '300',
						'font-family'   => 'Arial',
						'google'        => true,
						'font-size'   => '13px',
						//'line-height'   => '40px',
					),
				),//end of field
				
				
				array(
					'id'            => 'opt-sidebar-widget-header-font',
					'type'          => 'typography',
					'title'         => __('Sidebar Widget Header', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-sidebar h6'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-sidebar h6'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the widget header title in the sidebar area.', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#00B7C2',
						'font-weight'    => '300',
						'font-family'   => 'Oswald',
						'google'        => true,
						'font-size'   => '20px',
						//'line-height'   => '40px',
					),
				),//end of field
				
				
				array(
					'id'            => 'opt-sidebar-font',
					'type'          => 'typography',
					'title'         => __('Sidebar Font', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-sidebar p', '.pm-sidebar p a'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-sidebar p', '.pm-sidebar p a'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the sidebar area.', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#737373',
						'font-weight'    => '300',
						'font-family'   => 'Arial',
						'google'        => true,
						'font-size'   => '12px',
						//'line-height'   => '40px',
					),
				),//end of field
				
				
				/*array(
					'id'            => 'opt-fullscreen-column-container-font',
					'type'          => 'typography',
					'title'         => __('Fullscreen Column Container Font', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array(''), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array(''), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for Column Containers set to fullscreen.', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#ffffff',
						'font-weight'    => '300',
						'font-family'   => 'Arial',
						'google'        => true,
						'font-size'   => '16px',
						//'line-height'   => '40px',
					),
				),//end of field*/
				
				
				array(
					'id'            => 'opt-featured-panel-header-font',
					'type'          => 'typography',
					'title'         => __('Featured Panel Header Font', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm_feature_container .container h5'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm_feature_container .container h5'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for Column Containers set to fullscreen.', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#ffffff',
						'font-weight'    => '300',
						'font-family'   => 'Oswald',
						'google'        => true,
						'font-size'   => '24px',
						//'line-height'   => '40px',
					),
				),//end of field
				
				
				array(
					'id'            => 'opt-featured-panel-font',
					'type'          => 'typography',
					'title'         => __('Featured Panel Font', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm_feature_container .container p'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm_feature_container .container p'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the H5 tag in the featuredPanel shortcode.', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#ffffff',
						'font-weight'    => '300',
						'font-family'   => 'Oswald',
						'google'        => true,
						'font-size'   => '24px',
						//'line-height'   => '40px',
					),
				),//end of field
				

				array(
					'id'            => 'opt-tooltip-font',
					'type'          => 'typography',
					'title'         => __('Tooltip Font', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('#pm_marker_tooltip'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('#pm_marker_tooltip'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the tooltip.', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#ffffff',
						'font-weight'    => '300',
						'font-family'   => 'Arial',
						'google'        => true,
						'font-size'   => '11px',
						//'line-height'   => '40px',
					),
				),//end of field
				
				
				array(
					'id'            => 'opt-unordered-list-font',
					'type'          => 'typography',
					'title'         => __('Unordered List Font', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('ul', 'ol'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('ul', 'ol'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the undordered and orderded lists.', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#4d4d4d',
						'font-weight'    => '300',
						'font-family'   => 'Arial',
						'google'        => true,
						'font-size'   => '12px',
						//'line-height'   => '40px',
					),
				),//end of field
				
				

				array(
					'id'            => 'opt-event-post-date-font',
					'type'          => 'typography',
					'title'         => __('Event Post Date Font', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-event-info-ul-date li strong', '.pm-event-info-ul-date li p'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-event-info-ul-date li strong', '.pm-event-info-ul-date li p'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the event post date displayed on the Events Template page.', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#ACDB05',
						'font-weight'    => '300',
						'font-family'   => 'Oswald',
						'google'        => true,
						'font-size'   => '46px',
						//'line-height'   => '40px',
					),
				),//end of field
				
				
				array(
					'id'            => 'opt-event-date-font',
					'type'          => 'typography',
					'title'         => __('Event Date Font', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm_event_single_post_countdown p'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm_event_single_post_countdown p'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the event post date.', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#ACDB05',
						'font-weight'    => '300',
						'font-family'   => 'Oswald',
						'google'        => true,
						'font-size'   => '60px',
						'line-height'   => '30px',
					),
				),//end of field
				
				
				array(
					'id'            => 'opt-event-days-left-font',
					'type'          => 'typography',
					'title'         => __('Event Days Left Font', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm_event_single_post_countdown .pm_event_days_left'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm_event_single_post_countdown .pm_event_days_left'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the event days left text.', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#ACDB05',
						'font-weight'    => '300',
						'font-family'   => 'Oswald',
						'google'        => true,
						'font-size'   => '30px',
						//'line-height'   => '30px',
					),
				),//end of field
				
				
				array(
					'id'            => 'opt-widget-event-date-font',
					'type'          => 'typography',
					'title'         => __('Widget Event Date Font', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-events-widget-date p'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-events-widget-date p'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the event post date in the events widget.', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#ACDB05',
						'font-weight'    => '300',
						'font-family'   => 'Oswald',
						'google'        => true,
						'font-size'   => '30px',
						//'line-height'   => '30px',
					),
				),//end of field
				
				
				array(
					'id'            => 'opt-blockquote-font',
					'type'          => 'typography',
					'title'         => __('Block Quote Font', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('blockquote p'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('blockquote p'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the blockquote tag.', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#ababab',
						'font-weight'    => '300',
						'font-family'   => 'Oswald',
						'google'        => true,
						'font-size'   => '20px',
						'line-height'   => '32px',
					),
				),//end of field
				
				
				/*array(
					'id'            => 'opt-comment-author-font',
					'type'          => 'typography',
					'title'         => __('Comment Author Font', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array(''), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array(''), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the comment author.', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#757575',
						'font-weight'    => '300',
						'font-family'   => 'Oswald',
						'google'        => true,
						'font-size'   => '18px',
						//'line-height'   => '32px',
					),
				),//end of field*/
				
				
				array(
					'id'            => 'opt-accordion-font',
					'type'          => 'typography',
					'title'         => __('Accordion Font', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.accordion-heading .accordion-toggle'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.accordion-heading .accordion-toggle'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the Accordion menu shortcode.', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#757575',
						'font-weight'    => '300',
						'font-family'   => 'Oswald',
						'google'        => true,
						'font-size'   => '20px',
						'line-height'   => '36px',
					),
				),//end of field
				
				
				array(
					'id'            => 'opt-tab-font',
					'type'          => 'typography',
					'title'         => __('Tab Font', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.nav-tabs > li > a'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.nav-tabs > li > a'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the Tabs menu shortcode.', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#7a7a7a',
						'font-weight'    => '300',
						'font-family'   => 'Oswald',
						'google'        => true,
						'font-size'   => '14px',
						'line-height'   => '26px',
					),
				),//end of field


				array(
					'id'            => 'opt-header-slogan-font',
					'type'          => 'typography',
					'title'         => __('Header Slogan Font', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm_header_slogan p'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm_header_slogan p'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the header slogan.', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#ffffff',
						'font-weight'    => '300',
						'font-family'   => 'Roboto',
						'google'        => true,
						'font-size'   => '14px',
						//'line-height'   => '40px',
					),
				),//end of field
				
				
				array(
					'id'            => 'opt-sponsors-label-font',
					'type'          => 'typography',
					'title'         => __('Sponsors Label Text', TEXT_DOMAIN),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm_sponsors_title'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm_sponsors_title'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the header slogan.', TEXT_DOMAIN),
					'default'       => array(
						'color'         => '#ffffff',
						'font-weight'    => '300',
						'font-family'   => 'Oswald',
						'google'        => true,
						'font-size'   => '14px',
						//'line-height'   => '40px',
					),
				),//end of field
				
			
			  )//end of fields
			
			);//end of section
			

			// IMPORT / EXPORT SETTINGS
            $this->sections[] = array(
                'title'     => __('Import / Export', TEXT_DOMAIN),
                'desc'      => __('Import and Export your Redux Framework settings from file, text or URL.', TEXT_DOMAIN),
                'icon'      => 'el-icon-refresh',
                'fields'    => array(
                    array(
                        'id'            => 'opt-import-export',
                        'type'          => 'import_export',
                        'title'         => 'Import Export',
                        'subtitle'      => 'Save and restore your Redux options',
                        'full_width'    => false,
                    ),
                ),
            );                     
            
			// TAB DIVIDER
            $this->sections[] = array(
                'type' => 'divide',
            );

			// THEME INFORMATION
            $this->sections[] = array(
                'icon'      => 'el-icon-info-sign',
                'title'     => __('Theme Information', TEXT_DOMAIN),
                'desc'      => __('<p class="description">This is the Description. Again HTML is allowed</p>', TEXT_DOMAIN),
                'fields'    => array(
                    array(
                        'id'        => 'opt-raw-info',
                        'type'      => 'raw',
                        'content'   => $item_info,
                    )
                ),
            );

            if (file_exists(trailingslashit(dirname(__FILE__)) . 'README.html')) {
                $tabs['docs'] = array(
                    'icon'      => 'el-icon-book',
                    'title'     => __('Documentation', TEXT_DOMAIN),
                    'content'   => nl2br(file_get_contents(trailingslashit(dirname(__FILE__)) . 'README.html'))
                );
            }
			
        }

        /*public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-1',
                'title'     => __('Theme Information 1', TEXT_DOMAIN),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', TEXT_DOMAIN)
            );

            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-2',
                'title'     => __('Theme Information 2', TEXT_DOMAIN),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', TEXT_DOMAIN)
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', TEXT_DOMAIN);
        }*/

        /**

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name'          => 'hope_options',            // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'      => $theme->get('Name'),     // Name that appears at the top of your panel
                'display_version'   => $theme->get('Version'),  // Version that appears at the top of your panel
                'menu_type'         => 'menu',                  // Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'    => true,                    // Show the sections below the admin menu item or not
                'menu_title'        => __('Hope Options', TEXT_DOMAIN),
                'page_title'        => __('Hope Options', TEXT_DOMAIN),
                
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => 'AIzaSyDBQJU8Cqmk_fxV1jvZeOdA3IpFL0Sq0js', // Must be defined to add google fonts to the typography module
                
                'async_typography'  => false,                    // Use a asynchronous font on the front end or font string
                'admin_bar'         => true,                    // Show the panel pages on the admin bar
                'global_variable'   => '',                      // Set a different name for your global variable other than the opt_name
                'dev_mode'          => false,                    // Show the time the page took to load, etc
                'customizer'        => false,                    // Enable basic customizer support
                //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.


                // OPTIONAL -> Give you extra features
                'page_priority'     => null,                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent'       => 'themes.php',            // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions'  => 'manage_options',        // Permissions needed to access the options panel.
                'menu_icon'         => '',                      // Specify a custom URL to an icon
                'last_tab'          => '',                      // Force your panel to always open to a specific tab (by id)
                'page_icon'         => 'icon-themes',           // Icon displayed in the admin panel next to your menu_title
                'page_slug'         => '_options',              // Page slug used to denote the panel
                'save_defaults'     => true,                    // On load save the defaults to DB before user clicks save or not
                'default_show'      => false,                   // If true, shows the default value next to each field that is not the default value.
                'default_mark'      => '',                      // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,                   // Shows the Import/Export panel when not used as a field.
                
                // CAREFUL -> These options are for advanced use only
                'transient_time'    => 60 * MINUTE_IN_SECONDS,
                'output'            => true,                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag'        => true,                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
                
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database'              => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info'           => false, // REMOVE

                // HINTS
                'hints' => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'         => 'light',
                        'shadow'        => true,
                        'rounded'       => false,
                        'style'         => '',
                    ),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect'    => array(
                        'show'          => array(
                            'effect'        => 'slide',
                            'duration'      => '500',
                            'event'         => 'mouseover',
                        ),
                        'hide'      => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'click mouseleave',
                        ),
                    ),
                )
            );


            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
            $this->args['share_icons'][] = array(
                'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
                'title' => 'Visit us on GitHub',
                'icon'  => 'el-icon-github'
                //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
            );
            $this->args['share_icons'][] = array(
                'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
                'title' => 'Like us on Facebook',
                'icon'  => 'el-icon-facebook'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'http://twitter.com/reduxframework',
                'title' => 'Follow us on Twitter',
                'icon'  => 'el-icon-twitter'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'http://www.linkedin.com/company/redux-framework',
                'title' => 'Find us on LinkedIn',
                'icon'  => 'el-icon-linkedin'
            );

            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace('-', '_', $this->args['opt_name']);
                }
                $this->args['intro_text'] = sprintf(__('<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', TEXT_DOMAIN), $v);
            } else {
                $this->args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', TEXT_DOMAIN);
            }

            // Add content after the form.
            $this->args['footer_text'] = __('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', TEXT_DOMAIN);
        }

    }
    
    global $reduxConfig;
    $reduxConfig = new Redux_Framework_sample_config();
}

/**
  Custom function for the callback referenced above
 */
if (!function_exists('redux_my_custom_field')):
    function redux_my_custom_field($field, $value) {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
endif;

/**
  Custom function for the callback validation referenced above
 * */
if (!function_exists('redux_validate_callback_function')):
    function redux_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';

        /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            $field['msg'] = 'your custom error message';
          }
         */

        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }
endif;

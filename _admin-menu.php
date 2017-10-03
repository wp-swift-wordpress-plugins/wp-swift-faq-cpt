<?php
/**
 * These are the settings for backend admin page. This includes a settings
 * tab and help tab. This page will show under the setttings menus 
 * unless the wp-swift-admin-menu plugin is activated where it will show
 * show under that menu instead.
 * 
 * @author 	 Gary Swift 
 * @since    1.0.0
 */
add_action( 'admin_menu', 'wp_swift_faq_cpt_add_admin_menu' );
add_action( 'admin_init', 'wp_swift_faq_cpt_settings_init' );

/*
 * This determines the location the settings page
 * It are listed under Settings unless the other plugin 'wp_swift_admin_menu' is activated
 */
function wp_swift_faq_cpt_add_admin_menu(  ) { 
	if ( get_option( 'wp_swift_admin_menu' ) ) {
        add_submenu_page( 'wp-swift-admin-menu', 'WP Swift: FAQ CPT', 'FAQ', 'manage_options', 'wp_swift_faq_cpt', 'wp_swift_faq_cpt_options_page' );
    }
    else {
        add_options_page( 'WP Swift: FAQ CPT', 'FAQ', 'manage_options', 'wp_swift_faq_cpt', 'wp_swift_faq_cpt_options_page' );
    }
}

function wp_swift_faq_cpt_settings_init(  ) { 

	/*
	 * Settings page
	 */
	register_setting( 'faq_settings_page', 'wp_swift_faq_cpt_settings' );

	add_settings_section(
		'wp_swift_faq_cpt_settings_page_section', 
		__( 'Settings Page', 'wp-swift-faq-cpt' ), 
		'wp_swift_faq_cpt_settings_section_callback', 
		'faq_settings_page'
	);

	add_settings_field( 
		'wp_swift_faq_cpt_checkbox_load_assets', 
		__( 'Load Public Assets', 'wp-swift-faq-cpt' ), 
		'wp_swift_faq_cpt_checkbox_load_assets_render', 
		'faq_settings_page', 
		'wp_swift_faq_cpt_settings_page_section' 
	);

	add_settings_field( 
		'wp_swift_faq_cpt_checkbox_supports', 
		__( 'CPT Support', 'wp-swift-faq-cpt' ), 
		'wp_swift_faq_cpt_checkbox_supports_render', 
		'faq_settings_page', 
		'wp_swift_faq_cpt_settings_page_section' 
	);

	add_settings_field( 
		'wp_swift_faq_cpt_checkbox_visibility', 
		__( 'CPT Visibility', 'wp-swift-faq-cpt' ), 
		'wp_swift_faq_cpt_checkbox_visibility_render', 
		'faq_settings_page', 
		'wp_swift_faq_cpt_settings_page_section' 
	);

	add_settings_field( 
		'wp_swift_faq_cpt_checkbox_acf_fields', 
		__( 'ACF Fields', 'wp-swift-faq-cpt' ), 
		'wp_swift_faq_cpt_checkbox_acf_fields_render', 
		'faq_settings_page', 
		'wp_swift_faq_cpt_settings_page_section' 
	);

	add_settings_field( 
		'wp_swift_faq_cpt_checkbox_visibility', 
		__( 'CPT Visibility', 'wp-swift-faq-cpt' ), 
		'wp_swift_faq_cpt_checkbox_visibility_render', 
		'faq_settings_page', 
		'wp_swift_faq_cpt_settings_page_section' 
	);

	/*
	 * Help page
	 */
	register_setting( 'faq_help_page', 'wp_swift_faq_cpt_help' );

	add_settings_section(
		'wp_swift_faq_cpt_help_page_section', 
		__( 'Help Page', 'wp-swift-faq-cpt' ), 
		'wp_swift_faq_cpt_help_section_callback', 
		'faq_help_page'
	);

	add_settings_field( 
		'wp_swift_faq_cpt_help_shortcode', 
		__( 'Shortcodes', 'wp-swift-faq-cpt' ), 
		'wp_swift_faq_cpt_help_shortcode_render', 
		'faq_help_page', 
		'wp_swift_faq_cpt_help_page_section' 
	);

	add_settings_field( 
		'wp_swift_faq_cpt_help_php_function', 
		__( 'PHP Code', 'wp-swift-faq-cpt' ), 
		'wp_swift_faq_cpt_help_php_function_render', 
		'faq_help_page', 
		'wp_swift_faq_cpt_help_page_section' 
	);		
}


function wp_swift_faq_cpt_select_field_page_render(  ) { 

	$options = get_option( 'wp_swift_faq_cpt_settings' );
	$args = array(
		'posts_per_page'   => 50,
		'post_type'        => 'page',
	);
	$posts_array = get_posts( $args );
	?>
	<select name='wp_swift_faq_cpt_settings[wp_swift_faq_cpt_select_field_page]'>
		<?php foreach ($posts_array as $key => $post): ?>
			<option value="<?php echo $post->ID; ?>" <?php 
				is_select_set('wp_swift_faq_cpt_select_field_page', $options, $post->ID);
			?>><?php echo $post->post_title; ?></option>
		<?php endforeach ?>
	</select>

<?php

}

if (!function_exists('is_select_set')) {
	function is_select_set($name, $options, $value) {
	    if (isset($options[$name]) && $options[$name] == $value) {
	        echo 'selected';
	    }
	}
}

function wp_swift_faq_cpt_select_field_show_method_render(  ) { 

	$options = get_option( 'wp_swift_faq_cpt_settings' );
	?>
	<select name='wp_swift_faq_cpt_settings[wp_swift_faq_cpt_select_field_show_method]'>
		<option></option>
		<option value="shortcode" <?php is_select_set( 'wp_swift_faq_cpt_select_field_show_method', $options, 'shortcode' ); ?>>Shortcode</option>
		<option value="content" <?php is_select_set( 'wp_swift_faq_cpt_select_field_show_method', $options, 'content' ); ?>>After Page Content</option>
		<option value="template" <?php is_select_set( 'wp_swift_faq_cpt_select_field_show_method', $options, 'template' ); ?>>Template</option>
	</select>
	<!-- (You use a PHP function) -->
<?php

}
function wp_swift_faq_cpt_checkbox_load_assets_render(  ) { 

	$options = get_option( 'wp_swift_faq_cpt_settings' );
	?>
	<input type="checkbox" value="1" name='wp_swift_faq_cpt_settings[wp_swift_faq_cpt_checkbox_load_css]' <?php 
		if (isset($options['wp_swift_faq_cpt_checkbox_load_css'])) {
			checked( $options['wp_swift_faq_cpt_checkbox_load_css'], 1 ); 
		}
		?>><label for="wp_swift_faq_cpt_settings[wp_swift_faq_cpt_checkbox_load_css]">Load CSS</label>
	<br>
	<input type="checkbox" value="1" name='wp_swift_faq_cpt_settings[wp_swift_faq_cpt_checkbox_load_javascript]' <?php 
		if (isset($options['wp_swift_faq_cpt_checkbox_load_javascript'])) {
			checked( $options['wp_swift_faq_cpt_checkbox_load_javascript'], 1 ); 
		}
		?>><label for="name='wp_swift_faq_cpt_settings[wp_swift_faq_cpt_checkbox_load_javascript]'">Load JavaScript</label>
		<br>
		<small>Use the plugin to load CSS &amp; JavaScript files into the public facing page.</small>
	<?php
}
function wp_swift_faq_cpt_checkbox_supports_render( ) { 

	$options = get_option( 'wp_swift_faq_cpt_settings' );
	?>
	<input type="checkbox" value="1" name='wp_swift_faq_cpt_settings[wp_swift_faq_cpt_checkbox_support_featured_image]' <?php 
		if (isset($options['wp_swift_faq_cpt_checkbox_support_featured_image'])) {
			checked( $options['wp_swift_faq_cpt_checkbox_support_featured_image'], 1 ); 
		}
		?>><label for="wp_swift_faq_cpt_settings[wp_swift_faq_cpt_checkbox_support_featured_image]">Featured Image</label>
	<br>
	<input type="checkbox" value="1" name='wp_swift_faq_cpt_settings[wp_swift_faq_cpt_checkbox_support_excerpt]' <?php 
		if (isset($options['wp_swift_faq_cpt_checkbox_support_excerpt'])) {
			checked( $options['wp_swift_faq_cpt_checkbox_support_excerpt'], 1 ); 
		}
		?>><label for="wp_swift_faq_cpt_settings[wp_swift_faq_cpt_checkbox_support_excerpt]">Excerpt</label>
	<?php
}

function wp_swift_faq_cpt_checkbox_acf_fields_render( ) { 

	$options = get_option( 'wp_swift_faq_cpt_settings' );
	?>
	<input type="checkbox" value="1" name='wp_swift_faq_cpt_settings[wp_swift_faq_cpt_checkbox_acf_field_attribution]' <?php 
		if (isset($options['wp_swift_faq_cpt_checkbox_acf_field_attribution'])) {
			checked( $options['wp_swift_faq_cpt_checkbox_acf_field_attribution'], 1 ); 
		}
		?>><label for="wp_swift_faq_cpt_settings[wp_swift_faq_cpt_checkbox_acf_field_attribution]">Attribution</label>
	<br>
	<input type="checkbox" value="1" name='wp_swift_faq_cpt_settings[wp_swift_faq_cpt_checkbox_acf_field_position_or_status]' <?php 
		if (isset($options['wp_swift_faq_cpt_checkbox_acf_field_position_or_status'])) {
			checked( $options['wp_swift_faq_cpt_checkbox_acf_field_position_or_status'], 1 ); 
		}
		?>><label for="wp_swift_faq_cpt_settings[wp_swift_faq_cpt_checkbox_acf_field_position_or_status]">Position or Status</label>
	<br>
	<input type="checkbox" value="1" name='wp_swift_faq_cpt_settings[wp_swift_faq_cpt_checkbox_acf_field_location]' <?php 
		if (isset($options['wp_swift_faq_cpt_checkbox_acf_field_location'])) {
			checked( $options['wp_swift_faq_cpt_checkbox_acf_field_location'], 1 ); 
		}
		?>><label for="wp_swift_faq_cpt_settings[wp_swift_faq_cpt_checkbox_acf_field_location]">Location</label>
	<div><small>Additional custom fields.</small></div>
	<?php		
}

function wp_swift_faq_cpt_checkbox_visibility_render( ) {

	$options = get_option( 'wp_swift_faq_cpt_settings' );
	?>
	<input type="checkbox" value="1" name='wp_swift_faq_cpt_settings[wp_swift_faq_cpt_checkbox_visibility]' <?php 
		if (isset($options['wp_swift_faq_cpt_checkbox_visibility'])) {
			checked( $options['wp_swift_faq_cpt_checkbox_visibility'], 1 ); 
		}
	?>><label for="wp_swift_faq_cpt_settings[wp_swift_faq_cpt_checkbox_visibility]">Public</label>
	<br><small>Public CPTs will have their own public facing pages and may be parsed by web crawlers.</small><?php
}

function wp_swift_faq_cpt_help_shortcode_render( ) { 
?>
<pre class="prettyprint custom">
// Questions
[faq]

// Question categories
[faq-cat]
[faq-cat to-do="true"]
[faq-cat answers="true"]
</pre>
<?php
}

function wp_swift_faq_cpt_help_php_function_render(  ) { 
?>
<pre class="prettyprint lang-php custom">
// Render the FAQ
if (function_exists('wp_swift_faqs_func')) {
  echo wp_swift_faqs_func();
}
</pre>
<?php
}

function wp_swift_faq_cpt_help_sass_function_render(  ) { 
?>
<p>Sample sass code</p>
<pre class="prettyprint lang-scss custom">
</pre>
<?php
}

function wp_swift_faq_cpt_settings_section_callback(  ) { 

	echo __( 'WordPress custom post type for FAQ.', 'wp-swift-faq-cpt' );

}

function wp_swift_faq_cpt_help_section_callback(  ) { 
	?><p>To render the <b>FAQ</b> onto a webpage there are two options: PHP code and WordPress <a href="https://codex.wordpress.org/Shortcode" target="_blank">Shortcodes</a>.</p><?php
}

function wp_swift_faq_cpt_options_page(  ) { 
?><div id="wp-swift-faq-cpt-options-page" class="wrap">

	<h1>WP Swift: FAQ CPT</h1>

	<?php $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'faq_settings_page'; ?>

	<h2 class="nav-tab-wrapper">
	    <a href="?page=wp_swift_faq_cpt&tab=faq_settings_page" class="nav-tab <?php echo $active_tab == 'faq_settings_page' ? 'nav-tab-active' : ''; ?>">Settings</a>
	    <a href="?page=wp_swift_faq_cpt&tab=faq_help_page" class="nav-tab <?php echo $active_tab == 'faq_help_page' ? 'nav-tab-active' : ''; ?>">Help Page</a>
	</h2>

		<?php
			if ($active_tab == 'faq_settings_page') {
				echo "<form action='options.php' method='post'>";
				settings_fields( 'faq_settings_page' );
				do_settings_sections( 'faq_settings_page' );
				submit_button();
				echo "</form>";
			}
			elseif ($active_tab == 'faq_help_page'){
				
				settings_fields( 'faq_help_page' );
				do_settings_sections( 'faq_help_page' );
				
			}
		?>
</div><!-- @end #wp-swift-faq-cpt-options-page --><?php
}
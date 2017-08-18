<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/wp-swift-wordpress-plugins
 * @since             1.0.0
 * @package           Wp_Swift_Faq_Cpt
 *
 * @wordpress-plugin
 * Plugin Name:       WP Swift: FAQ CPT
 * Plugin URI:        https://github.com/wp-swift-wordpress-plugins/wp-swift-faq-cpt
 * Description:       Add a custum post type for FAQs in WordPress
 * Version:           1.0.0
 * Author:            Gary Swift
 * Author URI:        https://github.com/wp-swift-wordpress-plugins
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-swift-faq-cpt
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-swift-faq-cpt-activator.php
 */
function activate_wp_swift_faq_cpt() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-swift-faq-cpt-activator.php';
	Wp_Swift_Faq_Cpt_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-swift-faq-cpt-deactivator.php
 */
function deactivate_wp_swift_faq_cpt() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-swift-faq-cpt-deactivator.php';
	Wp_Swift_Faq_Cpt_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_swift_faq_cpt' );
register_deactivation_hook( __FILE__, 'deactivate_wp_swift_faq_cpt' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-swift-faq-cpt.php';

/**
 * ******************** *
 * @author 	 Gary Swift *
 * ******************** *
 */

/**
 * The custom post type.
 *
 * @author 	 Gary Swift 
 * @since    1.0.0
 */
require plugin_dir_path( __FILE__ ) . 'cpt/_cpt-register.php';

/**
 * The posts screen columns.
 *
 * @author 	 Gary Swift 
 * @since    1.0.0
 */
require plugin_dir_path( __FILE__ ) . 'cpt/_cpt-posts-screen-columns.php';

/**
 * The title placeholder.
 *
 * @author 	 Gary Swift 
 * @since    1.0.0
 */
require plugin_dir_path( __FILE__ ) . 'cpt/_cpt-title-placeholder.php';

/**
 * The Advanced Custom Fields field group.
 *
 * @author 	 Gary Swift 
 * @since    1.0.0
 */
require plugin_dir_path( __FILE__ ) . 'acf-field-groups/_acf-field-group.php';

/**
 * The Admin menu settings.
 *
 * @author 	 Gary Swift 
 * @since    1.0.0
 */
function wp_swift_faq_cpt_admin_menu() {
	if( current_user_can('editor') || current_user_can('administrator') ) {
		require plugin_dir_path( __FILE__ ) . '_admin-menu.php';
	}
}
add_action( 'init', 'wp_swift_faq_cpt_admin_menu' );

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_swift_faq_cpt() {

	$plugin = new Wp_Swift_Faq_Cpt();
	$plugin->run();

}
run_wp_swift_faq_cpt();

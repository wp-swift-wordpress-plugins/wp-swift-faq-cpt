<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/wp-swift-wordpress-plugins
 * @since      1.0.0
 *
 * @package    Wp_Swift_Faq_Cpt
 * @subpackage Wp_Swift_Faq_Cpt/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Swift_Faq_Cpt
 * @subpackage Wp_Swift_Faq_Cpt/public
 * @author     Gary Swift <garyswiftmail@gmail.com>
 */
class Wp_Swift_Faq_Cpt_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		add_shortcode( 'faq', array($this, 'faq_func') );
		add_shortcode( 'faq-cat', array($this, 'faq_cat_func') );
	}

	// [faq foo="foo-value"]
	// $a = shortcode_atts( array(
	//     'foo' => 'something',
	//     'bar' => 'something else',
	// ), $atts );
	// return "foo = {$a['foo']}";
	public function faq_func( $atts ) {

        $options = get_option( 'wp_swift_faq_cpt_settings' );
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = array( 
            'post_type' => 'faq', 
            'posts_per_page' => -1, 
            'paged' => $paged,
        );
        global $wp_query;
        $wp_query = new WP_Query($args);
        $html='';

        if ( have_posts() ) : 
			ob_start();
			require_once plugin_dir_path( __FILE__ ) . 'partials/wp-swift-faq-cpt-public-display.php';
			$html = ob_get_contents();
			ob_end_clean();		
        endif; // End have_posts() check.
        wp_reset_query();

		return $html;
	}

	public function faq_cat_func( $atts ) {
		$atts = shortcode_atts(
			array(
				'to-do' => false,
				'answers' => false,
			), 
		$atts, 'bartag' );
		$debug = $atts['to-do'];
		$answers = $atts['answers'];
		
        $html='';
		ob_start();
		require_once plugin_dir_path( __FILE__ ) . 'partials/wp-swift-faq-taxonomy-public-display.php';
		$html = ob_get_contents();
		ob_end_clean();		
		return $html;
	}
	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Swift_Faq_Cpt_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Swift_Faq_Cpt_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-swift-faq-cpt-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Swift_Faq_Cpt_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Swift_Faq_Cpt_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-swift-faq-cpt-public.js', array( 'jquery' ), $this->version, false );

	}

}

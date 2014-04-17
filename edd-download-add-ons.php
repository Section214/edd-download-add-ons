<?php
/**
 * Plugin Name: EDD Download Add-ons
 * Plugin URI: #
 * Description: Allows you to create and display a base/add-on relationship between downlaods.
 * Version: 1.0.0
 * Author: Sean Davis
 * Author URI: http://seandavis.co
 * License: GPL2
 * Requires at least: 3.8
 * Tested up to: 3.8
 * Text Domain: eddda
 * Domain Path: /languages/
 * 
 * This plugin is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as 
 * published by the Free Software Foundation.
 * 
 * This plugin is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, see http://www.gnu.org/licenses/.
 */
if ( ! defined( 'ABSPATH' ) ) exit; // no accessing this file directly


/**
 * primary class for EDD Download Add-ons
 *
 * @since 1.0.0
 */
class EDD_Download_Addons {


	/**
	 * constructor for Simple_Course_Creator class
	 */
	public function __construct() {

		// define plugin name
		define( 'EDDDA_NAME', 'EDD Download Add-ons' );

		// define plugin version
		define( 'EDDDA_VERSION', '1.0.0' );

		// define plugin directory
		define( 'EDDDA_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );

		// define plugin root file
		define( 'EDDDA_URL', trailingslashit( plugin_dir_url( __FILE__ ) ) );

		// load text domain
		add_action( 'init', array( $this, 'load_textdomain' ) );

		// load admin scripts and styles
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_assets' ) );

		// require additional plugin files
		$this->includes();
	}


	/**
	 * load EDD Download Add-ons textdomain
	 */
	public function load_textdomain() {
		load_plugin_textdomain( 'eddda', false, EDDDA_DIR . "languages" );
	}


	/** 
	 * enqueue back-end scripts and styles
	 */
	public function admin_assets() {

		// edit download page CSS
		wp_enqueue_style( 'eddda_admin_style', EDDDA_URL . 'assets/css/admin-styles.css' );

		// edit download page JS
		wp_enqueue_script( 'eddda_admin_scripts', EDDDA_URL . 'assets/js/admin-scripts.js' );
	}


	/**
	 * require additional plugin files
	 */
	private function includes() {
		require_once( EDDDA_DIR . 'includes/admin/class-eddda-meta-box.php' ); // build EDDDA meta box
	}
}
new EDD_Download_Addons();
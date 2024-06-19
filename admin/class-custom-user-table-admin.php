<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://elementorex.com
 * @since      1.0.0
 *
 * @package    Custom_User_Table
 * @subpackage Custom_User_Table/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Custom_User_Table
 * @subpackage Custom_User_Table/admin
 * @author     Kawsar Ahmed <kawsarr575@gmail>
 */
class Custom_User_Table_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_action( 'admin_menu', [ $this, 'admin_menu' ] );

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Custom_User_Table_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Custom_User_Table_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->plugin_name . '_datatables', 'https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css');
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/custom-user-table-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Custom_User_Table_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Custom_User_Table_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script('jquery');
		
		wp_enqueue_script($this->plugin_name .'_datatables', 'https://cdn.datatables.net/2.0.8/js/dataTables.js', array('jquery'), null, true);
		wp_enqueue_script( $this->plugin_name . '_js', plugin_dir_url( __FILE__ ) . 'js/custom-user-table-admin.js', array( 'jquery' ), $this->version, true );
		wp_localize_script($this->plugin_name . '_js', 'customUserTable', array('ajaxurl' => admin_url('admin-ajax.php')));

	}

	// Register the admin menu
	function admin_menu() {
		add_menu_page('Cusotm User Table', 'Cusotm User Table', 'manage_options', 'custom-user-table', [$this, 'custom_user_table_page' ], 'dashicons-editor-table', 6);
	}

	/**
	 * Declare the menu page callback
	 */
	function custom_user_table_page() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/custom-user-table-page.php';
	}

}

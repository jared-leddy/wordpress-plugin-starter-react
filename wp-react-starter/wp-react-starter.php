<?php
/**
 * @wordpress-plugin
 * Plugin Name:       React WordPress Starter
 * Plugin URI:        http://fortembr.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            React WordPress
 * Author URI:        fortembr.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-react-starter
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class WPReactStarter
{
  public $plugin;

  function __construct() {
    $this->plugin = plugin_basename(__FILE__);
  }

  function register() {
    add_action('admin_menu', array($this, 'add_admin_page'));
    add_action('admin_enqueue_scripts', array($this, 'enqueue_assets'));
    add_filter("plugin_action_links_$this->plugin", array($this, 'settings_link'));
  }

  public function settings_link( $links ) {
    $settings_link = '<a href="admin.php?page=wp_react_starter">Settings</a>';
    array_push($links, $settings_link);
    return $links;
  }

  function enqueue_assets() {
    wp_enqueue_style( "$this->plugin-css", plugins_url('/assets/styles.css', __FILE__) );
    wp_enqueue_script( "$this->plugin-main-js", plugins_url('/assets/main.js', __FILE__), null, null, true );
    wp_enqueue_script( "$this->plugin-scripts-js", plugins_url('/assets/scripts.js', __FILE__), null, null, true );
  }

  public function add_admin_page() {
    add_menu_page("React WordPress", 'React WordPress', 'manage_options', 'wp_react_starter', array($this, 'admin_index'), '');
  }

  public function admin_index() {
    require_once plugin_dir_path(__FILE__) . 'admin/index.php';
  }
}

if ( class_exists('WPReactStarter') ) {
  $WPReactStarter = new WPReactStarter();
  $WPReactStarter->register();
}

// Activation
require_once plugin_dir_path(__FILE__)  . 'includes/wp-react-starter-activate.php';
register_activation_hook( __FILE__, array( 'WPReactStarterActivate', 'activate' ) );

// Deactivation
require_once plugin_dir_path(__FILE__)  . 'includes/wp-react-starter-deactivate.php';
register_deactivation_hook( __FILE__, array( 'WPReactStarterDeactivate', 'deactivate' ) );
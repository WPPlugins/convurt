<?php
/**
 * Plugin Name:       Convurt - Voice To Blog Post
 * Plugin URI:        http://wordpress.org/plugins/convurt/
 * Description:       This plugin will help you to connect with convurt app to convert all the voices as text and import them to your wordpress websites.
 * Version:           1.1.5
 * Author:            Convurt, LLC
 * Author URI:        https://convurt.io/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       convurt
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/*
 * Function that runs during plugin activation.
 */
function activate_wp_convurt() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-convurt-activator.php';
	Wp_Convurt_Activator::activate();
}

/**
 * Function that runs during plugin deactivation.
 */
function deactivate_wp_convurt() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-convurt-deactivator.php';
	Wp_Convurt_Deactivator::deactivate();
}

/**
 * Function that runs during plugin uninstallation.
 */
function uninstall_wp_convurt() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-convurt-uninstall.php';
	Wp_Convurt_Uninstallor::uninstall();
}

register_activation_hook( __FILE__, 'activate_wp_convurt' );
register_deactivation_hook( __FILE__, 'deactivate_wp_convurt' );
register_uninstall_hook( __FILE__, 'uninstall_wp_convurt' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-convurt.php';

/**
 * Check condition for api key if exist or not.
 * If exist then cron function will call.
 */
$wpconvurt_api = get_option('convurt_api_user_option');

if(isset($wpconvurt_api) && !empty($wpconvurt_api)) { 
	
	/**
	 * The core plugin class that is used to run cron functions,
 	*/
	require plugin_dir_path( __FILE__ ) . 'includes/class-wp-convurt-cron-action.php';

	$cron = new Wp_Convurt_Cron();	
}

/**
 * Begins execution of the plugin.
 *
 * @since    1.0.0
 */
function wpconvurt_run_wp_convurt() {
	$convurt_main = new Wp_Convurt();
	$convurt_main->wpconvurt_run();
}
wpconvurt_run_wp_convurt();
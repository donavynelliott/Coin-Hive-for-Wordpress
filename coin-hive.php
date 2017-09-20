<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://donavynelliott.com
 * @since             1.0.0
 * @package           Coin_Hive
 *
 * @wordpress-plugin
 * Plugin Name:       Coin Hive for Wordpress
 * Plugin URI:        http://donavynelliott.com/coin-hive/
 * Description:       This plugin adds options for monetising your website via javascript cpu mining.
 * Version:           1.0.0
 * Author:            Donavyn Elliott
 * Author URI:        http://donavynelliott.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       coin-hive
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

define('PLUGIN_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-coin-hive-activator.php
 */
function activateCoinHive()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-coin-hive-activator.php';
    Coin_Hive_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-coin-hive-deactivator.php
 */
function deactivateCoinHive()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-coin-hive-deactivator.php';
    Coin_Hive_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_coin_hive');
register_deactivation_hook(__FILE__, 'deactivate_coin_hive');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-coin-hive.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function runCoinHive()
{

    $plugin = new Coin_Hive();
    $plugin->run();

}
runCoinHive();

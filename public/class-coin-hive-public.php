<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://donavynelliott.com
 * @since      1.0.0
 *
 * @package    Coin_Hive
 * @subpackage Coin_Hive/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Coin_Hive
 * @subpackage Coin_Hive/public
 * @author     Donavyn Elliott <donavyn.elliott@gmail.com>
 */
class CoinHivePublic
{

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
     * The public site key for coin hive
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $site_key    The current version of this plugin.
     */
    private $site_key;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

        $options = get_option('coin_hive_account_api_keys');
        $this->site_key = $options['site_key'];
        add_action('wp_footer', array($this, 'coinHiveFooter'));

    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueueStyles()
    {
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/coin-hive-public.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueueScripts()
    {
        wp_register_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/coin-hive-public.js', array('jquery'), $this->version, true);

        wp_localize_script($this->plugin_name, 'coin_hive_site_key', array('site_key' => $this->site_key));

        wp_enqueue_script('coin-hive-min', 'https://coin-hive.com/lib/coinhive.min.js', array(), $this->version, true);
        wp_enqueue_script($this->plugin_name);
    }

    /**
     * Register Coinhive Footer for warning, opt-out, & stats
     *
     * @since 1.0.0
     */
    public function coinHiveFooter()
    {
        $options = get_option('coin_hive_background_mining_settings');
        $visitor_warning = $options['visitor_warning'];
        $opt_out_enabled = $options['opt_out'];
        require_once plugin_dir_path(__FILE__) . 'partials/coin-hive-public-display.php';
    }

}

<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://donavynelliott.com
 * @since      1.0.0
 *
 * @package    Coin_Hive
 * @subpackage Coin_Hive/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Coin_Hive
 * @subpackage Coin_Hive/admin
 * @author     Donavyn Elliott <donavyn.elliott@gmail.com>
 */
class CoinHiveAdmin
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
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
        if (is_admin()) {
            add_action('admin_menu', array($this, 'coinHiveAddAdminMenu'));
            add_action('admin_init', array($this, 'coinHiveSettingsInit'));
        }

    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueueStyles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Coin_Hive_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Coin_Hive_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/coin-hive-admin.css', array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueueScripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Coin_Hive_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Coin_Hive_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/coin-hive-admin.js', array('jquery'), $this->version, false);

    }

    /**
     * Register the settings page
     * @since 1.0.0
     */

    public function coinHiveAddAdminMenu()
    {
        add_menu_page('Coin Hive', 'Coin Hive', 'manage_options', 'coin_hive', array($this, 'coinHiveAPIKeysPage'));
        add_submenu_page('coin_hive', 'Background Miner', 'Background Miner', 'manage_options', 'background-miner', array($this, 'coinHiveBackgroundMinerPage'));
    }

    /**
     * Register the settings
     * @since 1.0.0
     */
    public function coinHiveSettingsInit()
    {
        /**
         * API Keys settings
         */

        register_setting(
            'coin_hive_account', // Option group
            'coin_hive_account_api_keys', // Option name
            array($this, 'sanitize') // Sanitize
        );

        add_settings_section(
            'coin_hive_account_section', // ID
            'Connect your Coin Hive Account', // Title
            array($this, 'coinHiveAPIKeysSettingsSectionCallback'), // Callback
            'coin_hive_account' // Page
        );

        add_settings_field(
            'site_key', // ID
            __('Site Key (public)', 'Coin Hive'),
            array($this, 'coinHiveSiteKeyFieldRender'), // Callback
            'coin_hive_account', // Page
            'coin_hive_account_section' // Section
        );

        add_settings_field(
            'secret_key', // ID
            __('Secret Key (private)', 'Coin Hive'),
            array($this, 'coinHiveSecretKeyFieldRender'), // Callback
            'coin_hive_account', // Page
            'coin_hive_account_section' // Section
        );

        /**
         * Background Mining Settings
         */

        register_setting(
            'coin_hive_background_mining', // Option group
            'coin_hive_background_mining_settings', // Option name
            array($this, 'sanitize') // Sanitize
        );

        add_settings_section(
            'coin_hive_background_miner_section', // ID
            'Embed a Background Miner', // Title
            array($this, 'coinHiveBackgroundMiningSettingsSectionCallback'), // Callback
            'coin_hive_background_mining' // Page
        );

        add_settings_field(
            'visitor_warning', // ID
            __('Give Visitors Warning about CPU Mining.', 'Coin Hive'),
            array($this, 'coinHiveVisitorWarningFieldRender'), // Callback
            'coin_hive_background_mining', // Page
            'coin_hive_background_miner_section' // Section
        );

        add_settings_field(
            'opt_out', // ID
            __('Allow Users to Opt-Out of backgroud mining.', 'Coin Hive'),
            array($this, 'coinHiveOptOutFieldRender'), // Callback
            'coin_hive_background_mining', // Page
            'coin_hive_background_miner_section' // Section
        );
    }

    /**
     * Register public key text box
     * @since 1.0.0
     */
    public function coinHiveSiteKeyFieldRender()
    {

        $options = get_option('coin_hive_account_api_keys');
        printf(
            '<input type="text" id="site_key" name="coin_hive_account_api_keys[site_key]" value="%s" />',
            isset($options['site_key']) ? esc_attr($options['site_key']) : ''
        );

    }

    /**
     * Register secret key text box
     * @since 1.0.0
     */
    public function coinHiveSecretKeyFieldRender()
    {

        $options = get_option('coin_hive_account_api_keys');
        printf(
            '<input type="password" id="site_key" name="coin_hive_account_api_keys[secret_key]" value="%s" />',
            isset($options['secret_key']) ? esc_attr($options['secret_key']) : ''
        );

    }

    /**
     * Register visitor warning checkbox
     * @since 1.0.0
     */
    public function coinHiveVisitorWarningFieldRender()
    {

        $options = get_option('coin_hive_background_mining_settings');
        printf(
            '<input type="checkbox" id="visitor_warning" name="coin_hive_background_mining_settings[visitor_warning]" %s />',
            checked($options['visitor_warning'], 'on', false)
        );
    }

    /**
     * Register visitor opt-out checkbox
     * @since 1.0.0
     */
    public function coinHiveOptOutFieldRender()
    {

        $options = get_option('coin_hive_background_mining_settings');
        printf(
            '<input type="checkbox" id="opt_out" name="coin_hive_background_mining_settings[opt_out]" %s />',
            checked($options['opt_out'], 'on', false)
        );
    }

    /**
     * Register api keys settings page
     * @since 1.0.0
     */
    public function coinHiveAPIKeysPage()
    {
        require_once plugin_dir_path(__FILE__) . 'partials/coin-hive-admin-api-keys.php';
    }

    /**
     * Register api keys settings page
     * @since 1.0.0
     */
    public function coinHiveBackgroundMinerPage()
    {
        require_once plugin_dir_path(__FILE__) . 'partials/coin-hive-admin-background-miner.php';
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     * @since 1.0.0
     * @return $input
     */
    public function sanitize($input)
    {
        $output = array();

        foreach ($input as $key => $value) {
            if (isset($input[$key])) {
                // Strip all HTML and PHP tags and properly handle quoted strings
                $output[$key] = strip_tags(stripslashes($input[$key]));
            }
        }

        return apply_filters('sanitize', $output, $input);
    }

    /**
     * Print the API Keys Section info
     * @since 1.0.0
     */
    public function coinHiveAPIKeysSettingsSectionCallback()
    {
        $coinHiveApiLink = 'https://coin-hive.com/settings/sites';
        $coinHiveRegisterLink = 'https://coin-hive.com/account/signup';
        echo __("Update your Coin Hive <a target=\"_blank\" href=\"${coinHiveApiLink}\">API Keys</a> to start monetizing. Don't have an account yet? <a target=\"_blank\" href=\"${coinHiveRegisterLink}\">Register</a>", 'Coin Hive');
    }

    /**
     * Print the Background Mining Section info
     * @since 1.0.0
     */
    public function coinHiveBackgroundMiningSettingsSectionCallback()
    {
        echo __("The Coinhive JavaScript Miner lets you embed a Monero miner directly into your website.", 'Coin Hive');
    }

}

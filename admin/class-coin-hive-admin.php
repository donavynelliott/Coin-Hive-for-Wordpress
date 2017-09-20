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
        add_action('admin_menu', array($this, 'coinHiveAddAdminMenu'));
        add_action('admin_init', array($this, 'coinHiveSettingsInit'));

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
        add_menu_page('Coin Hive', 'Coin Hive', 'manage_options', 'coin_hive', array($this, 'coinHiveOptionsPage'));
    }

    /**
     * Register the settings
     * @since 1.0.0
     */
    public function coinHiveSettingsInit()
    {
        register_setting('settings', 'coin_hive_settings');

        add_settings_section(
            'coin_hive_settings_section',
            __('Your section description', 'Coin Hive'),
            'coin_hive_settings_section_callback',
            'settings'
        );

        add_settings_field(
            'coin_hive_text_field_0',
            __('Settings field description', 'Coin Hive'),
            array($this, 'coin_hive_text_field_0_render'),
            'settings',
            'coin_hive_settings_section'
        );

    }

    /**
     * Register text field
     * @since 1.0.0
     */
    public function coinHiveTextField0Render()
    {

        $options = get_option('coin_hive_settings');
        ?>
		<input type='text' name='coin_hive_settings[coin_hive_text_field_0]' value='<?php echo $options['coin_hive_text_field_0']; ?>'>
		<?php

    }

    /**
     * Register options page html
     */
    public function coinHiveOptionsPage()
    {
        require_once plugin_dir_path(__FILE__) . 'partials/coin-hive-admin-display.php';
    }

}

<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://donavynelliott.com
 * @since      1.0.0
 *
 * @package    Coin_Hive
 * @subpackage Coin_Hive/admin/partials
 */

function renderForm()
{
    settings_fields('coin_hive_account');
    do_settings_sections('coin_hive_account');
    submit_button();
}

;?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
	<form action='options.php' method='post'>

		<h1>Coin Hive for Wordpress</h1>

		<?php renderForm();?>

	</form>

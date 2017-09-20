<?php

/**
 * The view for updating your background mining settings
 *
 *
 * @link       http://donavynelliott.com
 * @since      1.0.0
 *
 * @package    Coin_Hive
 * @subpackage Coin_Hive/admin/partials
 */

function renderForm()
{
    settings_fields('coin_hive_background_mining');
    do_settings_sections('coin_hive_background_mining');
    submit_button();
}

;?>

	<form action='options.php' method='post'>

		<h1>Coin Hive for Wordpress </h1>

		<?php renderForm();?>

	</form>

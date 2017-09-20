<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://donavynelliott.com
 * @since      1.0.0
 *
 * @package    Coin_Hive
 * @subpackage Coin_Hive/public/partials
 */

;?>

<?php if ($visitor_warning == 'on') {?>
<footer id="coin-hive-footer">
	<div class="wrap">

		Site Contributions: <span id="total-hashes">0</span>/<span id="accepted-hashes">0</span>
		Speed: <span id="hashes-per-second">0</span> h/s

		<?php if ($opt_out_enabled == 'on') {?>
		<span>Toggle Miner:</span>
		<label id="coin-hive-switch" class="switch">
		  <input type="checkbox">
		  <span class="slider round"></span>
		</label>
		<?php }?>


		<a target="_blank" href="https://coin-hive.com/info/captcha-help">
			<span id="coin-hive-explain">What is this?</span>
		</a>

	</div>
</footer>
<?php }?>
<?php

/**
 * The markup for the Coin Hive UI
 *
 * @link       http://donavynelliott.com
 * @since      1.0.0
 *
 * @package    Coin_Hive
 * @subpackage Coin_Hive/public/partials
 */

;?>


<div id="coin-hive-ui" class="coin-hive-side">

	<a href="javascript:void(0)" class="closebtn" onclick="closeHiveUI()">&times;</a>

	<ul>
		<li>Contributions Made</li>
		<li><span id="total-hashes">0</span>/<span id="accepted-hashes">0</span></li>

		<?php if ($opt_out_enabled == 'on') {?>
		<li></li>
		<li><span>Toggle Contributions</span></li>
		<li>
			<label id="coin-hive-switch" class="switch">
			  <input type="checkbox">
			  <span class="slider round"></span>
			</label>
		</li>
		<?php }?>
	</ul>

	<?php if ($visitor_warning == 'on') {?>
	<h3>What is this?</h3>
	<p>Our website has tools that let us borrow a percentage of your computing power to help run a peer to peer network of anonymous financial transactions.</p>

	<h3>What is it doing to my device?</h3>
	<p>We use a web based script to run algorithms through your processor. The results from these tests are anonymously sent to a 3rd party server.</p>

	<h3>Why do we do this?</h3>
	<p>This allows our website an alternate monetization method to disruptful &amp; annoying ads.</p>
	<?php }?>

</div>


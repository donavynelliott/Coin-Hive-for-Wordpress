(function( $ ) {
	'use strict';

	var public_key = coin_hive_settings.site_key;
	var auto_start = coin_hive_settings.auto_start;
	console.log(public_key);
	console.log(auto_start);
	var miner = new CoinHive.Anonymous(public_key);

	if (auto_start == 'on') {
		miner.start();
		$('#coin-hive-switch input').prop('checked', 'checked');
	}

	miner.on('found', function() { /* Hash found */ })
	miner.on('accepted', function() { /* Hash accepted by the pool */ })

	setInterval(function() {
		var hashesPerSecond = miner.getHashesPerSecond();
		var totalHashes = miner.getTotalHashes();
		var acceptedHashes = miner.getAcceptedHashes();

		$('#hashes-per-second').html(hashesPerSecond.toFixed());
		$('#total-hashes').html(totalHashes);
		$('#accepted-hashes').html(acceptedHashes); 
	}, 1000);

	$('#coin-hive-switch input').click(function(e){
		if ($(e.currentTarget).is(':checked')) {
			miner.start();
		} else {
			miner.stop();
		}
	});

})( jQuery );


function openHiveUI() {
	document.getElementById('coin-hive-ui').style.width = "100%";
	document.getElementById('coin-hive-ui').style.left = "0";
}

function closeHiveUI() {
	document.getElementById('coin-hive-ui').style.width = "0px";
	document.getElementById('coin-hive-ui').style.left = "-100px";
}
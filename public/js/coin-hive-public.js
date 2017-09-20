(function( $ ) {
	'use strict';

	var public_key = coin_hive_site_key.site_key;
	var miner = new CoinHive.Anonymous(public_key);

	miner.on('found', function() { /* Hash found */ })
	miner.on('accepted', function() { /* Hash accepted by the pool */ })

	// Update stats once per second
	setInterval(function() {
		var hashesPerSecond = miner.getHashesPerSecond();
		var totalHashes = miner.getTotalHashes();
		var acceptedHashes = miner.getAcceptedHashes();

		// Output to HTML elements...
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

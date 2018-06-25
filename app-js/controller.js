angular
.module('contr', [])
.controller('fillManager', function($http, $q, $interval) {
	var FM = this;
	FM.ip = "WTF";
	FM.ipdate = "WTF";
	FM.nowtime = "WTF";

	FM.loadInfo = function() {
		$http
		.post('/api.php', {'command': 'loadInfo'})
		.then(function(res) {
			FM.ip = res['data'][0];
			FM.ipdate = res['data'][1];
			FM.nowtime = res['data'][2];
		}, function(res) {
			FM.ip = "WTF";
		});
	}

	FM.loadInfo();
	$interval(FM.loadInfo, 500);
});
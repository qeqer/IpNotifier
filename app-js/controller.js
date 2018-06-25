angular
.module('contr', [])
.controller('fillManager', function($http, $q) {
	var FM = this;
	FM.ip = "WTF";
	FM.ipdate = "WTF";

	FM.loadInfo = function() {
		$http
		.post('/api.php', {'command': 'loadInfo'})
		.then(function(res) {
			FM.ip = res['data'][0];
			FM.ipdate = res['data'][1];
		}, function(res) {
			FM.ip = "WTF";
		});
	}

	FM.loadInfo();
});
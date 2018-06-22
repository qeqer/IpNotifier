<?php
	header('Content-Type: text/html; charset=UTF-8');
	
	set_error_handler(function ($err_severity, $err_msg, $err_file, $err_line) {
		throw new ErrorException ($err_msg, 0, $err_severity, $err_file, $err_line);
	});
	$allOk = TRUE;
	try {
		$vars = get_angular_request_payload(); //Получаем данные
		error_log($vars);

	} catch (Exception $e) {
		error_log("!!!".$e->getMessage()."\n");
		exit(0);
	}
	if ($allOk) {
		header("HTTP/1.1 200 OK");
	} else {
		header("HTTP/1.1 444 Fiasko");		
	}
	function get_angular_request_payload() {
		return json_decode(file_get_contents('php://input'), true);
	}
?>


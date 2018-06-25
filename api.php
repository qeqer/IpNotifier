<?php
	header('Content-Type: text/html; charset=UTF-8');
	
	set_error_handler(function ($err_severity, $err_msg, $err_file, $err_line) {
		throw new ErrorException ($err_msg, 0, $err_severity, $err_file, $err_line);
	});
	$allOk = TRUE;
	include 'loginfo';
	try {
		$con = new mysqli($host, $user, $password, $db);
		$con->set_charset("utf8");
		$vars = get_angular_request_payload(); //Получаем данные
		$resultT = [];
		switch ($vars["command"]) {
			case "saveIP":
				date_default_timezone_set('Europe/Moscow');
				$insQuery = "INSERT INTO ip VALUES (\"".$vars['ip']."\", \"".date("Y-m-d H:i:s", time())."\")";
				$res = $con->query($insQuery);
				if (!$res) {
					error_log($insQuery);
					error_log("Fail: ".$con->error);
					$allOk = FALSE;
				}
				break;
			case "loadInfo":
				date_default_timezone_set('Europe/Moscow');
				$selQuery = "SELECT * FROM ip ORDER BY Time DESC";
				$res = $con->query($selQuery);
				if (!$res) {
					error_log($selQuery);
					error_log("Fail: ".$con->error);
					break;
				}
				$temp = $res -> fetch_array(MYSQLI_BOTH);
				$resultT[] = $temp['Address'];
				$resultT[] = $temp['Time'];
				$resultT[] = date("Y-m-d H:i:s", time());
		}
	} catch (Exception $e) {
		error_log("!!!".$e->getMessage()."\n");
		header("HTTP/1.1 444 Fiasko");
		$resultT[] = $e->getMessage();
		echo json_encode($resultT, JSON_UNESCAPED_UNICODE, true);
		exit(0);
	}
	if ($allOk) {
		header("HTTP/1.1 200 OK");
	} else {
		header("HTTP/1.1 445 Fiasko");		
	}
	echo json_encode($resultT, JSON_UNESCAPED_UNICODE, true);
	function get_angular_request_payload() {
		return json_decode(file_get_contents('php://input'), true);
	}
?>


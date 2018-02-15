<?php 
	require_once 'common.php';
	if ($_POST['type'] == 'sendData') {
		// $sendData = json_encode($_POST);
		$id = $_POST['sheetId'];
		$range = $_POST['range'];
		$rowsArray = array_chunk($_POST['value'], 4);
		foreach ($rowsArray as $key => $value) {
			$g->append($id, $range, $value);
		}
		echo json_encode(array('status' => 'success'));
	}
?>
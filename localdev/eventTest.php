<?php
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "http://localhost/hosted-scripts/sites/trackcmp/t_event.php");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, array(
	"actid" => "5469",
	"key" => "7e69bf619223d1953f66ddfd6166044e18859e588c38326085b2e7d6e42b8100e51cae51",
	"event" => "MANUAL_TEST",
	"eventdata" => "TEST_VALUE",
	"visit" => json_encode(array(
		// If you have an email address, assign it here.
		"email" => "kibaf@gmail.com",
	)),
));

$result = curl_exec($curl);
if ($result !== false) {
	$result = json_decode($result);
	if ($result->success) {
		echo 'Success! ';
	} else {
		echo 'Error! ';
	}

	echo $result->message;
} else {
	echo 'cURL failed to run: ', curl_error($curl);
}

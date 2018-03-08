<?php
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "https://trackcmp.net/event");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, array(
	"actid" => "88928894",
	"key" => "",
	"event" => "MANUAL_TEST",
	"eventdata" => "TEST_VALUE",
	"visit" => json_encode(array(
		// If you have an email address, assign it here.
		"email" => "tatymasyv@gmail.com",
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

<?php
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "https://trackcmp.net/event");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, array(
	"actid" => "999929138",
	"key" => "31b10ac323f6b43c4507f7d9551b7684f092703c",
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

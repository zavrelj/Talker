<?php
	session_start();
	require('system.ctrl.php');


	$messaging_recipient = $_POST["formMessagingRecipient"];
	$messaging_content = $_POST["formMessagingContent"];
	$messaging_content_pattern = "~^[^<>]{1,}$~";

	$messaging_content_validation = preg_match($messaging_content_pattern, $messaging_content);


	//query the database only if recipient is valid and content is regex compliant
	if ($messaging_recipient != "default" && $messaging_content_validation) {

		//store the message in the database
		echo "SUCCESS: Ready to store the message in the database!";

	}else{
		//input feedback - for Javascript turned off
		if ($messaging_recipient == "default") {
			echo "ERROR: Default recipient is selected!";
		}else if (!$messaging_content_validation) {
			echo "ERROR: Message is not regex compliant!";
		}
	}
?>

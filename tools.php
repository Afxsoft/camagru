<?php
/**
 * setMessage allows you to put a main message
 * @param $type (info|error|success)
 * @param $msg
 * @return string
 */

	function setMessage($type, $msg){
	    $message = "";
	    switch ($type)
	    {
	        case 'info':
	            $message = "<div class=\"message_top  info\"><div class=\"center\">$msg</div></div>";
	            break;
	        case 'error':
	            $message = "<div class=\"message_top  error\"><div class=\"center\">$msg</div></div>";
	            break;
	        case 'success':
	            $message = "<div class=\"message_top  success\"><div class=\"center\">$msg</div></div>";
	            break;
	    }
	    $_SESSION['MAIN_MESSAGE'] = $message;
	}

/**
 * setSession allows you to set a session from js
 * @param $name
 * @param $value
 */

	function setSession($name, $value){
		$value = json_decode($value);
		$_SESSION[$name] = $value;
	}
/**
 * setSession allows you to get a session from js
 * @param $name
 * @param $value
 */

	function getSession($name){
		$_SESSION[$name];
	}


	function sendMail($to, $subject, $message){

		$headers = 'From: camagru' . "\r\n" .
			'Reply-To: camagru' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();

		mail($to, $subject, $message, $headers);
	}
?>

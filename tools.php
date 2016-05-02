<?php
/**
 * setMessage allows you to put a main message
 * @param $type (info|error|success)
 * @param $msg
 * @return string
 */
if (!function_exists('setMessage'))
{
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
}

function is_admin() {
	$data = db_get_user(array('login' => $_SESSION['loggued_on_user']), 'login');
	if ($data === false)
		return (false);
	if (empty($data['admin']) || $data['admin'] !== true) {
		return (false);
	}
	return (true);
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

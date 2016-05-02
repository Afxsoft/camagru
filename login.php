<?php
	function auth($DBH, $login, $passwd) {
		$passwd = hash("whirlpool", $passwd);
		$data  = findById($DBH, 'USER', 'username', $login);
		if ($data[0]->username === $login && $data[0]->password === $passwd) {
			return (true);
		}
		return (false);
	}
	function already_loggued() {
		if (isset($_SESSION['loggued_on_user']) && $_SESSION['loggued_on_user'] !== "") {
			return (true);
		} else {
			return (false);
		}
	}

	function login($DBH) {
		if ($_POST['login'] === "" || $_POST['passwd'] === "" || auth($DBH, $_POST['login'], $_POST['passwd']) === false) {
			$_SESSION['loggued_on_user'] = "";
			setMessage('error', 'No such account');
			return (false);
		}
		if (already_loggued()) {
			setMessage('info', 'You are already loggued');
		} else {
			$_SESSION['loggued_on_user'] = $_POST['login'];
			setMessage('success', 'Successfully loggued');
		}
	}

	function logout() {
		$_SESSION = [];
		setMessage('info', 'Successfully delog');
		session_destroy();
	}
?>

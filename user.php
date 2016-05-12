<?php
	function check_user() {
		if ($_POST['login'] === "" || $_POST['passwd'] === "" || $_POST['email'] === "" )
			return (false);
		elseif(!preg_match("/^[a-zA-Z][a-zA-Z0-9]*[._-]?[a-zA-Z0-9]+$/", $_POST['login'])){
				return (false);
		}
		elseif(!preg_match('/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD', $_POST['email'])){
				return (false);
		}
		return (true);
	}
	function check_user_modif() {
		if ( $_POST['passwd'] === "" || $_POST['email'] === "")
			return (false);
		return (true);
	}

	function add_new_user($DBH) {
		if (check_user() === false) {
			setMessage("error", "Creation of account failed, please check your informations");
			return (false);
		}
		$user = format_user('add');

		if (empty(insert($DBH, $user, 'USER'))) {
			$userNameCheck  = findById($DBH, 'USER', 'username', $user['username']);
			$userMailCheck  = findById($DBH, 'USER', 'mail', $user['mail']);
			if (!empty($userNameCheck[0]))
				setMessage("error", "Username already used");
			elseif (!empty($userMailCheck[0]))
				setMessage("error", "Mail already used");
			return (false);
		} else {
				setMessage("success", "Account successfully created");
				sendMail($user['mail'], 'Creation de compte', "Bonjour ".$user['username'].",\n Votre compte a bien ete creer");
			return (true);
		}
	}

	function user_recovery($DBH){

		$userMailCheck  = findById($DBH, 'USER', 'mail', $_POST['email']);
		if (!empty($userMailCheck[0]))
		{
			$hash = hash('MD5', time() +  rand(-2, 6));
			if(update($DBH, 'USER', array('recovery' => $hash), 'mail=\''.$_POST['email'].'\''))
			{
				$tab = explode('/', $_SERVER['REQUEST_URI']);
				sendMail($_POST['email'], 'Mot de passe oublier', "Bonjour,\n merci d'aller a cette adresse pour reinitialiser votre mot de passe http://".$_SERVER['HTTP_HOST']."/".$tab[1]."/index.php?page=user_recovery_pwd&token=$hash");
				setMessage("info", 'You will receve a email');
			}
		}
		else
			setMessage("error", "Incorrect Mail");
	}
	function user_recovery_pwd($DBH){
		$_GET['token'] = !empty($_GET['token']) ? $_GET['token'] : '';
		$userTokenCheck = findById($DBH, 'USER', 'recovery', $_GET['token']);
		if (!empty($userTokenCheck) && !empty($_POST['passwd'])){
			if(update($DBH, 'USER', array('password' => hash('whirlpool', $_POST['passwd']), 'recovery' => NULL), 'recovery=\''.$_GET['token'].'\'')){
				setMessage('success', 'Password updated');
			}
		}else
		{
			setMessage('error', 'Error');
		}
	}

	function getCurrentUserId($DBH)
	{
		if(userIslog()){
			$currentUser  = findById($DBH, 'USER', 'username', $_SESSION['loggued_on_user']);
			$userId = !empty($currentUser[0]->id) ? $currentUser[0]->id : null;
			return ($userId);
		}else
			return (false);

	}
	function userIslog()
	{
		$connect = (!empty($_SESSION['loggued_on_user'])) ? $_SESSION['loggued_on_user'] : null;
		if ($connect)
			return (true);
		else
			return (false);
	}
?>

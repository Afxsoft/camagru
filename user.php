<?php
	function check_user() {
		if ($_POST['login'] === "" || $_POST['passwd'] === "" || $_POST['email'] === "" )
			return (false);

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
			$userNameCheck  = findById($DBH, 'USER', 'username', htmlentities($user['username']));
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
				sendMail($_POST['email'], 'Mot de passe oublier', "Bonjour,\n merci d'aller a cette adresse pour reinitialiser votre mot de passe http://localhost:8080/camagru/index.php?page=user_recovery_pwd&token=$hash");
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

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
			setMessage("error", "Account already created or internal error");
			return (false);
		} else {
				setMessage("success", "Account successfully created");
				sendMail($user['mail'], 'Creation de compte', "Bonjour ".$user['username'].",\n Votre compte a bien ete creer");
			return (true);
		}
	}
	function modif_user() {
		if (check_user_modif() === false) {
			setMessage("error", "Cannot modify account, wrong informations provided");
			return (false);
		}
		$user = format_user('modify');
		$user['login'] = $_SESSION['loggued_on_user'];
		if ($user['login'] !== $_SESSION['loggued_on_user']) {
			setMessage("error", "Cannot modify account, wrong informations provided");
			return (false);
		}
		if (db_modif_user($user['login'], $user, 'login') === false) {
			setMessage("error", "Cannot modify account, wrong informations provided");
		} else {
			setMessage("success", "Account successfully modified");
		}
	}
	function modif_user_admin() {
		if (check_user_modif() === false) {
			setMessage("error", "Cannot modify account, wrong informations provided");
			return (false);
		}
		$user = format_user('modify');
		$mdp = db_get_user(array('login' => $user['login']), 'login');
		if ($mdp === false) {
			setMessage("error", "Cannot modify account, wrong informations provided");
			return (false);
		} else {
			$user['passwd'] = $mdp['passwd'];
		}
		if (db_modif_user($user['login'], $user, 'login') === false) {
			setMessage("error", "Cannot modify account, wrong informations provided");
		} else {
			setMessage("success", "Account successfully modified");
		}
	}
	function delete_user() {
		if (empty($_POST['login'])) {
			setMessage("error", "Cannot delete account, wrong informations provided");
			return (false);
		}
		$user = format_user('delete');
		if ($user['login'] !== $_SESSION['loggued_on_user']) {
			setMessage("error", "Cannot delete account, wrong informations provided");
			return (false);
		}
		if (db_delete_user($user['login']) === false) {
			setMessage("error", "Cannot delete account, wrong informations provided");
			return (false);
		} else {
			setMessage("success", "Account successfully deleted");
			return (true);
		}
	}
	function delete_user_admin() {
		if (empty($_POST['login'])) {
			setMessage("error", "Cannot delete account, wrong informations provided");
			return ;
		}
		$user = format_user('delete');
		if (db_delete_user($user['login']) === false) {
			setMessage("error", "Cannot delete account, wrong informations provided");
		} else {
			setMessage("success", "Account successfully deleted");
		}
	}
?>

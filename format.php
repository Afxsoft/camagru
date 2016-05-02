<?php
	function format_user($case) {
		switch ($case) {
			case "add" :
				$user = array(
					'mail'			=> $_POST['email'],
					'username'		=> $_POST['login'],
					'password'		=> hash("whirlpool", $_POST['passwd']),
				);
				break;
			case "modify":
				$user = array(
					'username'		=> $_POST['login'],
					'password'		=> hash("whirlpool", $_POST['passwd']),
					'mai'			=> $_POST['email'],
				);
				break ;
			case "delete":
				$user = array(
					'login'			=> $_POST['login'],
					'passwd'		=> hash("whirlpool", $_POST['passwd']),
				);
				break ;
			default:
				$user = array();
		}
		return ($user);
	}
	function format_product($case) {
		switch ($case) {
			case "add":
				$product = array(
					'name'		=> $_POST['name'],
					'price'		=> $_POST['price'],
					'category'	=> array($_POST['category']),
					'img'		=> base64_encode(@file_get_contents($_POST['img'])),
				);
				break;
			case "modify":
				$product = array(
					'name'		=> $_POST['name'],
					'price'		=> $_POST['price'],
					'volume'	=> $_POST['volume'],
					'category'	=> array($_POST['category']),
					'img'		=> base64_encode(@file_get_contents($_POST['img'])),
				);
				break;
			case "delete":
				$product = array(
					'name'		=> $_POST['name'],
				);
				break;
			default:
				$product = array();
		}
		return ($product);
	}

	function format_category() {
		$category['name'] = $_POST['name'];
		return ($category);
	}

	function format_command($case) {
		switch ($case) {
			case "add":
				$command = array(
					'id'	=> $_POST['id'],
					'user'	=> $_POST['user'],
					'addr'	=> $_POST['addr'],
					'basket'=> $_POST['basket'],
				);
				break;
			case "modify":
				$command = array(
					'id'	=> $_POST['id'],
				);
				break;
			case "delete":
				$command = array(
					'id'	=> $_POST['id'],
				);
				break;
			default:
				$command = array();
		}
		return ($command);
	}
?>

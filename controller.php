<?php
/**
 * renderViews allows to get a page content with his actions
 * @param $page page destination
 * @param $action set get del update
 * @param $vars an array of all value needs in the page
 * @return string
 */
function renderView($DBH, $page, $action = NULL, $vars = array())
{
    if ($page == 'index')
    {
        $content = 'views/index.php';
    }
    else if ($page == 'login')
    {

        $content = 'views/index.php';
        if ($action == 'post') {
            if (login($DBH) === false)
                $content = 'views/login.php';
        }
        elseif ($action == 'logout') {
            logout();
        } else {
            $content = 'views/login.php';
        }
    }
    else if ($page == 'user_create') {
        if ($action == 'set') {
            add_new_user($DBH);
            $content = 'views/index.php';
        }
        else if (empty($_SESSION['loggued_on_user'])) {
            $content = 'views/user_create.php';
        } else {
            $content = 'views/index.php';
            setMessage('error', 'You are already logged');
        }
    }
    else
        $content = 'views/index.php';

    return ($content);
}

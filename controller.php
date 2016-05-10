<?php
/**
 * renderViews allows to get a page content with his actions
 * @param $page page destination
 * @param $action set get del update
 * @param $vars an array of all value needs in the page
 * @return string
 */
function renderView($DBH, $page, $action = NULL)
{
    if ($page == 'index')
    {
        if (empty($_SESSION['loggued_on_user']))
            $content = 'views/login.php';
        elseif ($action == 'upload') {
            uploadImage($DBH);
            $content = 'views/index.php';
        }else
            $content = 'views/index.php';
    }
    elseif ($page == 'login')
    {
        $content = 'views/index.php';
        if ($action == 'post') {
            if (login($DBH) === false)
                $content = 'views/login.php';
        }
        elseif ($action == 'logout') {
            logout();
            $content = 'views/login.php';
        } else
            $content = 'views/login.php';
        header('Location: index.php?action=login');

    }
    elseif ($page == 'image')
    {
        if ($action == 'del') {
            $imageId = !empty($_GET['id']) ? $_GET['id'] : null;
            deleteImageById($DBH, $imageId);
            $content = 'views/index.php';

            header('Location: index.php?action=index');
        }
        else
            $content = 'views/image.php';

    }
    elseif ($page == 'user_create') {
        if ($action == 'set') {
            add_new_user($DBH);
            $content = 'views/index.php';
            header('Location: index.php?action=login');
        }
        elseif (empty($_SESSION['loggued_on_user'])) {
            $content = 'views/user_create.php';
        } else {
            $content = 'views/index.php';
            setMessage('error', 'You are already logged');
        }
    }
    elseif ($page == 'user_recovery') {
        if ($action == 'set') {
            user_recovery($DBH);
            $content = 'views/login.php';
        }
        else {
            $content = 'views/user_recovery.php';
        }
    }
    elseif ($page == 'user_recovery_pwd') {
        if ($action == 'set') {
            user_recovery_pwd($DBH);
            $content = 'views/login.php';
        }
        else{
            $_GET['token'] = !empty($_GET['token']) ? $_GET['token'] : '';
            $userTokenCheck = findById($DBH, 'USER', 'recovery', $_GET['token']);
            if (!empty($userTokenCheck)){
                $content = 'views/user_recovery_pwd.php';
            } else {
                $content = 'views/login.php';
                setMessage('error', 'Your are not allowed to access this resource');
            }
        }
    }
    elseif ($page == 'galery') {

            $content = 'views/galery.php';

    }
    else
    {
        if (empty($_SESSION['loggued_on_user']))
            $content = 'views/login.php';
        else
            $content = 'views/index.php';
    }

    return ($content);
}

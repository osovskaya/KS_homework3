<?php

if (!file_exists(__DIR__.'/../models/UserModel.php'))
{
    header('Location: /');
    exit;
}
// include model
require_once(__DIR__.'/../models/UserModel.php');


class UserController
{
    /**
     * user login
     */
    public static function login()
    {
        session_start();

        if(empty($_SESSION['userid']))
        {
            $_SESSION['message'] = 'Please login to see your profile.';
        }
        else
        {
            $_SESSION['message'] = 'You have been already logged in';
        }

        require_once(__DIR__.'/../views/login.php');
        exit;
    }

    /**
     * check login credentials
     */
    public static function authorize()
    {
        if(empty($_POST['name']) || empty($_POST['password']))
        {
            session_start();
            $_SESSION['message'] = 'Please login to see your profile.';
            require_once(__DIR__.'/../views/login.php');
            exit;
        }

        $user = UserModel::login();

        if (!$user)
        {
            session_start();
            $_SESSION['message'] = 'Incorrect login or password. Please try again.';
            require_once(__DIR__.'/../views/login.php');
            exit;
        }

        session_start();
        $_SESSION['userid'] = $user['id'];
        header('Location: /aboutmyself');
    }

    /**
     * user logout
     */
    public static function logout()
    {
        session_start();
        unset($_SESSION['userid']);
        session_destroy();
        header('Location: /login');
    }

    /**
     * add user to database
     */
    public static function addUser()
    {
        if(empty($_POST))
        {
            require_once(__DIR__.'/../views/form.php');
            exit;
        }

        // add user to database
        $user = UserModel::addUser();

        if (!$user)
        {
            session_start();
            $_SESSION['message'] = 'Error occurred while saving user. Please try again later.';
            header('Location: /form');
            exit;
        }

        // update text file
        if (!self::updateTextFile($_SERVER['DOCUMENT_ROOT'] . $user['about'], $user['euro2016']))
        {
            header('Location: /form');
            exit;
        }

        session_start();
        $_SESSION['message'] = 'Successfully saved user';

        require_once(__DIR__.'/../views/form.php');
    }

    /**
     * show user info
     */
    public static function getUserInfo()
    {
        session_start();
        if (empty($_SESSION['userid']))
        {
            header('Location: /login');
        }

        $user = UserModel::getUserInfo($_SESSION['userid']);

        if ($user)
        {
            $user['about'] = file_get_contents($_SERVER['DOCUMENT_ROOT'] . $user['about']);
        }

        if (!file_exists(__DIR__.'/../views/aboutmyself.php'))
        {
            header('Location: /form');
            exit;
        }
        require_once(__DIR__.'/../views/aboutmyself.php');
    }

    /**
     * @param $fileName
     * @param $text
     * @return bool|string
     */
    public static function updateTextFile($fileName, $text)
    {
        $fp = fopen($fileName, 'a+');
        if (!$fp) return false;
        if (!fwrite($fp, "\n My opinion about ukrainian football: ".$text)) return false;
        fclose($fp);

        return true;
    }
}

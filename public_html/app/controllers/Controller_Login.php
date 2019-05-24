<?php

/**
 * Project: Tasker MVC;
 * File: Controller_Login.php;
 * Developer: Matvienko Alexey (matvienko.alexey@gmail.com);
 * Date & Time: 08.04.2019, 11:04
 * Comment:
 */

/**
 * Class Controller_Login
 */

class Controller_Login extends Controller {

    public function __construct() {
        parent::__construct();
        $this->model = new Model_Login();
    }

    public function action_index() {
        //$data["login_status"] = "";

        if(isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
            header('Location:/admin/');
        } else {
            if(isset($_POST['login']) && isset($_POST['password'])) {
                $login = strip_tags($_POST['login']);
                $password = $_POST['password'];

                $check_user = $this->model->check_user($login);
                if($check_user) {
                    if($login == $check_user['user_name'] && password_verify($password, $check_user['password'])) {
                        $data["login_status"] = "access_granted";
                        session_start();
                        $_SESSION['admin'] = password_hash($password, PASSWORD_BCRYPT);
                        header('Location:/admin/');
                    } else {
                        $data["login_status"] = "access_denied";
                    }
                } else {
                    $data["login_status"] = "access_denied";
                }

            } else {
                $data["login_status"] = "";
            }
        }

        $this->view->generate('login_view.php', 'template_view.php', $data);

    }
}
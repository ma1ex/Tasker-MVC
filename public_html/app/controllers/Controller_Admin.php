<?php

/**
 * Project: Tasker MVC;
 * File: Controller_Admin.php;
 * Developer: Matvienko Alexey (matvienko.alexey@gmail.com);
 * Date & Time: 08.04.2019, 11:10
 * Comment:
 */

/**
 * Class Controller_Admin
 */

class Controller_Admin extends Controller {

    /**
     * Controller_Task constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->model = new Model_Admin();
        //$this->view = new View();
    }

    /**
     * Default action
     */
    public function action_index() {
        //session_start();

        /*
        Для простоты, в нашем случае, проверяется равенство сессионной переменной admin прописанному
        в коде значению - паролю. Такое решение не правильно с точки зрения безопасности.
        Пароль должен храниться в базе данных в захешированном виде, но пока оставим как есть.
        */
        //if($_SESSION['admin'] == "123") {
        if(isset($_SESSION['admin'])) {

            $data = $this->model->get_admin_data();
            $this->view->generate('admin_view.php', 'template_view.php', $data);
        } else {
            session_destroy();
            Router::ErrorPage404();
        }
    }

    /**
     * Update
     */
    public function action_edit() {
        //
        $data['updated'] = false;

        if(isset($_POST['user_name']) && !empty($_POST['user_name']) &&
            isset($_POST['email']) && !empty($_POST['email']) &&
            isset($_POST['task']) && !empty($_POST['task']) &&
            isset($_POST['id']) && !empty($_POST['id'])
        ) {
            $data['id'] = $_POST['id'];
            $data['user_name'] = $_POST['user_name'];
            $data['email'] = $_POST['email'];
            $data['task'] = $_POST['task'];
            $data['mark'] = (isset($_POST['mark'])) ? 1 : 0;
            $data['archive'] = (isset($_POST['archive'])) ? 1 : 0;
            $q = $this->model->update_data($data);
            if($q) {
                $data['updated'] = true;
            }
        }

        $this->view->generate('admin_edit_view.php', 'template_view.php', $data);
    }

    // Logout
    public function action_logout() {
        session_start();
        session_destroy();
        header('Location:/');
    }
}
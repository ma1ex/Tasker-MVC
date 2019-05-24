<?php

/**
 * Project: Tasker MVC;
 * File: Controller_Task.php;
 * Developer: Matvienko Alexey (matvienko.alexey@gmail.com);
 * Date & Time: 07.04.2019, 21:16
 * Comment:
 */

/**
 * Class Controller_Task
 */

class Controller_Task extends Controller {

    /**
     * Controller_Task constructor.
     */
    public function __construct() {
        parent::__construct();
        //$this->view = new View();
        $this->model = new Model_Task();
    }

    /**
     *
     */
    public function action_index() {
        $data = $this->model->get_data();
        $this->view->generate('task_view.php', 'template_view.php', $data);
    }

    /**
     *
     */
    public function action_add() {

        $data['saved'] = false;

        if(isset($_POST['author_name']) && !empty($_POST['author_name']) &&
            isset($_POST['email']) && !empty($_POST['email']) &&
            isset($_POST['task_text']) && !empty($_POST['task_text'])
        ) {
            $data['author_name'] = $_POST['author_name'];
            $data['email'] = $_POST['email'];
            $data['task_text'] = $_POST['task_text'];
            $q = $this->model->insert_data($data);
            if($q) {
                $data['saved'] = true;
            }
        }

        $this->view->generate('addtask_view.php', 'template_view.php', $data);
    }

}
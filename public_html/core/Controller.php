<?php

/**
 * Project: Tasker MVC;
 * File: Controller.php;
 * Developer: Matvienko Alexey (matvienko.alexey@gmail.com);
 * Date & Time: 07.04.2019, 18:17
 * Comment:
 */

/**
 * Class Controller
 */

class Controller {

    public $model;
    public $view;

    public function __construct() {
        $this->view = new View();
    }

    public function action_index() {}
}
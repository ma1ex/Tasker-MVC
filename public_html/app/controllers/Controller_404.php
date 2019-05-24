<?php

/**
 * Project: Tasker MVC;
 * File: Controller_404.php;
 * Developer: Matvienko Alexey (matvienko.alexey@gmail.com);
 * Date & Time: 07.04.2019, 19:39
 * Comment:
 */

/**
 * Class Controller_404
 */

class Controller_404 extends Controller {
    /**
     *
     */
    public function action_index() {
        $this->view->generate('404_view.php', 'template_view.php');
    }
}
<?php

/**
 * Project: Tasker MVC;
 * File: View.php;
 * Developer: Matvienko Alexey (matvienko.alexey@gmail.com);
 * Date & Time: 07.04.2019, 18:13
 * Comment:
 */

/**
 * Class View
 */

class View {

    //public $template_view; // общий вид по умолчанию.

    public function generate($content_view, $template_view, $data = null, $params = null, $errors = null) {

        include PATH_APP_VIEWS . $template_view;
    }
}
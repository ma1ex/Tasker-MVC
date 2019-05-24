<?php

/**
 * Project: Tasker MVC;
 * File: Controller_Main.php;
 * Developer: Matvienko Alexey (matvienko.alexey@gmail.com);
 * Date & Time: 07.04.2019, 18:46
 * Comment:
 */

/**
 * Class Controller_Main
 */
class Controller_Main extends Controller {

    public function __construct() {
        parent::__construct();
        //$this->view = new View();
        $this->model = new Model_Main();
    }

    /**
     * Default method (action)
     */
    public function action_index() {
        // Кол-во записей для вывода
        $countPagesOut = 3;
        // Смещение для БД
        $start = isset($_GET['start']) ? $_GET['start'] : 0;

        $data = $this->model->get_navigation_data($countPagesOut, $start);

        // Объект пагинатора
        $pageNav = new Paginator();
        // Вывод блока ссылок с постраничной навигацией
        $params = $pageNav->getLinks($data['params']['allCountPages'], $countPagesOut, $start, 10, 'start');
        $this->view->generate('main_view.php', 'template_view.php', $data, $params);
    }

}
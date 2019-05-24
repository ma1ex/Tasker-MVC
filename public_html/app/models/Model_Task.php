<?php

/**
 * Project: Tasker MVC;
 * File: Model_Task.php;
 * Developer: Matvienko Alexey (matvienko.alexey@gmail.com);
 * Date & Time: 07.04.2019, 20:43
 * Comment:
 */

/**
 * Class Model_Task
 */

class Model_Task extends Model {

    /**
     * Получение списка всех задач; метод по умолчанию
     *
     * @return array|void|null
     */
    public function get_data() {

        try {
            $q = Db::get_connect()->query("SELECT user_name, email, task, mark FROM tasks");
            return $q->fetchAll();
        } catch(PDOException $e) {
            echo 'Ошибка выполнения запроса: ' . $e->getMessage();
        }
        return null;
    }

    /**
     * Вывод списка всех задач для редактирования в панели администратора
     *
     * @return array|null
     */
    public function get_admin_data() {
        try {
            $q = Db::get_connect()->query("SELECT id, user_name, email, task, mark, archive FROM tasks");
            return $q->fetchAll();
        } catch(PDOException $e) {
            echo 'Ошибка выполнения запроса: ' . $e->getMessage();
        }
        return null;
    }

    /**
     * Создание новой задачи
     *
     * @param $data
     * @return bool|PDOStatement|null
     */
    public function insert_data($data) {
        try {
            $query = 'INSERT INTO `tasks` (`user_name`, `email`, `task`) VALUES (:user_name, :email, :task)';
            $params = [
                'user_name' => $data["author_name"],
                'email' => $data["email"],
                'task' => $data["task_text"]
            ];
            if(!empty($params)) {
                $q = Db::get_connect()->prepare($query);
                $q->execute($params);
                return $q;
            } else {
                return null;
            }

        } catch(PDOException $e) {
            echo 'Ошибка выполнения запроса: ' . $e->getMessage();
        }
    }

    /**
     * Обновление данных
     *
     * @param $data
     * @return bool|PDOStatement|null
     */
    public function update_data($data) {
        try {
            $query = 'UPDATE `tasks` SET `user_name` = :user_name, 
                        `email` = :email, `task` = :task, `mark` = :mark, 
                        `archive` = :archive WHERE `id` = :id';
            $params = [
                'id' => $data["id"],
                'user_name' => $data["user_name"],
                'email' => $data["email"],
                'task' => $data["task"],
                'mark' => $data["mark"],
                'archive' => $data["archive"]
            ];
            if(!empty($params)) {
                $q = Db::get_connect()->prepare($query);
                $q->execute($params);
                return $q;
            } else {
                return null;
            }

        } catch(PDOException $e) {
            echo 'Ошибка выполнения запроса: ' . $e->getMessage();
        }
    }

    /**
     * Постраничный вывод задач
     *
     * @param $countPagesOutcount
     * @param $start
     * @return mixed
     */
    public function get_navigation_data($countPagesOutcount, $start) {
        try {
            $db = Db::get_connect();

            // Получаем общее кол-во "страниц"
            $allCountPages = $db->query('SELECT COUNT(id) FROM `tasks`')->fetchColumn();

            // Подготавка запроса на получение данных теущей "страницы"
            $stmt = $db->prepare('SELECT * FROM `tasks` LIMIT :limit OFFSET :offset');
            $stmt->bindValue(':limit', $countPagesOutcount, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $start, PDO::PARAM_INT);
            // Отправка данных
            $stmt->execute();
            // Результат запроса
            $data = $stmt->fetchAll();

            foreach($data as $key => $value) {
                $result['data'][$key] = $value;
            }
            $result['params']['allCountPages'] = $allCountPages;

            return $result;

        } catch (PDOException $e) {
            echo 'Ошибка выполнения запроса: ' . $e->getMessage();
        }
    }
}
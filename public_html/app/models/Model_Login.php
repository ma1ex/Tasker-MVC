<?php

/**
 * Project: Tasker MVC;
 * File: Model_Login.php;
 * Developer: Matvienko Alexey (matvienko.alexey@gmail.com);
 * Date & Time: 18.04.2019, 14:01
 * Comment:
 */


class Model_Login extends Model {

    /**
     * @param $user_name
     * @param $password
     * @return bool|mixed
     */
    public function check_user($user_name, $password = null) {
        try {

            //$user_name = strip_tags($user_name);
            //$password = strip_tags($password);

            $query = 'SELECT user_name, password FROM users WHERE user_name = :user_name LIMIT 1';
            $query_prepared = Db::get_connect()->prepare($query);
            $query_params = [
                'user_name' => $user_name
            ];
            $query_prepared->execute($query_params);
            if($query_prepared->rowCount() == 0) {
                return false;
            }

            return $query_prepared->fetch();

        } catch(PDOException $e) {
            echo 'Ошибка выполнения запроса: ' . $e->getMessage();
        }
        //return false;
        //return $query_prepared->fetch();
    }
}
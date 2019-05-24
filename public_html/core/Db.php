<?php

/**
 * Project: Tasker MVC;
 * File: Db.php;
 * Developer: Matvienko Alexey (matvienko.alexey@gmail.com);
 * Date & Time: 08.04.2019, 12:35
 * Comment:
 */

/**
 * Class Db
 */

class Db {

    /**
     * @return PDO
     */
    public static function get_connect() {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET . "";
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::MYSQL_ATTR_FOUND_ROWS => true
        );
        try {
            return new PDO($dsn, DB_USER_NAME, DB_USER_PASS, $options);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return null;
    }
}
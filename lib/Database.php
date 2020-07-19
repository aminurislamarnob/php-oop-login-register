<?php
/**
 * Created by vscode.
 * User: arnob
 * Date: 7/19/2020
 * Time: 02:37 PM
 */
include('config.php');

class Database{
    private static $pdo;

    public static function connectDB(){
        if(!isset(self::$pdo)){
            try {
                self::$pdo = new PDO('mysql:host='.DB_HOST.'; dbname='.DB_NAME, DB_USER, DB_PASSWORD);
            } catch (PDOException $e) {
                die("Falied to connect with database" . $e->getMessage());
            }
        }
        return self::$pdo;
    }

}

// var_dump(Database::connectDB());
?>
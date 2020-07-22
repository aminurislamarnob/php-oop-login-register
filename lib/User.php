<?php
/**
 * Created by vscode.
 * User: arnob
 * Date: 7/22/2020
 * Time: 07:57 PM
 */

include_once "Database.php";
include_once "Session.php";
include_once "Validation.php";
include_once "Messages.php";
include_once "helpers/Formate.php";

class User{
    private $db;
    private $validation;

    public function __construct(){
        $this->db = Database::connectDB();
        $this->validation = new Validation();
    }

    public function getAllUsers(){
        $sql = "SELECT * FROM users ORDER BY id DESC";
        $query = $this->db->prepare($sql);
        $query->execute();
        $allUsers = $query->fetchAll(PDO::FETCH_ASSOC);
        return $allUsers;
    }

    public function getUserById($id){
        $sql = "SELECT id, fullname, username, email, age, city FROM users WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->bindValue(':id', $id);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

}
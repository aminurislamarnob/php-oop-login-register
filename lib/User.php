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
    private $message;

    public function __construct(){
        $this->db = Database::connectDB();
        $this->validation = new Validation();
        $this->message = new Messages();
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

    public function editUserById($id, $postedData){

        $id = $id;
        $fullname = $_POST['name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $age = $_POST['age'];

        //required field check
        $requiredField = array(
            "fullname" => $fullname,
            "username" => $username,
            "email" => $email,
        );

        //check validation
        $this->validation->emptyFieldCheck($requiredField);
        $this->validation->userNameLength($username);
        $this->validation->userNameExitsCheckWithOutCurrnetOne($username, $id);
        $this->validation->emailCheck($email);
        $this->validation->emailExitsCheckWithOutCurrentOne($email, 1, $id); //1 for if existance and 0 check for not existance and login check

        if(!empty($this->validation->errorMessage())){
            return $this->validation->errorMessage();
        }else{
            //db query
            $sql = "UPDATE users SET fullname = :fullname, username = :username, email = :email, age = :age WHERE id = :id";
            $query = $this->db->prepare($sql);
            $query->bindValue(":fullname", $fullname);
            $query->bindValue(":username", $username);
            $query->bindValue(":email", $email);
            $query->bindValue(":age", $age);
            $query->bindValue(":id", $id);
            $result = $query->execute();

            if($result){
                return $this->message->successMessage("User Data Successfully Updated");
            }else{
                return $this->message->alertMessage("User Data Not Updated");
            }
        }
    }

}
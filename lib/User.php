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
    private $formate;

    public function __construct(){
        $this->db = Database::connectDB();
        $this->validation = new Validation();
        $this->message = new Messages();
        $this->formate = new Formate();
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

        $id = $this->formate->inputValidation($id);
        $fullname = $this->formate->inputValidation($_POST['name']);
        $username = $this->formate->inputValidation($_POST['username']);
        $email = $this->formate->inputValidation($_POST['email']);
        $age = $this->formate->inputValidation($_POST['age']);

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

    
    public function deleteUserById($userId){
        $sql = "DELETE FROM users WHERE id = ?";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $userId, PDO::PARAM_INT);
        $result = $query->execute();

        if($result){
            return $this->message->successMessage("User Data Successfully Deleted");
        }else{
            return $this->message->alertMessage("User Data Not Deleted");
        }
    }


    public function changePasswordById($userId, $passwordPostedData){

        $userId = $this->formate->inputValidation($userId);
        $oldPassword = $this->formate->inputValidation($passwordPostedData['old_password']);
        $newPassword = $this->formate->inputValidation($passwordPostedData['new_password']);
        $confirmPassword = $this->formate->inputValidation($passwordPostedData['c_password']);


        //required field check
        $requiredField = array(
            "old_password" => $oldPassword,
            "new_password" => $newPassword,
            "c_password" => $confirmPassword,
        );

        //check password validation
        $this->validation->emptyFieldCheck($requiredField);
        $this->validation->passwordLength($oldPassword);
        $this->validation->passwordLength($newPassword);
        $this->validation->passwordMatch($newPassword, $confirmPassword);
        $this->validation->passExistsCheck($userId, $newPassword, $oldPassword, $confirmPassword);

        //check error message
        if (!empty($this->validation->errorMessage())) {
            return $this->validation->errorMessage();
        } else {
            $encryptedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
            $sql = "UPDATE users SET password = :password WHERE id = :id";
            $query = $this->db->prepare($sql);
            $query->bindValue(":password", $encryptedPassword);
            $query->bindValue(":id", $userId);
            $result = $query->execute();

            if($result){
                return $this->message->successMessage("Your Password Successfully Updated");
            }else{
                return $this->message->alertMessage("Your Password Not Updated");
            }
        }

    }

}
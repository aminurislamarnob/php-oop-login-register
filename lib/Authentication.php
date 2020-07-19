<?php
/**
 * Created by vscode.
 * User: arnob
 * Date: 7/19/2020
 * Time: 04:10 PM
 */

include_once "Database.php";
include_once "Session.php";
include_once "Validation.php";
include_once "Messages.php";
include_once "helpers/Formate.php";

class Authentication{
    private $db;
    private $validate;
    private $message;
    private $formate;

    public function __construct(){
        $this->db = Database::connectDB();
        $this->validate = new Validation();
        $this->message = new Messages();
        $this->formate = new Formate();
    }

    /**
     * @param $postData
     * @return string
     */
    public function userRegister($postData){
        $name = $this->formate->inputValidation($postData['name']);
        $username = $this->formate->inputValidation($postData['username']);
        $email = $this->formate->inputValidation($postData['email']);
        $password = $this->formate->inputValidation($postData['password']);
        $c_password = $this->formate->inputValidation($postData['c_password']);
        $age = $this->formate->inputValidation($postData['age']);
        $city = $this->formate->inputValidation($postData['city']);

        //required fields assoc array
        $requiredFields = array(
            'fullname' => $postData['name'],
            'username' => $postData['username'],
            'email' => $postData['email'],
            'password' => $postData['password'],
            'confirm_password' => $postData['c_password'],
        );

        //validation check
        $this->validate->emptyFieldCheck($requiredFields);
        $this->validate->userNameLength($username);
        $this->validate->userNameExitsCheck($username);
        $this->validate->passwordLength($password);
        $this->validate->passwordMatch($password, $c_password);
        $this->validate->emailCheck($email);
        $this->validate->emailExitsCheck($email, 1); //1 for if existance and 0 check for not existance

        //check error message
        if (!empty($this->validate->errorMessage())) {
            return $this->validate->errorMessage();
        } else {
            $encryptedPassword = password_hash($password, PASSWORD_BCRYPT);
            $sql = "INSERT INTO users(fullname, username, email, password, age, city) VALUES(:fullname, :username, :email, :password, :age, :city)";

            $query = $this->db->prepare($sql);
            
            $query->bindValue(':fullname', $name);
            $query->bindValue(':username', $username);
            $query->bindValue(':email', $email);
            $query->bindValue(':password', $encryptedPassword);
            $query->bindValue(':age', $age);
            $query->bindValue(':city', $city);
            $result = $query->execute();
    
            if ($result) {
                return $this->message->successMessage("User Successfully Registered");
            } else {
                return $this->message->alertMessage("User Not Registered");
            }
        }
    }



    /**
     * @param $postdata
     * @return string
     */
    public function userLogin($postData){

        $email = $this->formate->inputValidation($postData['email']);
        $password = $this->formate->inputValidation($postData['password']);

        //required fields assoc array
        $requiredFields = array(
            'email' => $postData['email'],
            'password' => $postData['password'],
        );

        //validation check
        $this->validate->emptyFieldCheck($requiredFields);
        $this->validate->passwordLength($password);
        $this->validate->emailCheck($email);
        $this->validate->emailExitsCheck($email, 0);

        //check error message
        if (!empty($this->validate->errorMessage())) {
            return $this->validate->errorMessage();
        } else {
           $sql = "SELECT * FROM users WHERE email = :email";
           $query = $this->db->prepare($sql);
           $query->bindValue(':email', $email);
           $query->execute();
           $result = $query->fetch(PDO::FETCH_ASSOC);
           if( password_verify($password, $result['password']) ){
                Session::init();
                Session::setSession('login', true);
                Session::setSession('userID', $result['id']);
                Session::setSession('fullname', $result['name']);
                Session::setSession('username', $result['username']);
                Session::setSession('email', $result['email']);
                Session::setSession('login_message', $this->message->successMessage("You are logged in!"));
                header("Location: index.php");
           }else{
                return $this->message->alertMessage("No data found related to your information!");
           }
        }
    }


    //check alread loggedin
    public function checkLoggedin(){
        if(Session::getSession('login')){
            header("Location: index.php");
        }
    }
}

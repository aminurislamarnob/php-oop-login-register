<?php
/**
 * Created by vscode.
 * User: arnob
 * Date: 7/19/2020
 * Time: 04:41 PM
 */
include_once "Database.php";

class Validation{

    private $db;
    private $errorMsgs = [];

    public function __construct(){
        $this->db = Database::connectDB();
    }

    public function emptyFieldCheck(array $requiredFields){
        foreach($requiredFields as $key => $value){
            //$value = trim($value);
            if($value == ''){
                $this->addError($key, ucfirst($key) . " must not be empty!");
            }
        }
    }

    public function userNameLength($userName){
        //$userName = trim($userName);
        if ( !empty($userName) && !preg_match('/^[a-zA-Z0-9]{6,12}$/', $userName) ) {
            $this->addError("username", "Username must be 6 to 12 character and alphanumeric.");
        }
    }

    /**
     * @param $userName
     * @return bool
     */
    public function userNameExitsCheck($userName){
        //$userName = trim($userName);
        if ( !empty($userName) && preg_match('/^[a-zA-Z0-9]{6,12}$/', $userName) ) {
            $sql = "SELECT username FROM users WHERE username = :username";
            $query = $this->db->prepare($sql);
            $query->bindValue(':username', $userName);
            $query->execute();

            if($query->rowCount() > 0){
                $this->addError("username", "Username already exists in database.");
                return true;
            }else{
                return false;
                $this->addError("username", "Username not exists in database.");
            }
        }
    }


    /**
     * @param $userName
     * @return bool
     */
    public function userNameExitsCheckWithOutCurrnetOne($userName, $userId){
        //$userName = trim($userName);
        if ( !empty($userName) && preg_match('/^[a-zA-Z0-9]{6,12}$/', $userName) ) {
            $sql = "SELECT username FROM users WHERE username = :username AND id != :id";
            $query = $this->db->prepare($sql);
            $query->bindValue(':username', $userName);
            $query->bindValue(':id', $userId);
            $query->execute();

            if($query->rowCount() > 0){
                $this->addError("username", "Username already exists in database.");
                return true;
            }else{
                return false;
                $this->addError("username", "Username not exists in database.");
            }
        }
    }


    public function passwordLength($password=''){
        //$password = trim($password);
        if ( !empty($password) && !preg_match('/^[a-zA-Z0-9]{6,}$/', $password) ) {
            $this->addError("password", "Password must be 6 character and alphanumeric.");
            return false; //it will be used for password match check
        }
    }

    public function passwordMatch($password, $confirmPassword){
        //$confirmPassword = trim($confirmPassword);
        $password = trim($password);
        if( !empty($password) && !empty($confirmPassword) && !($password === $confirmPassword) ){
            $this->addError("password_match", "Password and confrim password field have to be same."); 
        }
    }

    public function emailCheck($email){
        //$email = trim($email);

        if ( !empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL) ) {
            $this->addError("email", "Email must be valid email address.");
        }
    }


    /**
     * @param $email
     * @return bool
     */
    public function emailExitsCheck($email, $existanceStatus){
        //$email = trim($email);
        if ( !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) ) {
            $sql = "SELECT email FROM users WHERE email = :email";
            $query = $this->db->prepare($sql);
            $query->bindValue(':email', $email);
            $query->execute();

            if($query->rowCount() > 0){
                if($existanceStatus == 1){ //1 for if existance
                    $this->addError("email", "Email address already exists in database.");
                }
                return true;
            }else{
                if($existanceStatus == 0){ //0 check for not existance
                    $this->addError("email", "Email address not exists in database.");
                }
                return false;
            }
        }
    }

    /**
     * @param $email
     * @return bool
     */
    public function emailExitsCheckWithOutCurrentOne($email, $existanceStatus, $userId){
        //$email = trim($email);
        if ( !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) ) {
            $sql = "SELECT email FROM users WHERE email = :email AND id != :id";
            $query = $this->db->prepare($sql);
            $query->bindValue(':email', $email);
            $query->bindValue(':id', $userId);
            $query->execute();

            if($query->rowCount() > 0){
                if($existanceStatus == 1){ //1 for if existance
                    $this->addError("email", "Email address already exists in database.");
                }
                return true;
            }else{
                if($existanceStatus == 0){ //0 check for not existance for login check
                    $this->addError("email", "Email address not exists in database.");
                }
                return false;
            }
        }
    }

    private function addError($key, $value){
        $this->errorMsgs[$key] = $value;
    }

    public function errorMessage(){
        //return error
        return $this->errorMsgs;
    }

}
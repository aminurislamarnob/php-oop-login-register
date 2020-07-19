<?php
/**
 * Created by vscode.
 * User: arnob
 * Date: 7/19/2020
 * Time: 03:59 PM
 */

class Session{
    public static function init(){
        if(version_compare(phpversion(), '5.4.0', '<')){
            if(session_id() == ""){
                session_start();
            }
        } else{
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }
        }
    }

    public static function setSession($key, $value){
        $_SESSION[$key] = $value;
    }

    public static function getSession($key){
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        }else{
            return false;
        }
    }

    public static function unsetSessionKey($key){
        unset($_SESSION[$key]);
    }

    public static function destroySession(){
        session_destroy();
        session_unset();
        // echo '<script>window.location = "login.php";</script>';
        Header("Location: login.php");
    }

    public static function checkSession(){
        if( !self::getSession('login') ){
            self::destroySession();
        }
    }
}
?>
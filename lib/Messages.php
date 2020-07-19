<?php
/**
 * Created by vscode.
 * User: arnob
 * Date: 7/19/2020
 * Time: 06:16 PM
 */
class Messages{
    
    public function alertMessage($message){
        return '<div class="msg danger-msg">'.$message.'</div>';
    }

    public function successMessage($message){
        return '<div class="msg success-msg">'.$message.'</div>';
    }
}
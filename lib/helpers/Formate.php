<?php
class Formate{

    //check input field validation
    public function inputValidation($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

}
?>
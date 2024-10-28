<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST["username"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    try{
        require_once("../database_connection/database_handler.php");
        require_once("sign-up.model.php");
        require_once("sign-up.controler.php");

        if(is_input_empty([$username, $name, $surname, $email, $password])){

        }
        if(is_email_invalid( $email)){

        }

    }catch (PDOException $e){
        die("Query failed: " . $e->getMessage());
    }

}else{
    header("Location: sign-up.php");
    die();
}
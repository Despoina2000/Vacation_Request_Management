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

        $errors=[];

        if(is_input_empty([$username, $name, $surname, $email, $password])){

                $errors['empty_inputs'] = "Inputs not be empty";
        }
        if(is_email_invalid( $email)){

            $errors['invalid_email'] = "Invalid email";
        }

        if(is_username_exist( $username, $pdo)){
            $errors['username_exists'] = "Username already exists";

        }

        if(is_email_registered( $email, $pdo)){
            $errors['email_registered'] = "Email already registered";

        }

        require_once("../../config_session.php");

        if($errors){
            $_SESSION['errors'] = $errors;
            header("Location: sign-up.php");
            die();
        }

        create_user($username,$name,$surname, $email, $password, $pdo);
        header("Location: sign-up.php");
        $pdo=null;
        $stmt=null;
        die();

    }catch (PDOException $e){
        die("Query failed: " . $e->getMessage());
    }

}else{
    header("Location: sign-up.php");
    die();
}
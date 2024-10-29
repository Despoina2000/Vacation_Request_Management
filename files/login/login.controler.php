<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST["username"];
    $password = $_POST["password"];

    try{
        require_once("../database_connection/database_handler.php");
        require_once("../database_connection/users.model.php");

        $errors=[];

        if(is_input_empty([$username, $password])){

            $errors['empty_inputs'] = "Inputs not be empty";
        }

        if(!get_user($username, $pdo)){
            $errors['user_not_exist'] = "User is not exist";
        }

        if( invalid_inputs($username, $password, $pdo)){
            $errors['invalid_inputs'] = "Wrong username or password";
        }
        require_once("../config_session.php");

        if($errors){
            $_SESSION['errors'] = $errors;
            header("Location: login.php");
            die();
        }

        $user= login($username,$password, $pdo);
        $_SESSION['user'] = $user;
        if($user['role']==='manager'){
            header("Location: manage_users.view.php");
            $pdo=null;
            $statement=null;
            die();
        }
        else if($user['role']==='employee'){
            header("Location: vacation_requests.view.php");
            $pdo=null;
            $statement=null;
            die();

        }
        else{
            $_SESSION['wrong_role'] = 'You are not manager or employee';
            header("Location: login.php");
            $pdo=null;
            $statement=null;
            die();
        }

    }catch (PDOException $e){
        die("Query failed: " . $e->getMessage());
    }
}
else{
    header("Location: login.php");
    die();
}
function invalid_inputs($username, $password, $pdo)
{
    if(!login($username, $password, $pdo)){
        return true;
    }
    else{
        return false;
    }
}

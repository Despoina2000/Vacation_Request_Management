<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST' (isset($_SESSION['user'] )&& $_SESSION['user']['role']==='manager' )) {
    $username = $_POST["username"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $email = $_POST["email"];
    $role = $_POST["role"];
    $password = $_POST["password"];

    try {
        require_once("../database_connection/database_handler.php");
        require_once("../database_connection/users.model.php");


        $errors = [];

        if (is_input_empty([$username, $name, $surname, $email, $role, $password])) {

            $errors['empty_inputs'] = "Inputs not be empty";
        }
        if (is_email_invalid($email)) {

            $errors['invalid_email'] = "Invalid email";
        }

        if(!isset($_SESSION['edit_user'])) {
            if (is_username_exist($username, $pdo)) {
                $errors['username_exists'] = "Username already exists";

            }

            if (is_email_registered($email, $pdo)) {
                $errors['email_registered'] = "Email already registered";

            }
        }



        require_once("../config_session.php");

        if ($errors) {
            $_SESSION['errors'] = $errors;
            header("Location: create_user.view.php");
            die();
        }

        if(isset($_SESSION['edit_user'])){
            update_user($username, $name, $surname, $email, $password,'other', $_SESSION['edit_user']['id'],$pdo);
        }
        else{
            create_user($username, $name, $surname, $email, $password, 'other', $pdo);
        }


        header("Location:manage_users.controler.php");
        $pdo = null;
        $statement = null;
        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }

} else {
    $_SESSION['wrong_role'] = 'You are not manager.';
    header("Location: login.view.php");
    die();
}

function is_input_empty($inputs)
{
    foreach ($inputs as $input) {
        if ($input == null) {
            return true;
        }
    }
    return false;
}


function is_email_invalid($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

function is_username_exist($username, $pdo)
{

    if (get_user($username, $pdo)) {
        return true;
    }
    return false;

}

function is_email_registered($email, $pdo)
{
    if (get_email($email, $pdo)) {
        return true;
    }
    return false;
}

function create_user($username, $name, $surname, $email, $password, $role, $pdo)
{

    set_user($username, $name, $surname, $email, $password, $role, $pdo);

}
<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST["username"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $email = $_POST["email"];
    $role = $_POST["role"];
    $password = $_POST["password"];

    try {
        require_once("../database_connection/database_handler.php");
        require_once("../database_connection/users.model.php");
        require_once("sign-up.controler.php");

        $errors = [];

        if (is_input_empty([$username, $name, $surname, $email, $role, $password])) {

            $errors['empty_inputs'] = "Inputs not be empty";
        }
        if (is_email_invalid($email)) {

            $errors['invalid_email'] = "Invalid email";
        }

        if (is_username_exist($username, $pdo)) {
            $errors['username_exists'] = "Username already exists";

        }

        if (is_email_registered($email, $pdo)) {
            $errors['email_registered'] = "Email already registered";

        }

        require_once("../config_session.php");

        if ($errors) {
            $_SESSION['errors'] = $errors;
            header("Location: sign-up.php");
            die();
        }

        create_user($username, $name, $surname, $email, $password, $role, $pdo);
        header("Location: login.php");
        $pdo = null;
        $statement = null;
        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }

} else {
    header("Location: sign-up.php");
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
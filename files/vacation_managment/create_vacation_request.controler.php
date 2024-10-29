<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST' && (isset($_SESSION['user'] )&& $_SESSION['user']['role']==='employee' )) {
    $date_from = $_POST["date_from"];
    $date_to = $_POST["date_to"];
    $reason = $_POST["reason"];


    try {
        require_once("../database_connection/database_handler.php");
        require_once("../database_connection/vacation_requests.model.php");
        $errors=[];
        if (is_input_empty([$date_from, $date_to, $reason])) {

            $errors['empty_inputs'] = "Inputs not be empty";
        }

        if(is_invalid_dates($date_from, $date_to)) {
            $errors['invalid_dates'] = "There is invalid dates; initial date must be earlier than last date.";
        }
        require_once("../config_session.php");

        if($errors){
            $_SESSION['errors'] = $errors;
            header("Location: create_vacation_request.view.php");
            die();
        }

        createRequest($date_from, $date_to, $reason,$pdo);
        header("Location:vacation_requests.controler.php");
        $pdo = null;
        $statement = null;
        die();
    }
    catch (PDOException $e){
    die("Query failed: " . $e->getMessage());
    }
} else {
    $_SESSION['wrong_role'] = 'You are not employee.';
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

function is_invalid_dates($date_from, $date_to){
    if($date_from > $date_to){
        return true;
    }
    else{
        return false;
    }
}

<?php

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

function is_username_exist($username, $pdo){

    if(get_username($username, $pdo)) {
        return true;
    }
    return false;

}

function is_email_registered($email, $pdo){
    if(get_email($email, $pdo)){
        return true;
    }
    return false;
}

function create_user($username,$name,$surname, $email, $password, $pdo){

    set_user($username, $name, $surname, $email, $password, $pdo);

}
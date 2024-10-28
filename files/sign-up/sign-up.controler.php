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

function is_username_exist($username){

}
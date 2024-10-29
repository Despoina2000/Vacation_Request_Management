<?php

try{
    require_once("../database_connection/database_handler.php");
    require_once("../database_connection/users.model.php");


    if(isset($_SESSION['user']) && $_SESSION['user']['role']==='manager'){
        $user = $_SESSION['user'];
        $users=[];
        if(get_users($pdo)){
            $users=get_users($pdo);
        }
        $_SESSION['users']=$users;

        $pdo=null;
        $statement=null;
        die();
    }
    else{
        header("Location: login.php");
        die();
    }

}catch (PDOException $e){
    die("Query failed: " . $e->getMessage());
}

function edit($user){

}

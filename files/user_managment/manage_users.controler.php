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
        require_once("../config_session.php");
        $pdo=null;
        $statement=null;
        die();
    }
    else{
        $_SESSION['wrong_role'] = 'You are not manager.';
        header("Location: login.view.php");
        die();
    }




}catch (PDOException $e){
    die("Query failed: " . $e->getMessage());
}

function edit($user){
    $_SESSION['edit_user']=$user;
    header("Location: create_user.view.php");
    die();


}

function delete($user){
    try{
        delete_user($user['id'],$pdo);
    }catch (PDOException $e){
        die("Query failed: " . $e->getMessage());
    }

}

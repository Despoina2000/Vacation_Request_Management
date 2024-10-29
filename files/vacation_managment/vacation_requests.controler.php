<?php
try{
    require_once("../database_connection/database_handler.php");
    require_once("../database_connection/vacation_requests.model.php");


    if(isset($_SESSION['user']) && $_SESSION['user']['role']==='employee'){
        require_once("../config_session.php");
        $user = $_SESSION['user'];
        $requests=[];
        if(getRequests($pdo)){
            $requests=getRequests($pdo);
        }
        $_SESSION['requests']=$requests;
        header("Location:vacation_requests.view.php");
        $pdo = null;
        $statement = null;
        die();
    }else{
        $_SESSION['wrong_role'] = 'You are not manager.';
        header("Location: login.view.php");
        die();
    }
}catch (PDOException $e){
    die("Query failed: " . $e->getMessage());
}

function approve($request_id){
    try{
    approveRequest($request_id,$pdo);
    }catch (PDOException $e){
    die("Query failed: " . $e->getMessage());
}
}

function reject($request_id){
    try{
        denyRequest($request_id,$pdo);
    }catch (PDOException $e){
        die("Query failed: " . $e->getMessage());
    }
}

function delete($request_id){
    try{
        deleteRequest($request_id,$pdo);
    }catch (PDOException $e){
        die("Query failed: " . $e->getMessage());
    }
}
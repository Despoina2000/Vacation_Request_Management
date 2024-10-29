<?php

function get_user($username, $pdo){

$statement = $pdo->prepare("SELECT id FROM users WHERE username = :username;");
$statement->bindValue(':username', $username);
$statement->execute();

return $statement->fetch(PDO::FETCH_ASSOC);
}

function get_email($email, $pdo){

    $statement = $pdo->prepare("SELECT email FROM users WHERE email = :email;");
    $statement->bindValue(':email', $email);
    $statement->execute();

    return $statement->fetch(PDO::FETCH_ASSOC);
}

function get_users($pdo){
    $statement = $pdo->prepare("SELECT id, username, email FROM users");
    $statement->execute();

    return $statement->fetch(PDO::FETCH_ASSOC);
}
function set_user($username, $name, $surname, $email, $password,$role, $pdo){
    $statement = $pdo->prepare("INSERT INFO users SET username = :username, name = :name, surname = :surname, email = :email, role = :role, password = :password;");
    $statement->bindValue(':username', $username);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':surname', $surname);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':role', $role);
    $options=[
        'cost' => 12,
    ];
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);
    $statement->bindValue(':password', $hashedPassword);
    $statement->execute();

    return $statement->fetch(PDO::FETCH_ASSOC);
}

function update_user($username, $name, $surname, $email, $password,$role, $pdo){
    $statement = $pdo->prepare("INSERT INFO users SET username = :username, name = :name, surname = :surname, email = :email, role = :role, password = :password;");
    $statement->bindValue(':username', $username);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':surname', $surname);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':role', $role);
    $options=[
        'cost' => 12,
    ];
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);
    $statement->bindValue(':password', $hashedPassword);
    $statement->execute();

    return $statement->fetch(PDO::FETCH_ASSOC);
}

function login($username, $password, $pdo){
    $statement = $pdo->prepare("SELECT username,role FROM users WHERE username = :username and password = :password;");
    $statement->bindValue(':username', $username);
    $statement->bindValue(':password', $password);
    $statement->execute();

    return $statement->fetch(PDO::FETCH_ASSOC);

}



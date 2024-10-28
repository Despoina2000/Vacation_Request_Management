<?php

function get_username($username, $pdo){

$statement = $pdo->prepare("SELECT username FROM users WHERE username = :username;");
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

function set_user($username, $name, $surname, $email, $password, $pdo){
    $statement = $pdo->prepare("INSERT INFO users SET username = :username, name = :name, surname = :surname, email = :email;");
    $statement->bindValue(':username', $username);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':surname', $surname);
    $statement->bindValue(':email', $email);
    $options=[
        'cost' => 12,
    ];
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);
    $statement->bindValue(':password', $hashedPassword);
    $statement->execute();

    return $statement->fetch(PDO::FETCH_ASSOC);
}

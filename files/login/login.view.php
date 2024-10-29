<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<h3>Login</h3>

<form action="login.controler.php" method="post">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button>Login</button>
</form>

<?php

require_once '../config_session.php';
check_errors();
check_role();
function check_errors()
{
    if (isset($_SESSION['errors'])) {
        $errors = $_SESSION['errors'];
        foreach ($errors as $error) {
            echo '<p>$error</p>';
        }
        unset($_SESSION['errors']);
    }
}

function check_role()
{
    if (isset($_SESSION['wrong_role'])) {
        echo '<p>$_SESSION[\'wrong_role\']</p>';
        unset($_SESSION['wrong_role']);
    }
}
?>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign up</title>
</head>
<body>
<h3>Sign up</h3>

<form action="sign-up.action.php" method="post">
    <input type="text" name="username" placeholder="Username" required>
    <input type="text" name="name" placeholder="Name" required>
    <input type="text" name="surname" placeholder="Surname" required>
    <input type="text" name="email" placeholder="E-mail" required>
    <input type="password" name="password" placeholder="Password" required>
    <button>Sign up</button>
</form>

<?php
require_once 'sign-up.view.php';
require_once '../../config_session.php';
check_errors();
?>


</body>
</html>

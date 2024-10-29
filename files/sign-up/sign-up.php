<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign up</title>
</head>
<body>
<h3>Sign up</h3>

<form action="sign-up.controler.php" method="post">
    <input type="text" name="username" placeholder="Username" required>
    <input type="text" name="name" placeholder="Name" required>
    <input type="text" name="surname" placeholder="Surname" required>
    <input type="text" name="email" placeholder="E-mail" required>
    <label>Role</label>
    <select id="role" name="role">
        <option value="manager">Manager</option>
        <option value="employee">Employee</option>
        <option value="other">Other</option>
    </select>
    <input type="password" name="password" placeholder="Password" required>
    <button>Sign up</button>
</form>

<?php
require_once '../config_session.php';
check_errors();
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
?>


</body>
</html>

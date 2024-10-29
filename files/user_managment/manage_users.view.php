<!-- manager_dashboard.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manager Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <h2>List of Users</h2>
    <a href="create_user.view.php" class="button">Create User</a>
    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        require_once("manage_users.controler.php");
        require_once("../config_session.php");

        // Fetch users from the database and display them
        // Assuming $users is an array of user data
        foreach ($_SESSION['users'] as $user) {
            echo "<tr>";
            echo "<td>{$user['username']}</td>";
            echo "<td>{$user['email']}</td>";
            echo "<td>

                             <button onclick='/'".edit($user['username'])."'/>Edit</button>| 
                            <button onclick='/'".delete($user['username'])."'/>Delete</button>
                          </td>";
            echo "</tr>";
        }
        ?>
        <button onclick='<?php edit($user)?>'>Edit</button>
        </tbody>
    </table>
</div>
</body>
</html>


<!-- create_user.php or edit_user.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create/Edit User</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <h2>Create/Edit User</h2>
    <form action="save_user.php" method="POST">
        <label for="username">Name:</label>
        <input type="text" id="username" name="username" required value="<?php echo $user['username'] ?? ''; ?>">

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required value="<?php echo $user['email'] ?? ''; ?>">

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <input type="hidden" name="user_id" value="<?php echo $user['id'] ?? ''; ?>">

        <button type="submit">Save</button>
    </form>
</div>
</body>
</html>


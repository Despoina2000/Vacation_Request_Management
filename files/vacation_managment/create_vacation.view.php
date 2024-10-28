<!-- create_vacation.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Vacation Request</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <h2>Vacation Request</h2>
    <form action="save_vacation.php" method="POST">
        <label for="date_from">Date From:</label>
        <input type="date" id="date_from" name="date_from" required>

        <label for="date_to">Date To:</label>
        <input type="date" id="date_to" name="date_to" required>

        <label for="reason">Reason:</label>
        <textarea id="reason" name="reason" required></textarea>

        <button type="submit">Save</button>
    </form>
</div>
</body>
</html>


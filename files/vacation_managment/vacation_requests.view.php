<!-- employee_dashboard.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <h2>Vacation Requests</h2>
    <a href="create_vacation_request.view.php" class="button">Request Vacation</a>
    <table>
        <thead>
        <tr>
            <th>Date Submitted</th>
            <th>Dates Requested</th>
            <th>Reason</th>
            <th>Total Days</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // Fetch vacation requests from the database and display them
        // Assuming $requests is an array of vacation request data
        foreach ($requests as $request) {
            echo "<tr>";
            echo "<td>{$request['date_submitted']}</td>";
            echo "<td>{$request['date_from']} - {$request['date_to']}</td>";
            echo "<td>{$request['reason']}</td>";
            echo "<td>{$request['total_days']}</td>";
            echo "<td>{$request['status']}</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>

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
    <a href="create_vacation_request.controler.php" class="button">Request Vacation</a>
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
        require_once("vacation_requests.view.php");
        require_once("../config_session.php");
        // Fetch vacation requests from the database and display them
        // Assuming $requests is an array of vacation request data
        foreach ($_SESSION['requests'] as $request) {
            echo "<tr>";
            echo "<td>{$request['date_submitted']}</td>";
            echo "<td>{$request['date_from']} - {$request['date_to']}</td>";
            echo "<td>{$request['reason']}</td>";
            if($request['is_approved']!=null){
                if($request['is_approved']){
                    echo "<td>Approved</td>";
                }else{
                    echo "<td>Rejected</td>";
                }
                echo "<td>{$request['is_approved']}</td>";
            }else{
                echo "<td>Pedding</td>";
                echo "<td>

                             <button onclick='/'".approve($request['id'])."'/>Approve</button>| 
                             <button onclick='/'".reject($request['id'])."'/>Reject</button>|
                            <button onclick='/'".delete($request['id'])."'/>Delete</button>
                          </td>";
            }
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>

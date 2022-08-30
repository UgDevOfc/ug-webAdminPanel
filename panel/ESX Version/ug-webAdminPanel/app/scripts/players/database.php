<?php
    require('app/config/database.php');
    
    $connection = new mysqli($DataBase['DB_Server_Host'], $DataBase['DB_Server_Username'], $DataBase['DB_Server_Password'], $DataBase['DB_Server_DBName']);
    if ($connection -> connect_error) {
        die("[ug-webAdminPanel] ERROR: Error during Database Connection to your ESX Server! Are you sure did you configure in the app/config/database.php your SQL?");
    }
    $sql = "SELECT * FROM users";
    $result = $connection -> query($sql);
    if (!$result) {
        die("[ug-webAdminPanel] ERROR: Error selecting the 'users' table! Query Error: " . $connection -> error);
    }
    while ($row = $result -> fetch_assoc()) {
        echo "
            <tr>
                <td>$row[identifier]</td>
                <td>$row[group]</td>
                <td>$row[firstname]</td>
                <td>$row[lastname]</td>
                <td>$row[money]</td>
                <td>$row[bank]</td>
                <td>$row[job]</td>
                <td>$row[job_grade]</td>
                <td>
                    <a class='btn btn-primary btn-sm' href='/edit?steamid=$row[identifier]'>Edit Player</a>
                    <a class='btn btn-danger btn-sm' href='/delete?steamid=$row[identifier]'>Delete Player</a>
                </td>
            </tr>
        ";
    }
?>

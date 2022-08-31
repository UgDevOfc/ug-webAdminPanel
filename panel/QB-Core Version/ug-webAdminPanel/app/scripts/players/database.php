<?php
    require('app/config/database.php');
    
    $connection = new mysqli($DataBase['DB_Server_Host'], $DataBase['DB_Server_Username'], $DataBase['DB_Server_Password'], $DataBase['DB_Server_DBName']);
    if ($connection -> connect_error) {
        die("[ug-webAdminPanel] ERROR: Error during Database Connection to your ESX Server! Are you sure did you configure in the app/config/database.php your SQL?");
    }
    $sql = "SELECT * FROM players";
    $result = $connection -> query($sql);
    if (!$result) {
        die("[ug-webAdminPanel] ERROR: Error selecting the 'users' table! Query Error: " . $connection -> error);
    }
    while ($row = $result -> fetch_assoc()) {
        echo "
            <tr>
                <td>$row[citizenid]</td>
                <td>$row[license]</td>
                <td>$row[name]</td>
                <td>$row[money]</td>
                <td>
                    <a class='btn btn-primary btn-sm' href='/edit?license=$row[license]'>Edit Player</a>
                    <a class='btn btn-danger btn-sm' href='/delete?license=$row[license]'>Delete Player</a>
                </td>
            </tr>
        ";
    }
?>

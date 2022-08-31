<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header('location:login');
    }
    include ('app/includes/navbar.php');
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
        <?php
            require('app/config/config.php');
            echo '<title>' . $Config['WebsiteTitle'] . ' - Player Management</title>';
        ?>
    </head>
    <body>
        <div class="container my-5">
            <h2>Players List</h2>
            <a class="btn btn-primary" href="/create" role="button">Create Player</a>
            <br>
            <table class="table">
                <thead>
                    <tr>
                        <th>Citizen ID</th>
                        <th>License</th>
                        <th>Steam Name</th>
                        <th>Money</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include ('app/scripts/players/database.php');
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>

<!-- https://www.youtube.com/watch?v=NqP0-UkIQS4  |  Minuto: 13:08 -->
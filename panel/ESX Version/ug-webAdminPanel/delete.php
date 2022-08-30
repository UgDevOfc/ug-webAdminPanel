<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header('location:login');
    }
    include ('app/includes/navbar.php');
    require ('app/config/database.php');
    $connection = new mysqli($DataBase['DB_Server_Host'], $DataBase['DB_Server_Username'], $DataBase['DB_Server_Password'], $DataBase['DB_Server_DBName']);
    $steamID    = "";
    $errorMsg   = "";
    $successMsg = "";
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (!isset($_GET['steamid'])) {
            header("location: /players");
            exit;
        }
        $steamID = $_GET['steamid'];
        $sql = "SELECT * FROM users WHERE identifier = '$steamID';";
        $result = $connection -> query($sql);
        $row = $result -> fetch_assoc();
        if (!$row) {
            header("location: /players/");
            exit;
        }
        $steamID = $row["identifier"];
    } else {
        $steamID = $_GET["steamid"];
        do {
            $sql = "DELETE FROM users WHERE identifier = '$steamID';";
            $result = $connection -> query($sql);
            if (!$result) {
                $errorMsg = "[ug-webAdminPanel] ERROR: Error deleting in the 'users' table! Query Error: " . $connection -> error;
                break;
            }
            $successMsg = "[ug-webAdminPanel] SUCCESS: Deleted the player with Steam Identifier '$steamID'!";
            $steamID = "";
        } while (false);
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
        <?php
            require('app/config/config.php');
            echo '<title>' . $Config['WebsiteTitle'] . ' - Player Management</title>';
        ?>
    </head>
    <body>
        <div class="container my-5">
            <h2>Delete Player</h2>
            <p><strong>Are you sure do you want to delete this player?</strong></p>
            <hr>
            <?php
                if (!empty($errorMsg)) {
                    echo "
                    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        <strong>$errorMsg</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Ok.'></button>
                    </div>
                    <hr>
                    ";
                }
                if (!empty($successMsg)) {
                    echo "
                    <div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong>$successMsg</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Ok.'></button>
                    </div>
                    <hr>
                    ";
                }
            ?>
            <form method="post">
                <div class="row mb-3">
                    <div class="offset-sm-0 col-sm-3 d-grid">
                        <button type="submit" class="btn btn-primary">Delete Player</button>
                    </div>
                    <div class="col-sm-3 d-grid">
                        <a class="btn btn-danger" href="/players" role="button">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>
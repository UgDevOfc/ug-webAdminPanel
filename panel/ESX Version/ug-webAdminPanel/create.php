<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header('location:login');
    }
    include ('app/includes/navbar.php');
    require ('app/config/database.php');
    $connection = new mysqli($DataBase['DB_Server_Host'], $DataBase['DB_Server_Username'], $DataBase['DB_Server_Password'], $DataBase['DB_Server_DBName']);
    $steamID    = "";
    $group      = "";
    $firstname  = "";
    $lastname   = "";
    $money      = "";
    $bank       = "";
    $job        = "";
    $jobgrade   = "";
    $errorMsg   = "";
    $successMsg = "";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $steamID        = $_POST['steamid'];
        $group          = $_POST['group'];
        $firstname      = $_POST['firstname'];
        $lastname       = $_POST['lastname'];
        $money          = $_POST['money'];
        $bank           = $_POST['bank'];
        $job            = $_POST['job'];
        $jobgrade       = $_POST['jobgrade'];
        do {
            if (empty($steamID) || empty($group) || empty($firstname) || empty($lastname) || empty($money) || empty($bank) || empty($job) || empty($jobgrade)) {
                $errorMsg = "You must complete all fields!";
                break;
            }
            if (!str_starts_with($steamID, "steam:")) {
                $errorMsg = "The Steam Identifier is invalid! Please, check if you typed correctly!";
                break;
            }
            $sql = "SELECT * FROM users WHERE identifier = '$steamID'";
            $sql2 = "INSERT INTO users (identifier, permission_level, `group`, job, job_grade, firstname, lastname, money, bank) VALUES ('$steamID', '0', '$group', '$job', '$jobgrade', '$firstname', '$lastname', '$money', '$bank');";
            $result = $connection -> query($sql);
            if (mysqli_num_rows($result) > 0) {
                $errorMsg = "[ug-webAdminPanel] ERROR: The Steam Identifier '$steamID' already exists!";
                break;
            } else {
                $result2 = $connection -> query($sql2);
                if (!$result2) {
                    $errorMsg = "[ug-webAdminPanel] ERROR: Error selecting the 'users' table! Query Error: " . $connection -> error;
                    break;
                }
                $steamID    = "";
                $group      = "";
                $firstname  = "";
                $lastname   = "";
                $money      = "";
                $bank       = "";
                $job        = "";
                $jobgrade   = "";
                $successMsg = "[ug-webAdminPanel] SUCCESS: Created Player in the Database! Now, when the player joins the server, he will have the character created with the previous settings!";
            }
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
            <h2>Create Player</h2>
            <p><strong>OBS: Fields obrigatory to complete are marked with an "*"</strong></p>
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
                    <label class="col-sm-3 col-form-label"><strong>* Steam ID:</strong></label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="Example: steam:xxxxxxx" name="steamid" value="<?php echo $steamID;?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label"><strong>* Group:</strong></label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="Example: user || Groups Avaiable: user, admin, superadmin" name="group" value="<?php echo $group;?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label"><strong>* First Name:</strong></label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="Example: Frank" name="firstname" value="<?php echo $firstname;?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label"><strong>* Last Name:</strong></label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="Example: De Santa" name="lastname" value="<?php echo $lastname;?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label"><strong>* Money:</strong></label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="Example: 10000" name="money" value="<?php echo $money;?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label"><strong>* Bank:</strong></label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="Example: 500000" name="bank" value="<?php echo $bank;?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label"><strong>* Job:</strong></label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="Example: unemployed" name="job" value="<?php echo $job;?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label"><strong>* Job Grade:</strong></label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="Example: 2" name="jobgrade" value="<?php echo $jobgrade;?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="offset-sm-3 col-sm-3 d-grid">
                        <button type="submit" class="btn btn-primary">Create Player</button>
                    </div>
                    <div class="col-sm-3 d-grid">
                        <a class="btn btn-danger" href="/players" role="button">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>
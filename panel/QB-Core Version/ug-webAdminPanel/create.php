<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header('location:login');
    }
    include ('app/includes/navbar.php');
    require ('app/config/database.php');
    $connection = new mysqli($DataBase['DB_Server_Host'], $DataBase['DB_Server_Username'], $DataBase['DB_Server_Password'], $DataBase['DB_Server_DBName']);
    $citizenID      = "";
    $license        = "";
    $steamname      = "";
    $money          = '';
    $errorMsg       = "";
    $successMsg     = "";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $citizenID          = $_POST['citizenid'];
        $license            = $_POST['license'];
        $steamname          = $_POST['steamname'];
        $money              = $_POST['money'];

        $job = '{"label":"Civilian","grade":{"name":"Freelancer","level":0},"onduty":true,"isboss":false,"name":"unemployed","payment":10}';
        $gang = '{"label":"No Gang Affiliaton","grade":{"name":"none","level":0},"isboss":false,"name":"none"}';
        do {
            if (empty($citizenID) || empty($license) || empty($steamname) || empty($money)) {
                $errorMsg = "[ug-webAdminPanel] ERROR: You must complete all fields!";
                break;
            }
            if (!str_starts_with($license, "license:")) {
                $errorMsg = "[ug-webAdminPanel] ERROR: The License Identifier is invalid! Please, check if you typed correctly!";
                break;
            }
            $sql = "SELECT * FROM players WHERE license = '$license'";
            $sql2 = "INSERT INTO players (citizenid, license, NAME, money, job, gang) VALUES ('$citizenID', '$license', '$steamname', '$money', '$job', '$gang');";
            $result = $connection -> query($sql);
            if (mysqli_num_rows($result) > 0) {
                $errorMsg = "[ug-webAdminPanel] ERROR: The Licence Identifier '$license' already exists!";
                break;
            } else {
                $result2 = $connection -> query($sql2);
                if (!$result2) {
                    $errorMsg = "[ug-webAdminPanel] ERROR: Error insert on the 'players' table! Query Error: " . $connection -> error;
                    break;
                }
                $citizenID  = "";
                $license    = "";
                $steamname  = "";
                $money      = "";
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
            <br>
            <p><strong>Warning:</strong> There can be some fields that require an specified placeholder to work! To see it, you can check bellow the page or access our Docs Page by clicking <a href="https://ugscripts.gitbook.io/docs/ug-webAdminPanel/qb-core/placeholders/" target="_blank">here!</a></p>
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
                    <label class="col-sm-3 col-form-label"><strong>* Citizen ID:</strong></label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="Example: ABC01234" name="citizenid" value="<?php echo $citizenID;?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label"><strong>* License:</strong></label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="Example: license:xxxxxxxxxxxxxxx" name="license" value="<?php echo $license;?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Steam Name:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="Example: Frank" name="steamname" value="<?php echo $steamname;?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label"><strong>* Money (See bellow the format to use here!):</strong></label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder='Example: {"cash":500,"bank":5100,"crypto":0}' name="money" value="<?php echo $money;?>">
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
            <hr>
            <h2>Placeholders</h2>
            <p>Some fields require placeholders to work. If you don't put the placeholder correct, the player data can be unread for QB-Core Framework!</p>
            <br>
            <p><strong>OBS: </strong>Input your value in the <strong>"X"</strong> Crosses!</p>
            <hr>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label"><strong>Money Placeholder:</strong></label>
                <div class="col-sm-6">
                    <label class="form-control"><code>{"cash":X,"bank":X,"crypto":X}</code></label>
                </div>
            </div>
        </div>
    </body>
</html>
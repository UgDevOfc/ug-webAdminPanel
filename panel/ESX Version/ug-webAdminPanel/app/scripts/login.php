<?php 
    require('../config/database.php');
    session_start();
    $con = mysqli_connect($DataBase['DB_WebPanel_Host'], $DataBase['DB_WebPanel_Username'], $DataBase['DB_WebPanel_Password']);
    mysqli_select_db($con, $DataBase['DB_WebPanel_Name']);
    $name = $_POST['username'];
    $passwd = $_POST['password'];
    $s = "SELECT * FROM users WHERE username = '$name' && password = '$passwd'";
    $result = mysqli_query($con, $s);
    $num = mysqli_num_rows($result);

    if ($num == 1) {
        $_SESSION['username'] = $name;
        header('location:../../dashboard');
    } else {
        header('location:../../login');
    }
?>

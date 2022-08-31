<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header('location:login');
    }
    include('app/includes/navbar.php');
    //include('app/includes/copyright.php');
?>
<html>
    <head>
        <?php
            require('app/config/config.php');
            echo '<title>' . $Config['WebsiteTitle'] . ' - Dashboard</title>';
        ?>
        <link rel="stylesheet" type="text/css" href="app/css/dashboard.css">
    </head>
    <body>
        <div class="dashboard-box">
            <div class="container">
                <div class="row">
                    <h1 style="text-align: center;">ug-webAdminPanel</h1>
                    <?php
                        require('app/config/version.php');
                        echo '<h2 style="text-align: center;">Version: ' . $Version['WebPanelVersion'] . '</h2>';
                        echo '<hr>';
                        $version = json_decode(file_get_contents('https://raw.githubusercontent.com/UgScripts/ug-webAdminPanel/master/version.json'));
                        if ($version->webpanel > $Version['WebPanelVersion']) {
                            echo '<h2 style="text-align: center; color: red;"><strong>New Version: ' . $version->webpanel . '</strong></p>';
                            echo '<h2 style="text-align: center; color: red;"><strong>Download by Clicking <a href="https://github.com/UgScripts/ug-webAdminPanel" target="_blank">Here</a>!</strong></p>';
                        } else if ($version->webpanel < $Version['WebPanelVersion']) {
                            echo '<h2 style="text-align: center; color: red;"><strong>New Version: ' . $version->webpanel . '</strong></p>';
                            echo '<h2 style="text-align: center; color: red;"><strong>Download by Clicking <a href="https://github.com/UgScripts/ug-webAdminPanel" target="_blank">Here</a>!</strong></p>';
                        } else {
                            echo '<h2 style="text-align: center; color: green;"><strong>ug-webAdminPanel</strong> is Running with the Latest Update!</p>';
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
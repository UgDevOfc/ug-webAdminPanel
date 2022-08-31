<html>
    <head>
        <?php
            require('app/config/config.php');
            echo '<title>'. $Config['WebsiteTitle'] . ' - Login</title>';
        ?>
        <link rel="icon" type="image/x-icon" href="/app/img/favicon.ico">
        <link rel="stylesheet" type="text/css" href="app/css/login.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    </head>
    <body>
        <div class="login-box">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 login-background">
                        <h2 style="text-align: center; color: white;">Ug Web Admin Panel [BETA] - Login</h2>
                        <h3 style="text-align: center; color: red;"><strong>QB-Core</strong> Version</h3>
                        <form action="app/scripts/login" method="post">
                            <div class="form-group">
                                <label style="color: white;">Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Put here your username" required>
                            </div>
                            <div class="form-group">
                                <label style="color: white;">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Put here your password" required>
                            </div>
                            <div class="login-button">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                            <div class="login-version">
                                <?php
                                    require('app/config/version.php');
                                    echo '<p style="text-align: right; color: white;">Version: ' . $Version['WebPanelVersion'] . '</p>'
                                ?>
                            </div>
                            <div class="login-newVersion">
                                <?php
                                    require('app/config/version.php');	
                                    $version = json_decode(file_get_contents('https://raw.githubusercontent.com/UgScripts/ug-webAdminPanel/master/version.json'));
                                    if ($version->webpanel > $Version['WebPanelVersion'] || !$version->webpanel == $Version['WebPanelVersion']) {
                                        echo '<p style="text-align: right; color: red;"><strong>New Version: ' . $version->webpanel . '</strong></p>';
                                        echo '<p style="text-align: right; color: red;"><strong>Download by Clicking <a href="https://github.com/UgScripts/ug-webAdminPanel" target="_blank">Here</a>!</strong></p>';
                                    } else if ($version->webpanel < $Version['WebPanelVersion']) {
                                        echo '<h2 style="text-align: center; color: red;"><strong>New Version: ' . $version->webpanel . '</strong></p>';
                                        echo '<h2 style="text-align: center; color: red;"><strong>Download by Clicking <a href="https://github.com/UgScripts/ug-webAdminPanel" target="_blank">Here</a>!</strong></p>';
                                    } else {
                                        echo '<p style="text-align: right; color: green;"><strong>ug-webAdminPanel</strong> is Running with the Latest Update!</p>';
                                    }
                                ?> 
                                </div>
                            </div>
                            <div class="col-md-12 login-copyright">
                                <p style="text-align: center; color: grey;position: relative; left: 80x; top: 2px;">Copyright (C) 2022 UgScripts. All Rights Reserved!</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>    
    </body>
</html>
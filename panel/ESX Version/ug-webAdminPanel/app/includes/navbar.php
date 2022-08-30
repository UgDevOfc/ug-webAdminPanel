<html>
    <head>
        <link rel="icon" type="image/x-icon" href="/app/img/favicon.ico">
        <link rel="stylesheet" type="text/css" href="app/css/navbar.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    </head>
    <body>
        <div class="sidebar">
            <div class="logo-content">
                <div class="logo">
                    <i class="bx bx1-c-plus-plus"></i>
                    <?php
                        require('app/config/config.php');
                        echo '<div class="logo-name">' . $Config['WebsiteTitle'] . '</div>';
                    ?>
                </div>
            </div>
            <ul class="nav-list">
                <li>
                    <a href="dashboard">
                        <i class="bx bx-grid-alt bx-tada bx-rotate-90"></i>
                        <span class="links-name">Dashboard</span>
                    </a>
                    <span class="tooltip">Dashboard</span>
                </li>
                <li>
                    <a href="players">
                        <i class='bx bxs-user bx-tada'></i>
                        <span class="links-name">Player Management <strong>BETA</strong></span>
                    </a>
                    <span class="tooltip">Player Management <strong>BETA</strong></span>
                </li>
            </ul>
            <div class="profile_content">
                <div class="profile">
                    <div class="profile_details">
                        <img src="app/img/user.png" alt="">
                        <div class="name_user">
                            <?php
                                echo '<div class="name">Welcome, <strong>' . $_SESSION['username'] . '</strong>!</div>';
                            ?>
                        </div>
                        <div class="logout">
                            <div class="logout-button">
                                <form action="app/scripts/logout" method="post">
                                    <i class="bx bx-log-out"></i>
                                    <button type="submit" class="btn btn-primary">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

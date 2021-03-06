<!DOCTYPE html>
<html>
    <head>
        <title><?= $title; ?></title>
        <base href="http://young-dogz.localhost" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">        
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700' rel='stylesheet' type='text/css'>
        <link href="css/jquery-ui.css" rel="stylesheet" type="text/css" />
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css" />
        <link href="stylesheets/screen.css" rel="stylesheet" type="text/css" />
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
        <script src='js/bootstrap.js' type='text/javascript'></script>
        <script src='js/base.js' type='text/javascript'></script>
    </head>
    <body>
        <header class="adminbar">
            <div class="container">
                <ul>
                    <li class="adminbar-li"><a href="#">Dashboard</a></li>
                    <li class="adminbar-li"><a href="#">Menu's</a></li>
                </ul>
            </div>
        </header>
        <div class="container">
            <div class="admincontent">
                    <!--Maak gebruik van twitter bootstrap... http://getbootstrap.com-->
                <?php
                // Includes the menu. 
                echo $this->element('admin_menu');
                ?>
                <?php
                // Includes the content.
                if (file_exists($pathToView)) {
                    include($pathToView);
                }
                ?>
            </div>
        </div>
    </body>
</html>

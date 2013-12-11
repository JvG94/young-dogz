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
        <link href="stylesheets/ie.css" rel="stylesheet" type="text/css" />
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
        <script src='js/bootstrap.js' type='text/javascript'></script>        
        <script src='js/json.js' type='text/javascript'></script>
        <script src='js/base.js' type='text/javascript'></script>
    </head>
    <body>
        <header>
            <div class="header-image">
                <a href="#" class="logo-image"></a>
            </div>
            <div class="mainnav">
                <div class="container">
                    <?php
                    // Includes the menu. 
                    echo $this->element('menu');
                    ?>
                </div>
            </div> 
        </header>
        <div class="container">
            <div class='row'>
                <div class="col-md-12 well content">
                    <?php
                    // Includes the content.
                    if (file_exists($pathToView)) {
                        include($pathToView);
                    }
                    ?>
                </div>
            </div>
        </div>

        <?php if (DEBUG): ?>
            <button class="btn btn-primary btn-lg" style='position: absolute; right: 1px; top: 1px;' data-toggle="modal" data-target="#modalDebug">Debug Window</button>

            <!--Modal-->
            <div class="modal fade" id="modalDebug" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Debug</h4>
                        </div>
                        <div class="modal-body">
                            <?php echo $this->element('debug'); ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </body>
</html>

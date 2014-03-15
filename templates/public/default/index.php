
<!DOCTYPE html>
<html lang="en">
<head>
<?php echo $metatags ?>
 
<link href="/templates/public/default/bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="/templates/public/default/css/general.css" rel="stylesheet">
<link href="/templates/public/default/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

<script src="/templates/public/default/js/jquery.js" type="text/javascript"></script>
<script src="/templates/public/default/js/comm/jquery.migrate.js" type="text/javascript"></script>
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body>
    <div class="row-fluid">
        <div class="span3">
                <?=Helper_Public::load_menu('left_menu')?>
        </div>
        
        <div class="span9">
            <div class="container-narrow">
                <div class="masthead">
                    <!--<ul class="nav nav-pills pull-right">
                        <li class="active"><a href="/">Главная</a></li>
                        <li><a href="http://shop.sxservice.ru/">Демо</a></li>
                        <li><a href="http://wiki.sxservice.ru/">Wiki</a></li>
                    </ul>-->
                    <?=Helper_Public::load_menu('top_menu')?>
                    <h3 class="muted">Project name 123123 <?=Helper_Public::Widget('hello_test_widget')?></h3>
                </div>

                <div class="body-container">
                    <hr>
                    <div class="jumbotron">
                        <h1>SxService lab</h1>
                        <p class="lead">Сайт в стадии создания.</p>
                    </div>
                    <hr>
                    <?echo $content;?>
                    <hr>
                </div>
                <div class="site-footer">
                    <p>&copy; SxService 2013</p>
                </div>
            </div>  
        </div>
</div>
 
<script src="/templates/public/default/js/include.js" type="text/javascript"></script>
</body>
</html>

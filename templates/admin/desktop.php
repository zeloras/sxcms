<!DOCTYPE html>
<html lang="<?=$language?>">
  <head>
    <meta charset="utf-8">
    <title>SxService :: Admin</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">    

    <link href="/templates/admin/css/general.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script>
        var $base_language = '<?=$language?>';
        var $base_text_editor = '<?=$text_editor?>';
    </script>
  </head>

<body>

<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">	
        <div class="container">
			
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <i class="icon-cog"></i>
            </a>

            <a class="brand" href="/admin">
                    SxCms <sup>0.0.1</sup>
            </a>		
		<?if ($is_auth_user) {?>	
                <div class="nav-collapse collapse">
                    <ul class="nav pull-right">
                        <li class="dropdown">
                            <a href="/">
                                <i class="icon-globe"></i>
                                <?=__('Go to site')?>
                            </a>
                        </li>

                        <li class="dropdown">

                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-user"></i> 
                                        <?=$username?>
                                        <b class="caret"></b>
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a href="/admin/auth/logout"><?=__('Logout')?></a></li>
                                </ul>

                        </li>
                    </ul>
			
                    <form class="navbar-search pull-right">
                            <input type="text" class="search-query" placeholder="Search">
                    </form>
            </div><!--/.nav-collapse -->
            <?}?>
        </div> <!-- /container -->
    </div> <!-- /navbar-inner -->
</div> <!-- /navbar -->
    



<?=$menu_admin_html?>
<div id="base-container">
<?=$content_admin?>	
</div>
    
<div class="footer">
    <div class="container">
        <div class="row">
            <div id="footer-copyright" class="span6">
                    &copy; 2012-13 SxService.
            </div>

            <div id="footer-terms" class="span6">
                    Theme by <a href="http://jumpstartui.com" target="_blank">Jumpstart UI</a>
            </div>
        </div>
    </div>
</div>


<div id="page-loading" class="hidden"><i class="icon-spinner icon-spin icon-5x on-center"></i></div>
<div id="modal-background"></div>

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="/templates/admin/js/jquery.js"></script>
<script src="/templates/admin/js/comm/jquery.migrate.js"></script>
<script src="/templates/admin/js/include.js"></script>
  </body>
</html>

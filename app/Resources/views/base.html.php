<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>ЗАИГРАВКА.БГ</title>

        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0-rc1/css/bootstrap.min.css" rel="stylesheet">
        
        <!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

	<link href="/css/style.css" rel="stylesheet">
</head>

<body >

    <div class="navbar navbar-fixed-top">
      <div class="container">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/homepage">ЗАИГРАВКА.БГ</a>
        <div class="nav-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="<?=($url[1]=='drawing'?'active':'')?>"><a href="/drawing">Рисувай</a></li>
            <li class="<?=($url[1]=='coloring'?'active':'')?>"><a href="/coloring">Оцветявай</a></li>
            <li class="<?=($url[1]=='sing'?'active':'')?>"><a href="/sing">Пей</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Настройки <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="/users">Потребители</a></li>
                <li><a href="/categories">Категории</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Картинки</li>
                <li><a href="/upload">Добавяне</a></li>
                <li><a href="/pictures">Управление</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav pull-right">
            <li class="<?=($url[1]=='registration'?'active':'')?>"><a href="/registration">Регистрация</a></li>
            <li class="<?=($url[1]=='login'?'active':'')?>"><a href="/login">Вход</a></li>
            <li class="<?=($url[1]=='profile'?'active':'')?>"><a href="/profile"><i class="glyphicon glyphicon-user"></i></a></li>
            <li><a href="/logout">Изход</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    

	

        
    <div class="container body-container">

            <div class="row">
      <div class="col-sm-2">
          <ul id="sidebar" class="nav nav-stacked affix">
            <li class="disabled"><a href="#">Категории</a></li>
            <? include (CONTROLER_PATH.'sidebar.php'); ?>
        </ul>
      </div>


                <div id="main" class="col-sm-9">
                    <? if($page != CONTROLER_PATH.'homepage.php') include ($page); ?>
                </div>

            </div>

    </div>
    <div class="push"></div>



   <footer class="footer">
      <div class="container">
            <p>&copy; 2016 - zap4agite - All Rights Reserved</p>
        </div>
    </footer>




<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>
			  
<script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>

<script 
  src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js"
  integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK"
  crossorigin="anonymous"></script>


</body>
</html>
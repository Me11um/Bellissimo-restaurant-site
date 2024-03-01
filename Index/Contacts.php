<?php

    require "db.php";
    
    //error_reporting(E_ALL);
    //ini_set('display_errors', 1);
    
    $data = $_POST;
    
    if ( isset($data['do_signup']))
    {
        $errors = array();
        if ( trim($data['regname']) == '')
        {
            $errors[] = 'Введите имя!';
        }
        if ( trim($data['reglogin']) == '')
        {
            $errors[] = 'Введите логин!';
        }
        if ( $data['regpass'] == '')
        {
            $errors[] = 'Введите пароль!';
        }
        if ( R::count('users', "login = ?", array($data['reglogin'])) > 0 )
        {
            $errors[] = 'Пользователь с введеным логином уже существует!';
        }
    if( empty($errors) )
    {
        $user = R::dispense('users');
        $user->name = $data['regname'];
        $user->login = $data['reglogin'];
        $user->password = password_hash($data['regpass'], PASSWORD_DEFAULT);
        R::store($user);
        $_SESSION['logged_user'] = $user;
    } else {
       // echo '<p class="ErrorWarning">'.array_shift($errors).'</p>';
        }
    }
    if ( isset($data['do_signin']))
    {
        $errors = array();
        $user = R::findOne('users', "login = ?", array($data['enterlogin']));
        if ( $user )
        {
            if ( password_verify($data['enterpass'], $user->password ) ) {
                $_SESSION['logged_user'] = $user;
            } else
            {
                $errors[] = 'Неверно введен пароль!';
            }
        } else
        {
            $errors[] = 'Пользователь с таким логином не найден!';
        }
        if( empty($errors) )
    {
        
    } else {
        //echo '<p class="ErrorWarning">'.array_shift($errors).'</p>';
        }
    }
    
    if ( isset($data['logout']))
    {
        unset($_SESSION['logged_user']);
        header('Location: /');
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Контакты ресторана Bellissimo</title>
	<meta name="description" content="Здесь вы можете посмотреть контакты ресторана итальянской кухни Bellissimo">
	<meta name="keywords" content="Контакты, Bellissimo, Итальянская кухня, Ресторан">
    <link rel="stylesheet" href="styles.css">
</head>
<script>
    window.addEventListener("resize", AutoScale);

    AutoScale();

    function AutoScale()
{
    let width = window.innerWidth;

    if(width > 1400)
    {
        var usercount = document.getElementById("user-count");
   	    usercount.style.position = "absolute";
   	    usercount.style.display = "inline-block";
   	    usercount.style.maxWidth = "20%";
   	    var logintext = document.getElementById("login-text");
   	    if (logintext)
   	    {   
   	        logintext.style.position = "absolute";
   	        logintext.style.display = "inline-block";
   	        logintext.style.maxWidth = "20%";
   	    }
   	    var errortext = document.getElementById("error-text");
   	    if (errortext)
   	    {   
   	        errortext.style.position = "absolute";
   	        errortext.style.display = "inline-block";
   	        errortext.style.maxWidth = "20%";
   	    }
   	    var button = document.getElementById("signin-button");
   	    if (button)
   	    {
   	    button.style.position = "absolute";
   	    button.style.display = "inline-block";
   	    button.style.width = "10%";
   	    button.style.height = "4%";
   	    }
   	    button = document.getElementById("signup-button");
   	    if (button)
   	    {
   	    button.style.position = "absolute";
   	    button.style.display = "inline-block";
   	    button.style.width = "10%";
   	    button.style.height = "4%";
   	    }
   	    button = document.getElementById("logout-button");
   	    if (button)
   	    {
   	    button.style.position = "absolute";
   	    button.style.display = "inline-block";
   	    button.style.width = "10%";
   	    button.style.height = "4%";
   	    }
   	    var menu = document.getElementById("menu");
   	    menu.children[0].style.display = "inline-block";
   	    menu.children[1].style.display = "inline-block";
   	    menu.children[2].style.display = "inline-block";
   	    menu.children[3].style.display = "inline-block";
   	    menu.children[4].style.display = "inline-block";
   	    menu.children[4].style.paddingBottom = "0px";
   	    var page = document.getElementById("page");
   	    page.style.width = "60%";
   	    var signindialog = document.getElementById("SigninDialog");
   	    signindialog.style.width = "20%";
   	    signindialog.style.height = "50%";
   	    var signupdialog = document.getElementById("SignupDialog");
   	    signupdialog.style.width = "20%";
   	    signupdialog.style.height = "50%";
    }
    else
    {
        var usercount = document.getElementById("user-count");
   	    usercount.style.position = "static";
   	    usercount.style.display = "grid";
   	    usercount.style.maxWidth = "50%";
   	    var logintext = document.getElementById("login-text");
   	    if (logintext)
   	        {
   	            logintext.style.position = "static";
   	            logintext.style.display = "grid";
   	            logintext.style.maxWidth = "50%";
   	        }
   	    var errortext = document.getElementById("error-text");
   	    if (errortext)
   	        {
   	            errortext.style.position = "static";
   	            errortext.style.display = "grid";
   	            errortext.style.maxWidth = "50%";
   	        }
   	    var button = document.getElementById("signin-button");
   	    if (button)
   	    {
   	    button.style.position = "static";
   	    button.style.display = "grid";
   	    button.style.width = "30%";
   	    button.style.height = "50%";
   	    button.style.padding = "10px 10px";
   	    button.style.margin = "5px 5px";
   	    }
   	    button = document.getElementById("signup-button");
   	    if (button)
   	    {
   	    button.style.position = "static";
   	    button.style.display = "grid";
   	    button.style.width = "30%";
   	    button.style.height = "50%";
   	    button.style.padding = "10px 10px";
   	    button.style.margin = "5px 5px";
   	    }
   	    button = document.getElementById("logout-button");
   	    if (button)
   	    {
   	    button.style.position = "static";
   	    button.style.display = "grid";
   	    button.style.width = "30%";
   	    button.style.height = "50%";
   	    button.style.padding = "10px 10px";
   	    button.style.margin = "5px 5px";
   	    }
   	    var menu = document.getElementById("menu");
   	    menu.children[0].style.display = "grid";
   	    menu.children[1].style.display = "grid";
   	    menu.children[2].style.display = "grid";
   	    menu.children[3].style.display = "grid";
   	    menu.children[4].style.display = "grid";
   	    menu.children[4].style.paddingBottom = "20px";
   	    var page = document.getElementById("page");
   	    page.style.width = "100%";
   	    var signindialog = document.getElementById("SigninDialog");
   	    signindialog.style.width = "50%";
   	    signindialog.style.height = "40%";
   	    var signupdialog = document.getElementById("SignupDialog");
   	    signupdialog.style.width = "50%";
   	    signupdialog.style.height = "40%";
    }
}
</script>

<body onload="AutoScale();">

<center>
<div class="head">
<img src="BellissimoEmpty.png" WIDTH="400"
HEIGHT="240">
<?php
if ( isset($data['do_signin']))
    {
        if( empty($errors) )
    {
        
    } else {
        echo '<p class="ErrorWarning" id="error-text">'.array_shift($errors).'</p>';
        }
    }
if ( isset($data['do_signup']))
    {
    if( empty($errors) )
    {
    } else {
       echo '<p class="ErrorWarning" id="error-text">'.array_shift($errors).'</p>';
        }
    }
?>
<p class="SessionCount" id="user-count">
Пользователей на сайте: <?php include('Userscript.php'); ?>
</p>
<?php if ( isset($_SESSION['logged_user'])) : ?>
<p class="logintext" id="login-text"> Добро пожаловать, <?php echo $_SESSION['logged_user']->name; ?>! </p>
<form action="/contacts.php" id="signup-form" method="POST">
<button class="signinbutton" id="logout-button" name="logout" type="submit">Выйти</button>
</form>
<?php else : ?>
<button id="signup-button" class="signupbutton" type="button" onclick="window.SignupDialog.showModal(); window.SignupDialog.style.opacity = '100%'; window.SignupDialog.style.top = '0px';">Зарегистрироваться</button>
<button id="signin-button"  class="signinbutton" type="button" onclick="window.SigninDialog.showModal(); window.SigninDialog.style.opacity = '100%'; window.SigninDialog.style.top = '0px';">Войти</button>
<?php endif; ?>
<HR color=#f1f100>
<div class="menu" id="menu"><a href=index.php>Главная</a><a href=Menu.php>Меню</a><a href=Info.php>Оставить отзыв</a><a href=Contacts.php>Контакты</a><a href=Stolik.php>Забронировать столик</a></div>
</div>
<dialog id="SignupDialog" class="DialogWindow">Регистрация
<form action="/Contacts.php" id="signup-form" method="POST">

<input class="signin" name="regname" id="regname" type="text" placeholder="Имя"/>
<input class="signin" name="reglogin" id="reglogin" type="text" placeholder="Логин"/>
<input class="signin" name="regpass" id="regpass" type="password" placeholder="Пароль"/>
<button class="signupsendbutton" name="do_signup" type="submit">Зарегистрироваться</button>
<button class="signupsendbutton" type="button" onclick="window.SignupDialog.style.opacity = '0%'; window.SignupDialog.style.top = '-200px'; window.SignupDialog.close();">Закрыть окно</button>
</form>
</dialog>
<dialog id="SigninDialog" class="DialogWindow">Вход
<form action="/Contacts.php" id="signup-form" method="POST">
<input class="signin" name="enterlogin" type="text" placeholder="Логин"/>
<input class="signin" name="enterpass" type="password" placeholder="Пароль"/>
<button class="signupsendbutton" name="do_signin" type="submit">Войти</button>
<button class="signupsendbutton" type="button" onclick="window.SigninDialog.style.opacity = '0%'; window.SigninDialog.style.top = '-200px'; window.SigninDialog.close();">Закрыть окно</button>
</form>
</dialog>
<div class="page" id="page">
<div class="block">
<H1 align="left">Наши контакты: </H1>
<p align="left">Телефон: +7 (3452) 22-22-22 </br></br>Email: bellissimo.restaurant@gmail.com </p>
<img src="Map.png" width=90% height=90%>
</div>
</div>
</center>
</body>

</html>
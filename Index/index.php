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
    <title>Ресторан итальянской кухни Bellissimo</title>
	<meta name="description" content="Главная страница и новости ресторана итальянской кухни Bellissimo">
	<meta name="keywords" content="Bellissimo, Итальянская кухня, Ресторан">
    <link rel="stylesheet" href="styles.css">
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();
   for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
   k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(91976775, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true
   });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/91976775" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
</head>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-0FX9V7WD95"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-0FX9V7WD95');
</script>

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
   	    var newpage = document.getElementById("new-page");
   	    if (newpage)
   	    {   
   	        newpage.style.position = "absolute";
   	        newpage.style.display = "inline-block";
   	        newpage.style.maxWidth = "20%";
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
   	    var newpage = document.getElementById("new-page");
   	    if (newpage)
   	        {
   	            newpage.style.position = "static";
   	            newpage.style.display = "grid";
   	            newpage.style.maxWidth = "50%";
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
<?php if ( $_SESSION['logged_user']->type == 1 ) echo '<a href="#" class="newpage" id="new-page"> Предложить новость </a>'; else { echo '<a href="#" class="newpage" id="new-page"> Посмотреть статистику </a>'; } ?>
<form action="/index.php" id="signup-form" method="POST">
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
<form action="/index.php" id="signup-form" method="POST">

<input class="signin" name="regname" id="regname" type="text" placeholder="Имя"/>
<input class="signin" name="reglogin" id="reglogin" type="text" placeholder="Логин"/>
<input class="signin" name="regpass" id="regpass" type="password" placeholder="Пароль"/>
<button class="signupsendbutton" name="do_signup" type="submit">Зарегистрироваться</button>
<button class="signupsendbutton" type="button" onclick="window.SignupDialog.style.opacity = '0%'; window.SignupDialog.style.top = '-200px'; window.SignupDialog.close();">Закрыть окно</button>
</form>
</dialog>
<dialog id="SigninDialog" class="DialogWindow">Вход
<form action="/index.php" id="signup-form" method="POST">
<input class="signin" name="enterlogin" type="text" placeholder="Логин"/>
<input class="signin" name="enterpass" type="password" placeholder="Пароль"/>
<button class="signupsendbutton" name="do_signin" type="submit">Войти</button>
<button class="signupsendbutton" type="button" onclick="window.SigninDialog.style.opacity = '0%'; window.SigninDialog.style.top = '-200px'; window.SigninDialog.close();">Закрыть окно</button>
</form>
</dialog>
<div class="page" id="page">
<div class="block">
<p align="left" style="color:#c8c8c8; padding-top:40px;" >11-11-2022</p>
<H1 align="left" style="padding-top:10px;">Открыта новая точка!</H1>
<p align="left" style="padding-bottom:0px;">Рады сообщить вам, что открылся уже третий ресторан Bellissimo! Ждём вас каждый день с 10:00 до 21:00!</p>
<img src="restaurant.jpg" style="width:90%; height:90%;">
<HR color=#E8E8E8>
</div>
<div class="block">
<p align="left" style="color:#c8c8c8; padding-top:40px;" >08-06-2021</p>
<H1 align="left" style="padding-top:10px;">Скидки для именинников!</H1>
<p align="left" style="padding-bottom:0px;">Если у вас день рождения, вы можете получить скидку в 15% в нашем ресторане на всё меню! Для получения скидки нужно показать паспорт или свидетельство о рождении.</p>
<img src="HappyB.png" style="width:90%; height:90%;">
<HR color=#E8E8E8>
</div>
<div class="block">
<p align="left" style="color:#c8c8c8; padding-top:40px;" >05-07-2020</p>
<H1 align="left" style="padding-top:10px;">Рестораны вновь открыты!</H1>
<p align="left">В связи со снятием всех ограничений для мест общественного питания с завтрашнего дня все рестораны Bellissimo вновь будут работать в прежнем режиме. Будем рады вновь видеть вас в нашем ресторане!</p>
<HR color=#E8E8E8>
</div>
<div class="block">
<p align="left" style="color:#c8c8c8; padding-top:40px;" >01-03-2020</p>
<H1 align="left" style="padding-top:10px;">Карантин!</H1>
<p align="left">В связи со сложившейся ситуацией в мире ресторан Bellissimo закрывается на неопределенный срок.</p>
<HR color=#E8E8E8>
</div>
</div>
</center>
</body>

</html>
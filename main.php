<?php   /* */
    session_start();   
    if((!isset($_SESSION['log']))&&($_SESSION['log']!=true)) {       
        header('Location:index');  
        $_SESSION['succe']='<script>
            UIkit.notification({message: "<span uk-icon=\'icon: warning\'></span> Brak dostępu!", status: "danger"})
        </script>';
        exit();   
    }  
    $_SESSION['here']="ma";
?> 
<!DOCTYPE HTML>
<html lang="pl">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="shortcut icon" href="img/logo.jpg" type="image/x-icon">
        <!--CSS-->
        <link rel="stylesheet" href="css/uikit.css"/>
        <link rel="stylesheet" href="css/uikit-rtl.css"/>
        <link rel="stylesheet" href="css/styles.css"/>
        <!--JS-->
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/jquery.min.js"></script>
        <script src="js/uikit.js"></script>
        <script src="js/uikit-icons.js"></script>

        <!--ICONS-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/0.8.2/css/flag-icon.min.css"/>
        <!--FONTS-->
        <link href='https://fonts.googleapis.com/css?family=Charmonman' rel='stylesheet'>
        <link href='https://fonts.googleapis.com/css?family=Caveat' rel='stylesheet'>
        <link href='https://fonts.googleapis.com/css?family=Abril Fatface' rel='stylesheet'>
        <link href='https://fonts.googleapis.com/css?family=Amita' rel='stylesheet'>
        <link href='https://fonts.googleapis.com/css?family=Combo' rel='stylesheet'>

        <!-- -->

        <title>Main</title>
    </head>
    <body>
    <!--NAVBAR-->
        <?php 
            include('menu1.php');
        ?>
    <!--MAIN-->
        <main>
            <div id="welcome" class="uk-padding uk-margin uk-height-large uk-background-cover uk-light" uk-parallax="bgy: -300" style="background-image: url('img/welcome.jpg');">
               <div class="uk-margin-auto uk-margin-auto-vertical">
                    <h1>Witaj ponownie!</h1>
                    <p>Witamy ponownie na stronie do obsługi bazy danych "domeny"</p>
                    <button class="uk-button uk-button-default" onclick="window.location.href='view'">Widok</button>
               </div>
            </div>
            <?php if(isset($_SESSION['err'])) echo $_SESSION['err']; unset($_SESSION['err']); ?>
        </main> 
    <!--FOOTER-->    
        <footer>
            <p>Dominika Rzepka &copy; 2021</p>
        </footer>
    </body>
</html>
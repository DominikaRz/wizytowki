<?php /* */
    session_start();   
    if((isset($_SESSION['log']))&&($_SESSION['log']==true)) {       
        header('Location:main');  
        exit();   
    }  
    //$_SESSION['out']=true;
    $_SESSION['here']=="in";
?> 
<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="img/logo.jpg" type="image/x-icon">
    <!--CSS-->
    <link rel="stylesheet" href="css/uikit.css"/>
    <link rel="stylesheet" href="css/uikit-rtl.css"/>
    <link rel="stylesheet" href="css/styles.css"/>
    <link rel="stylesheet" type="text/css" href="css/jquery.multiselect.css"/>
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

    <title>Welcome</title>
  </head>
  <body>
  <!--NAVBAR-->
    <?php 
        include('menu2.php');
    ?>
  <!--MAIN-->
    <main>
      <!--SLIDER + (short) :)-->
        <div id="slider" class="uk-flex uk-flex-middle uk-flex-center">
          <span class="uk-overlay" id="short">
            <h1 class="uk-heading-medium">Wizytówki dla każdego</h1>
            <!--
            <hr style="border: 0.5px solid grey;"/>
            <p>
              Strona służy do obsługi bazy danych "domeny".
            </p>-->
            
        </div>
        <div id="search">
            <style type="text/css">
                ul,li { margin:0; padding:0; list-style:none;}
                .label { color:#000; font-size:16px;}
            </style>
            <form action="search" method="POST">
                <select name="multi[]" class="uk-select" multiple id="multi">
                    <?php 
                        $pol=@mysqli_connect("localhost",'root', 'zaq1@WSX',"domeny");
                        @mysqli_query($pol,'SET NAMES UTF8');
                        $wynik=mysqli_query($pol,'SELECT * FROM BRANZA');
                        while($tab=mysqli_fetch_assoc($wynik)){
                            echo '<option value="'.$tab['id_branza'].'"> '.$tab['nazwa_branza']."</option>";
                        }
                        mysqli_close($pol);
                    ?>
                </select>
                <button class="uk-button uk-button-green" type="submit">Szukaj</button>
            </form>
                <!-- JavaScript -->
            <script src="js/jquery-3.2.1.min.js"></script>
            <script src="js/jquery.multiselect.js"></script>
            <script>
                $('#multi').multiselect({
                    columns: 1,
                    placeholder: 'Wybierz branże',
                    search: true
                });
            </script>
        </div>
        <div id="branze">
            <div class="uk-child-width-1-2@s uk-child-width-1-3@m uk-margin uk-padding" uk-grid="masonry: true">
                <?php
                    $pol=@mysqli_connect("localhost",'root', 'zaq1@WSX',"domeny");
                    @mysqli_query($pol,'SET NAMES UTF8');
                    $wynik=mysqli_query($pol,'SELECT DISTINCT BRANZA_WIZYT.id_branza, nazwa_branza FROM BRANZA,BRANZA_WIZYT WHERE BRANZA_WIZYT.id_branza=BRANZA.id_branza');
                    while($tab=mysqli_fetch_assoc($wynik)){
                echo '<div>
                        <div class="uk-flex uk-flex-center uk-flex-middle">
                            <div class="uk-card uk-card-default uk-card-body">
                                <h3 class="uk-card-title">'.$tab['nazwa_branza'].'</h3>
                                <p>
                                    <ul class="uk-list">';
                                    $query=mysqli_query($pol,'SELECT BRANZA_WIZYT.id_wizytowka, WIZYTOWKA.domena_wizyt FROM WIZYTOWKA,BRANZA_WIZYT WHERE BRANZA_WIZYT.id_wizytowka=WIZYTOWKA.id_wizytowka AND BRANZA_WIZYT.id_branza='.$tab['id_branza']);
                                    while($tab1=mysqli_fetch_assoc($query)){
                                        echo '<li><a href="card.php?id='.$tab1['id_wizytowka'].'">'.$tab1['domena_wizyt'].'</a></li>';
                                    }
                            echo '</ul>
                                </p> 
                            </div>
                        </div>
                    </div>';
                    }
                    mysqli_close($pol);
                ?>
            </div>
        </div>
    </main>
    <footer>
        <div id="rights">
            <p>Dominika Rzepka &copy; 2021</p>
            <?php if(isset($_SESSION['succe'])) echo $_SESSION['succe']; unset($_SESSION['succe']); ?>
        </div>
    </footer>
  </body>
</html>
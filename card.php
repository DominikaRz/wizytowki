<?php /* */
    session_start();   
    if((isset($_SESSION['log']))&&($_SESSION['log']==true)) {       
        header('Location:main.php');  
        exit();   
    }  
    $_SESSION['out']=true;
    $_SESSION['here']=="br"
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
        <?php
            $pol=@mysqli_connect("localhost","root","zaq1@WSX","domeny");
            @mysqli_query($pol,'SET NAMES UTF8');
            $query='SELECT DISTINCT WIZYTOWKA.id_wizytowka,domena_wizyt,opis_skr_wizyt,adr_ul_dane,adr_nr_dane,adr_miast_dane,adr_kod_dane,adr_pocz_dane,telefon_dane,mail_dane,str_int_dane,opis_dane,geo_lat,geo_lon FROM WIZYTOWKA, DANE_WIZYT WHERE WIZYTOWKA.id_wizytowka=DANE_WIZYT.id_wizytowka AND WIZYTOWKA.id_wizytowka='.$_GET['id'];
            $wynik=mysqli_query($pol, $query);
            while($dane=mysqli_fetch_row($wynik)){
                echo '
                <div id="dane">
                    <div id="title" class="uk-flex uk-flex-middle uk-flex-center">
                        <span class="uk-overlay" id="short">
                            <h1 class="uk-heading-medium">'.$dane[1].'</h1>  
                            <h3>'.$dane[2].'</h3>
                        </span>
                    </div>
                    <div class="uk-margin" uk-grid>
                        <div class="uk-width-1-2@m">
                            <h4>Adres:</h4>
                            <p>
                                '.$dane[5].' ul. '.$dane[3].' '.$dane[4].'<br>
                                '.$dane[6].' '.$dane[7].
                            '</p>
                        </div>
                        <div class="uk-width-1-2@m uk-margin">
                            <ul class="uk-list uk-list-collapse ">
                                <li><span uk-icon="icon: receiver"></span> tel: '.$dane[8].'</li>
                                <li><span uk-icon="icon: mail"></span> mail: '.$dane[9].'</li>
                                <li><span uk-icon="icon: world"></span> str: '.$dane[10].'</li>
                            </ul>
                        </div>
                    </div> 
                    <div class="uk-margin">  
                        <iframe width="100%" height="250" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q='.$dane[12].','.$dane[13].'&amp;key=AIzaSyCg-NuXqdDnV5y5GgBVDj2H6wzI4kkQ8EM"></iframe>
                    </div> 
                    <div class="uk-margin">
                        <h4>Opis:</h4> 
                        <p>'.$dane[11].'</p>
                    </div>
                </div>';
            }
        ?>
        </div>
    </main>
    <footer>
        <div id="rights">
            <p>Dominika Rzepka &copy; 2021</p>
        </div>
    </footer>
  </body>
</html>
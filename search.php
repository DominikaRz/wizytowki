<?php /* */
    session_start();   
    if((isset($_SESSION['log']))&&($_SESSION['log']==true)) {       
        header('Location:main.php');  
        exit();   
    }  
    $_SESSION['out']=true;
    $_SESSION['here']=="br";
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
        <!--SELECT DISTINCT WIZYTOWKA.id_wizytowka,domena_wizyt,opis_skr_wizyt,telefon_dane,mail_dane,str_int_dane FROM WIZYTOWKA, DANE_WIZYT WHERE WIZYTOWKA.id_wizytowka=DANE_WIZYT.id_wizytowka AND WIZYTOWKA.id_wizytowka=7-->
        <div id="csearch" uk-grid>
            <?php
            if((isset($_GET['id']))){
                $pol=@mysqli_connect("localhost","root","zaq1@WSX","domeny");
                @mysqli_query($pol,'SET NAMES UTF8');
                $query='SELECT DISTINCT domena_wizyt,opis_skr_wizyt,telefon_dane,mail_dane,WIZYTOWKA.id_wizytowka FROM WIZYTOWKA, DANE_WIZYT, BRANZA_WIZYT WHERE WIZYTOWKA.id_wizytowka=DANE_WIZYT.id_wizytowka AND BRANZA_WIZYT.id_wizytowka=WIZYTOWKA.id_wizytowka AND BRANZA_WIZYT.id_branza='.$_GET['id'];    //$_GET['id']
                $wynik=mysqli_query($pol, $query);
                while($dane=mysqli_fetch_row($wynik)){
                    echo '
                        <div class="uk-margin">
                            <div class="uk-card uk-card-default">
                                <div class="uk-card-body">
                                    <h2><a href="card?id='.$dane[4].'" class="uk-button uk-button-text">'.$dane[0].'</a></h2>
                                    <h4>'.$dane[1].'</h4>
                                    <p><span uk-icon="receiver"> '.$dane[2].'</p>
                                    <p><span uk-icon="mail"> '.$dane[3].'</p>
                                </div>
                            </div>
                        </div>';
                }
            }
            else {
                $pol=@mysqli_connect("localhost","root","zaq1@WSX","domeny");
                @mysqli_query($pol,'SET NAMES UTF8');
                foreach ($_POST['multi'] as $key => $i) {
                    if(isset($_POST['multi'])){
                    $query='SELECT DISTINCT domena_wizyt,opis_skr_wizyt,telefon_dane,mail_dane,str_int_dane FROM WIZYTOWKA, DANE_WIZYT, BRANZA_WIZYT WHERE WIZYTOWKA.id_wizytowka=DANE_WIZYT.id_wizytowka AND BRANZA_WIZYT.id_wizytowka=WIZYTOWKA.id_wizytowka AND BRANZA_WIZYT.id_branza='.$i;    //$_GET['id']
                        $wynik=mysqli_query($pol, $query);
                        while($dane=mysqli_fetch_row($wynik)){
                            echo '
                                <div class="uk-margin">
                                    <div class="uk-card uk-card-default">
                                        <div class="uk-card-body">
                                            <h2>'.$dane[0].'</h2>
                                            <p>'.$dane[1].'</p>
                                            <p><span uk-icon="receiver"> '.$dane[2].'</p>
                                            <p><span uk-icon="mail"> '.$dane[3].'</p>
                                            <a href="#" class="uk-button uk-button-text">Read more</a>
                                        </div>
                                    </div>
                                </div>';
                        }
                    }
                }
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
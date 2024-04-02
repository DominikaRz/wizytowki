<?php /* */
    session_start();   
    if((!isset($_SESSION['log']))&&($_SESSION['log']!=true)) {       
        header('Location:index');  
        $_SESSION['succe']='<script>
            UIkit.notification({message: "<span uk-icon=\'icon: warning\'></span> Brak dostępu!", status: "danger"})
        </script>';
        exit();   
    } 
    $_SESSION['here']="vi";
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
        <style>
            .uk-table th{
                text-align: left !important;
            }
        </style>
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
            //include('menu.html');
            include('menu1.php');
        ?>
    <!--MAIN-->
        <?php
            $pol=@mysqli_connect("localhost","{$_SESSION['login']}","{$_SESSION['haslo']}","domeny");
            @mysqli_query($pol,'SET NAMES UTF8');
            $actual_link = "$_SERVER[REQUEST_URI]";
            //$actual_link = $_SERVER['argv[]'];
            //$indicesServer = array('argv');
            //echo $indicesServer;
        ?>
        <?php //if(strpos($actual_link, '.php') !== false) echo 'aria-expanded="true"';?>
        <main class="uk-padding uk-margin">
            <ul uk-tab>
                <li><!--aria-expanded="true"-->
                    
                    <a href="#">BRANZA</a>
                </li> 
                <li <?php if(strpos($actual_link, 'vi') !== false) echo 'class="uk-active"';?>>
                    <a href="#" <?php if(strpos($actual_link, 'vi') !== false) echo 'aria-expanded="true"';?> >WIZYTÓWKA</a>
                </li>
                <li>
                    <a href="#">UMOWA</a>
                </li>
                <li>
                    <a href="#">ZAMAWIAJĄCY</a>
                </li>
                <li>
                    <a href="#">FAKTURA</a>
                </li>
            </ul>

            <ul id="wypisz" class="uk-switcher uk-margin">
              <!--BRANZA-->
                <li>
                    <table class="uk-table uk-table-hover uk-table-divider">
                        <caption><h4><a href="add?s=BRANZA" uk-icon="icon: plus">Dodaj do bazy </a></h4></caption>
                        <thead>
                            <tr>
                                <th>Lp</th>
                                <th>Nazwa</th>
                                <th>Akcje</th>
                            </tr>
                        </thead>
                        <tbody> 
                            <?php
                                $query='SELECT * FROM BRANZA;';
                                $wynik=mysqli_query($pol, $query);
                                while($dane=mysqli_fetch_row($wynik)){
                                    echo '<tr>
                                            <td>'.$dane[0].'</td>
                                            <td>'.$dane[1].'</td> 
                                            <td>
                                                <a href="edit?s=BRANZA&id='.$dane[0].'" uk-icon="icon: file-edit" uk-tooltip="edytuj"></a>
                                                <a href="delete?s=BRANZA&id='.$dane[0].'" uk-icon="icon: trash" uk-tooltip="usuń"  onclick="return confirm(\'Jesteś pewien, że chcesz usunąć ten rekord?\');"></a>
                                            </td>
                                        </tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </li>
              <!--WIZYTOWKA-->    
                <li <?php if(strpos($actual_link, 'vi') !== false) echo 'class="uk-active"';?> > <!--class="uk-active"-->
                    <table class="uk-table uk-table-hover uk-table-divider">
                        <caption><h4><a href="add?s=WIZYTOWKA" uk-icon="icon: plus">Dodaj do bazy </a></h4></caption>
                        <thead>
                            <tr>
                                <th>Lp</th>
                                <th>Domena</th>
                                <th>Skrócony opis</th>
                                <th>Adres</th>
                                <th>tel, mail, www</th>
                                <th>Opis</th>
                                <th>Dane geograficzne</th>
                                <th>Akcje</th>
                            </tr>
                        </thead>
                        <tbody> 
                            <?php
                                $query='SELECT DISTINCT WIZYTOWKA.id_wizytowka,domena_wizyt,opis_skr_wizyt,adr_ul_dane,adr_nr_dane,adr_miast_dane,adr_kod_dane,adr_pocz_dane,telefon_dane,mail_dane,str_int_dane,opis_dane,geo_lat,geo_lon FROM WIZYTOWKA, DANE_WIZYT WHERE WIZYTOWKA.id_wizytowka=DANE_WIZYT.id_wizytowka;';
                                $wynik=mysqli_query($pol, $query);
                                $i=1;
                                while($dane=mysqli_fetch_row($wynik)){
                                    echo '<tr>
                                            <td>'.$i.'</td>
                                            <td>'.$dane[1].' </td> 
                                            <td>'.$dane[2].'</td> 
                                            <td>'.$dane[3].' '.$dane[4].' '.$dane[5].' '.$dane[6].' '.$dane[7].'</td> 
                                            <td>'.$dane[8].'<br>'.$dane[9].'<br>'.$dane[10].'</td> 
                                            <td width="500">'.$dane[11].'</td> 
                                            <td>dł: '.$dane[12].', sz: '.$dane[13].'</td>
                                            <td>
                                                <a href="edit?s=WIZYTOWKA&id='.$dane[0].'" uk-icon="icon: file-edit" uk-tooltip="edytuj"></a>
                                                <a href="delete?s=WIZYTOWKA&id='.$dane[0].'" uk-icon="icon: trash" uk-tooltip="usuń" onclick="return confirm(\'Jesteś pewien, że chcesz usunąć ten rekord?\');"></a>
                                            </td> 
                                        </tr>';
                                    $i++;
                                    //
                                }
                            ?>
                        </tbody>
                    </table>
                </li>
              <!--UMOWA-->
                <li>
                    <table class="uk-table uk-table-hover uk-table-divider">
                        <caption><h4><a href="add?s=UMOWA" uk-icon="icon: plus">Dodaj do bazy </a></h4></caption>
                        <thead>
                            <tr>
                                <th>Lp</th>
                                <th>Domena</th>
                                <th>Data zawarcia umowy</th>
                                <th>Rodzaj umowy</th>
                                <th>Opis</th>
                                <th>Dodatkowe miejsce</th>
                                <th>Ilość miejsca</th>
                                <th>Akcje</th>
                            </tr>
                        </thead> 
                        <tbody>
                            <?php
                               $query='SELECT FORMA_UMOWA.id_forma, WIZYTOWKA.domena_wizyt, FORMA_UMOWA.czas_zawarcia_forma, FORMA_UMOWA.czas_zakonczenia_forma, FORMA_UMOWA.nazwa_forma, FORMA_UMOWA.opis_forma, FORMA_UMOWA.serwer_forma, FORMA_UMOWA.wielkosc_serwer_forma FROM FORMA_UMOWA,WIZYTOWKA WHERE WIZYTOWKA.id_wizytowka=FORMA_UMOWA.id_wizytowka ORDER BY FORMA_UMOWA.czas_zawarcia_forma DESC';
                               $wynik=mysqli_query($pol, $query);
                               while($dane=mysqli_fetch_row($wynik)){
                                   echo '<tr>
                                           <td>'.$dane[0].'</td>
                                           <td>'.$dane[1].'</td>
                                           <td>'.$dane[2].'</td> 
                                           <td>'.$dane[4].'</td> 
                                           <td>'.$dane[5].'</td> 
                                           <td>';
                                           if($dane[6]==0) echo 'Nie'; else echo 'Tak';
                                    echo '</td> 
                                           <td>'.$dane[7].'</td> 
                                           <td>
                                                <a href="edit?s=UMOWA&id='.$dane[0].'" uk-icon="icon: file-edit" uk-tooltip="edytuj"></a>
                                                <a href="delete?s=UMOWA&id='.$dane[0].'" uk-icon="icon: trash" uk-tooltip="usuń"  onclick="return confirm(\'Jesteś pewien, że chcesz usunąć ten rekord?\');"></a>
                                            </td>
                                       </tr>';
                               }
                            ?>
                        </tbody>
                    </table>
                </li>
              <!--ZAMAWIAJACY-->
                <li>
                    <table class="uk-table uk-table-hover uk-table-divider">
                        <caption><h4><a href="add?s=ZAMAWIAJACY" uk-icon="icon: plus">Dodaj do bazy </a></h4></caption>
                        <thead>
                            <tr>
                                <th>Lp</th>
                                <th>Imie i nazwisko</th>
                                <th>Nazwa firmy</th>
                                <th>Telefon</th>
                                <th>Email</th>
                                <th>Adres</th>
                                <th>Poczta</th>
                                <th>PESEL</th>
                                <th>NIP</th>
                                <th>Akcje</th>
                            </tr>
                        </thead>     
                        <tbody> 
                            <?php
                               $query='SELECT * FROM ZAMAWIAJACY';
                               $wynik=mysqli_query($pol, $query);
                               while($dane=mysqli_fetch_row($wynik)){
                                   echo '<tr>
                                           <td>'.$dane[0].'</td> 
                                           <td>'.$dane[1].' '.$dane[2].'</td> 
                                           <td>'.$dane[3].'</td> 
                                           <td>'.$dane[4].'</td> 
                                           <td>'.$dane[5].'</td> 
                                           <td>'.$dane[6].' '.$dane[7].' '.$dane[8].'</td> 
                                           <td>'.$dane[9].' '.$dane[10].'</td> 
                                           <td>'.$dane[11].'</td> 
                                           <td>'.$dane[12].'</td>
                                           <td>
                                                <a href="edit?s=ZAMAWIAJACY&id='.$dane[0].'" uk-icon="icon: file-edit" uk-tooltip="edytuj"></a>
                                                <a href="delete?s=ZAMAWIAJACY&id='.$dane[0].'" uk-icon="icon: trash" uk-tooltip="usuń" onclick="return confirm(\'Jesteś pewien, że chcesz usunąć ten rekord?\');"></a>
                                            </td> 
                                       </tr>';
                               }
                            ?>
                        </tbody>
                    </table>
                </li>
              <!--FAKTURA-->
                <li>
                    <table class="uk-table uk-table-hover uk-table-divider">
                        <caption><h4><a href="add?s=FAKTURA" uk-icon="icon: plus">Dodaj do bazy </a></h4></caption>
                        <thead>
                            <tr>
                                <th>Lp</th>
                                <th>Domena</th>
                                <th>Imie i nazwisko</th>
                                <th>Adres</th>
                                <th>Telefon</th>
                                <th>PESEL, NIP</th>
                                <th>Data zawarcia umowy</th>
                                <th>Rabat</th>
                                <th>Kwota Netto</th>
                                <th>Podatek VAT</th>
                                <th>Kwota brutto</th>
                                <th>Akcje</th>
                            </tr>
                        </thead>    
                        <tbody> 
                            <?php
                                $query='SELECT UMOWA.id_umowa, domena_wizyt,imie_zamaw,nazwisko_zamaw,adres_ul_zamaw,adres_nr_zamaw,adres_kod_zamaw,adres_miast_zamaw,telefon_zamaw,pesel_zamaw,nip_zamaw,data_umowa,rabat_umowa,netto_umowa,vat_umowa,kwota_umowa FROM UMOWA, ZAMAWIAJACY, WIZYTOWKA, WIZYT_UMOWA WHERE UMOWA.id_zamawiajacy = ZAMAWIAJACY.id_zamawiajacy AND WIZYT_UMOWA.id_umowa = UMOWA.id_umowa AND WIZYT_UMOWA.id_wizytowka = WIZYTOWKA.id_wizytowka ORDER BY UMOWA.id_umowa DESC';
                                $wynik=mysqli_query($pol, $query);
                                while($dane=mysqli_fetch_row($wynik)){
                                    echo '<tr>
                                            <td>'.$dane[0].'</td>
                                            <td>'.$dane[1].'</td> 
                                            <td>'.$dane[2].' '.$dane[3].'</td> 
                                            <td>'.$dane[4].' '.$dane[5].'<br>'.$dane[6].' '.$dane[7].'</td> 
                                            <td>'.$dane[8].'</td> 
                                            <td>'.$dane[9].', '.$dane[10].'</td>
                                            <td>'.$dane[11].'</td> 
                                            <td>'.$dane[12].'</td> 
                                            <td>'.$dane[13].'</td> 
                                            <td>'.$dane[14].'</td> 
                                            <td>'.$dane[15].'</td> 
                                            <td>
                                                <a href="edit?s=FAKTURA&id='.$dane[0].'" uk-icon="icon: file-edit" uk-tooltip="edytuj"></a>
                                                <a href="delete?s=FAKTURA&id='.$dane[0].'" uk-icon="icon: trash" uk-tooltip="usuń" onclick="return confirm(\'Jesteś pewien, że chcesz usunąć ten rekord?\');"></a>
                                             </td>
                                        </tr>';
                                } 
                            ?>
                        </tbody>
                    </table>
                </li>
            </ul>
            <?php 
                mysqli_close($pol);
            ?>
            <?php if(isset($_SESSION['ok'])) echo $_SESSION['ok']; unset($_SESSION['ok']); ?>
        </main> 
    <!--FOOTER-->    
        <footer>
            <div id="rights">
                <p>Dominika Rzepka &copy; 2021</p>
            </div>
        </footer>
    </body>
</html>
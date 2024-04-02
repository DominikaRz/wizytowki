<?php   
if((!isset($_SESSION['log']))&&($_SESSION['log']!=true)) {       
    header('Location:index');  
    $_SESSION['succe']='<script>
        UIkit.notification({message: "<span uk-icon=\'icon: warning\'></span> Brak dostępu!", status: "danger"})
    </script>';
    exit();   
} 
else{
     echo '
        <div uk-sticky="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky; bottom: #transparent-sticky-navbar">
            <nav class="uk-navbar-container" style="position: relative; z-index: 980;" uk-navbar>
                <div class="uk-navbar-left">
                    <ul class="uk-navbar-nav">
                        <li uk-toggle="target: #struktura"><a href="#">Struktura</a></li>
                        <li'; if($_SESSION['here']=="ma") echo ' class="uk-active"'; 
                        echo '><a href="main">Strona główna</a></li>
                        <li'; if($_SESSION['here']=="vi") echo ' class="uk-active"'; 
                        echo '>
                            <a href="view">CRUD</a>
                            <div class="uk-navbar-dropdown">
                                <ul class="uk-nav uk-navbar-dropdown-nav">
                                    <li><a href="view">Branże</a></li>
                                    <li><a href="view">Wizytówki</a></li>
                                    <li><a href="view">Zamawiający</a></li>
                                    <li><a href="view">Umowy</a></li>
                                </ul>
                            </div>
                        </li>
                        <li><a href="view">Dokumenty</a></li>
                        <li'; if($_SESSION['here']=="po") echo ' class="uk-active"'; 
                        echo '><a href="pomoc">Pomoc</a>
                        </li>
                    </ul>
                </div>
                <div class="uk-navbar-right">
                    <div uk-grid>
                        <p>
                            <a class="uk-button uk-button-default" href="out" uk-toggle>Wyloguj</a>
                        </p>
                    </div>
                </div>
            </nav>
        </div>
            <div id="struktura" uk-offcanvas="overlay: true">
                <button class="uk-offcanvas-close" type="button" uk-close></button>
                <div class="uk-offcanvas-bar uk-flex uk-flex-column">
                    <ul class="uk-nav uk-nav-primary uk-nav-center uk-margin-auto-vertical">
                        <li class="uk-active">Struktura bazy</li>
                        <li class="uk-parent">
                            <a href="#">BRANZA</a>
                            <ul class="uk-nav-sub">
                                <li class="uk-text-success">id PK</li>
                                <li>nazwa_branza (20)</li>
                            </ul>
                        </li>
                        <li class="uk-nav-divider"></li>
                        <li class="uk-parent">
                            <a href="#">BRANZA_WIZYT</a>
                            <ul class="uk-nav-sub">
                                <li class="uk-text-primary">id_branza FK</li>
                                <li class="uk-text-primary">id_wizytowka FK</li>
                            </ul>
                        </li>
                        <li class="uk-nav-divider"></li>
                        <li class="uk-parent">
                            <a href="#">WIZYTOWKA</a>
                            <ul class="uk-nav-sub">
                                <li class="uk-text-success">id_wizytowka</li>
                                <li>domena_wizyt (45)</li>
                                <li>logo</li>
                                <li>opis_skrocony</li>
                            </ul>
                        </li>
                        <li class="uk-nav-divider"></li>
                        <li class="uk-parent">
                            <a href="#">DANE_WIZYT</a>
                            <ul class="uk-nav-sub">
                                <li class="uk-text-success">id PK</li>
                                <li class="uk-text-primary">id_wizytowka FK</li>
                                <li>adr_ul (56)</li>
                                <li>adr_nr (10)</li>
                                <li>adr_miast (40)</li>
                                <li>adr_kod (6)</li>
                                <li>adr_pocz (40)</li>
                                <li>telefon (11)</li>
                                <li>mail (100)</li>
                                <li>str_int (63)</li>
                                <li>opis (2000)</li>
                                <li>geo_lat (18)</li>
                                <li>geo_lon (18)</li>
                            </ul>
                        </li>
                        <li class="uk-nav-divider"></li>
                        <li class="uk-parent">
                            <a href="#">FORMA_UMOWA</a>
                            <ul class="uk-nav-sub">
                                <li class="uk-text-success">id PK</li>
                                <li class="uk-text-primary">id_wizytowka FK</li>
                                <li>nazwa (10)</li>
                                <li>czas_zawarcia (datetime)</li>
                                <li>czas_zakonczenia (datetime)</li>
                                <li>serwer (bool)</li>
                                <li>wielkosc_serwer (float)</li>
                                <li>opis (400)</li>
                            </ul>
                        </li>
                        <li class="uk-nav-divider"></li>
                        <li class="uk-parent">
                            <a href="#">WIZYT_UMOWA</a>
                            <ul class="uk-nav-sub">
                                <li class="uk-text-primary">id_wizytowka FK</li>
                                <li class="uk-text-primary">id_umowa FK</li>
                            </ul>
                        </li>
                        <li class="uk-nav-divider"></li>
                        <li class="uk-parent">
                            <a href="#">UMOWA</a>
                            <ul class="uk-nav-sub">
                                <li class="uk-text-success">id_umowa PK</li>
                                <li class="uk-text-primary">id_zamawiajacy FK</li>
                                <li>data (date)</li>
                                <li>netto (float)</li>
                                <li>rabat (int)</li>
                                <li>VAT (float)</li>
                                <li>kwota (float)</li>
                            </ul>
                        </li>
                        <li class="uk-nav-divider"></li>
                        <li class="uk-parent">
                            <a href="#">ZAMAWIAJACY</a>
                            <ul class="uk-nav-sub">
                                <li class="uk-text-success">id_zamawiajacy PK</li>
                                <li>imie (13)</li>
                                <li>nazwisko (27)</li>
                                <li>nazwa_firmy (40)</li>
                                <li>telefon (11)</li>
                                <li>mail (100)</li>
                                <li>adres_ul (56)</li>
                                <li>adres_nr (10)</li>
                                <li>adres_miast (40)</li>
                                <li>adres_kod (6)</li>
                                <li>adres_pocz (40)</li>
                                <li>PESEL (11)</li>
                                <li>NIP (10)</li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>';
    
}
?>
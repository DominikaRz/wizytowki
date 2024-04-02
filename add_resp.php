<?php /* */
    session_start();   
    if((!isset($_SESSION['log']))&&($_SESSION['log']!=true)) {       
        header('Location:index');  
        $_SESSION['succe']='<script>
            UIkit.notification({message: "<span uk-icon=\'icon: warning\'></span> Brak dostępu!", status: "danger"})
        </script>';
        exit();   
    } 
   
    $pol=@mysqli_connect("localhost",'root', 'zaq1@WSX',"domeny") or die ("Błąd!");
    //$pol=@mysqli_connect("localhost","{$_SESSION['login']}","{$_SESSION['haslo']}","domeny");
    @mysqli_query($pol,'SET NAMES UTF8');
    //$value=$_SESSION['add'];
    //$value="BRANZA";
    //$value="WIZYTOWKA";
    //$value="UMOWA";
    //$value="ZAMAWIAJACY";
    $value=$_GET['s'];
    if($pol==true){
        switch($value){
            case "BRANZA": //✓ Działa
                $query='INSERT INTO `BRANZA`( `nazwa_branza`) VALUES ("'.$_POST['nazwa'].'")';
                $wynik=mysqli_query($pol, $query);
                if($wynik !== false){
                    header('Location:view');
                    $_SESSION['ok']=
                    '<script>
                        UIkit.notification({message: "<span uk-icon=\'icon: check\'></span> Dodano!", status: "success"})
                    </script>';
                    exit();
                }
                else {
                    header('Location:view');
                    $_SESSION['ok']='
                    <script>
                        UIkit.notification({message: "<span uk-icon=\'icon: warning\'></span> Błąd dodania!", status: "danger"})
                    </script>';
                    exit();
                }
            break;
            case "WIZYTOWKA": //✓ Działa
                $query1='INSERT INTO WIZYTOWKA (domena_wizyt, opis_skr_wizyt) VALUES ("'.$_POST['domena'].'","'.$_POST['opis_skr'].'")';
                $wynik1=mysqli_query($pol, $query1) or die('Błąd');
                if(($wynik1 !== false)){
                    $res = mysqli_fetch_row(mysqli_query($pol, "SELECT MAX(WIZYTOWKA.id_wizytowka) FROM WIZYTOWKA"));
                    $id = $res[0];
                    $query2='INSERT INTO DANE_WIZYT (id_wizytowka, adr_ul_dane, adr_nr_dane, adr_miast_dane, adr_kod_dane, adr_pocz_dane, telefon_dane, mail_dane, str_int_dane, opis_dane, geo_lat, geo_lon) VALUES ('.$id.',"'.$_POST['ul'].'","'.$_POST['nr'].'","'.$_POST['miasto'].'","'.$_POST['kod'].'","'.$_POST['poczta'].'","'.$_POST['tel'].'","'.$_POST['mail'].'","'.$_POST['str'].'","'.$_POST['opis'].'","'.$_POST['lat'].'","'.$_POST['lon'].'");';
                    $wynik2=mysqli_query($pol, $query2);
                    if(($wynik2 !== false)){
                        //$resb = mysqli_fetch_row(mysqli_query($pol, "SELECT COUNT(BRANZA.id_branza) FROM BRANZA"));
                        //$idb = $resb[0];
                        foreach ($_POST['multi'] as $key => $i) {
                            if(isset($_POST['multi'])){
                                $query3='INSERT INTO `BRANZA_WIZYT`(`id_branza`, `id_wizytowka`) VALUES ('.$i.','.$id.')';
                                echo $query3;
                                $wynik3=mysqli_query($pol, $query3);
                                if(($wynik3 !== false)){
                                    header('Location:view');
                                    $_SESSION['ok']=
                                    '<script>
                                        UIkit.notification({message: "<span uk-icon=\'icon: check\'></span> Dodano!", status: "success"})
                                    </script>';
                                }
                                else {
                                    header('Location:view');
                                    $_SESSION['ok']='
                                    <script>
                                        UIkit.notification({message: "<span uk-icon=\'icon: warning\'></span> Błąd dodania! 1 polaczenie", status: "danger"})
                                    </script>';
                                    exit();
                                }
                            } 
                            else {
                                header('Location:view');
                                $_SESSION['ok']='
                                <script>
                                    UIkit.notification({message: "<span uk-icon=\'icon: warning\'></span> Błąd dodania! połączenia", status: "danger"})
                                </script>';
                                exit();
                            }
                        }
                    }
                    else {
                        header('Location:view');
                        $_SESSION['ok']='
                        <script>
                            UIkit.notification({message: "<span uk-icon=\'icon: warning\'></span> Błąd dodania! dane", status: "danger"})
                        </script>';
                        exit();
                    }
                }
                else {
                    header('Location:view');
                    $_SESSION['ok']='
                    <script>
                        UIkit.notification({message: "<span uk-icon=\'icon: warning\'></span> Błąd połączenia! Wizytówka", status: "danger"})
                    </script>';
                }
                
            
            break;
            case "UMOWA": //✓ Działa
                if(isset($_POST['srv'])) $_POST['srv'] = 1; else $_POST['srv'] = 0; 
                $d=strtotime($_POST['czas']);
                $date=date("Y-m-d h:i", $d);
                $zak=date('Y-m-d h:i', strtotime('+1 year', strtotime($date)));
                $query='INSERT INTO FORMA_UMOWA(id_wizytowka, nazwa_forma, czas_zawarcia_forma, czas_zakonczenia_forma, serwer_forma, wielkosc_serwer_forma, opis_forma) VALUES ('.$_POST['id_domena'].',"'.$_POST['forma'].'","'.$date.'","'.$zak.'",'.$_POST['srv'].','.$_POST['wielk'].',"'.$_POST['opis'].'");';
                $wynik=mysqli_query($pol, $query);
                if($wynik !== false){
                    header('Location:view');
                    $_SESSION['ok']=
                    '<script>
                        UIkit.notification({message: "<span uk-icon=\'icon: check\'></span> Dodano!", status: "success"})
                    </script>';
                    exit(); 
                }
                else {
                    header('Location:view');
                    $_SESSION['ok']='
                    <script>
                        UIkit.notification({message: "<span uk-icon=\'icon: warning\'></span> Błąd dodania!", status: "danger"})
                    </script>';
                    exit();
                }
            break;
            case "ZAMAWIAJACY": //✓ Działa
                $query='INSERT INTO ZAMAWIAJACY(imie_zamaw, nazwisko_zamaw, nazwa_fr_zamaw, telefon_zamaw, mail_zamaw, adres_ul_zamaw, adres_nr_zamaw, adres_miast_zamaw, adres_kod_zamaw, adres_pocz_zamaw, PESEL_zamaw, NIP_zamaw) VALUES ("'.$_POST['imie'].'","'.$_POST['nazwisko'].'","'.$_POST['firma'].'","'.$_POST['tel'].'","'.$_POST['mail'].'","'.$_POST['ul'].'","'.$_POST['nr'].'","'.$_POST['miasto'].'","'.$_POST['kod'].'","'.$_POST['poczta'].'","'.$_POST['PESEL'].'","'.$_POST['NIP'].'");';
                $wynik=mysqli_query($pol, $query);
                if($wynik !== false){
                    header('Location:view');
                    $_SESSION['ok']=
                    '<script>
                        UIkit.notification({message: "<span uk-icon=\'icon: check\'></span> Dodano!", status: "success"})
                    </script>';
                    exit();
                }
                else {
                    /* */
                    header('Location:view');
                    $_SESSION['ok']='
                    <script>
                        UIkit.notification({message: "<span uk-icon=\'icon: warning\'></span> Błąd dodania!", status: "danger"})
                    </script>';
                    exit();
                    //echo $query;
                }
            break;
            case "FAKTURA": //✓ Działa
                $query='INSERT INTO `UMOWA`(`id_zamawiajacy`, `data_umowa`, `netto_umowa`, `rabat_umowa`, `VAT_umowa`, `kwota_umowa`) VALUES ('.$_POST['id'].',"'.$_POST['czas'].'",'.$_POST['netto'].','.$_POST['rabat'].','.$_POST['vat'].','.$_POST['kwota'].');';
                //echo $query;
                $potw=@mysqli_query($pol,$query); //or die("Błąd");
                if($potw !== false){
                    $resb = mysqli_fetch_row(mysqli_query($pol, "SELECT id_umowa FROM UMOWA ORDER BY id_umowa DESC LIMIT 1"));
                    $idb = $resb[0];
                    $query1='INSERT INTO WIZYT_UMOWA(id_wizytowka, id_umowa) VALUES ('.$_POST['id_domena'].','.$idb.');';
                    $potw2=@mysqli_query($pol,$query1);
                    if($potw2 !== false){
                        header('Location:view');
                        $_SESSION['ok']=
                        '<script>
                            UIkit.notification({message: "<span uk-icon=\'icon: check\'></span> Dodano!", status: "success"})
                        </script>';
                        exit();
                    }
                    else {
                        header('Location:view');
                        $_SESSION['ok']='
                        <script>
                            UIkit.notification({message: "<span uk-icon=\'icon: warning\'></span> Błąd dodania!", status: "danger"})
                        </script>';
                        exit();
                        //echo $query;
                    }
                }
                else {
                    header('Location:view');
                    $_SESSION['ok']='
                    <script>
                        UIkit.notification({message: "<span uk-icon=\'icon: warning\'></span> Błąd dodania!", status: "danger"})
                    </script>';
                    exit();
                    //echo $query;
                }
            break;
            default: 
                header('Location:main');
                    $_SESSION['err']='
                    <script>
                        UIkit.notification({message: "<span uk-icon=\'icon: warning\'></span> Nieprawidłowe dane!", status: "danger"})
                    </script>';
                    exit();
            break;
        }
        mysqli_close($pol);
    }
?>
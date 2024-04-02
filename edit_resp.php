<?php /* */
    session_start();   
    if((!isset($_SESSION['log']))&&($_SESSION['log']!=true)) {       
        header('Location:index');  
        $_SESSION['succe']='<script>
            UIkit.notification({message: "<span uk-icon=\'icon: warning\'></span> Brak dostępu!", status: "danger"})
        </script>';
        exit();   
    } 

    $pol=@mysqli_connect("localhost",'root', 'zaq1@WSX',"domeny");
    //$pol=@mysqli_connect("localhost","{$_SESSION['login']}","{$_SESSION['haslo']}","domeny");
    @mysqli_query($pol,'SET NAMES UTF8');
    //$id=2;
    //$value=$_SESSION['edit'];
    //$value="BRANZA";
    //$value="WIZYTOWKA";
    //$value="UMOWA";
    //$value="ZAMAWIAJACY";
    //$value="FAKTURA";
    $id=$_GET['id'];
    $value=$_GET['s'];
    if($pol==true){
        switch($value){
            case "BRANZA": //✓ Działa
                $query='UPDATE BRANZA SET nazwa_branza="'.$_POST['nazwa'].'" WHERE id_branza='.$id;
                $potw=@mysqli_query($pol,$query); // or die("Błąd")
                if($potw){
                    header('Location:main');  
                    $_SESSION['err']='<script>
                        UIkit.notification({message: "<span uk-icon=\'icon: success\'></span> Edycja zakończona sukcesem!", status: "success"})
                    </script>';
                    exit();   
                }
                else {
                    header('Location:view');
                    $_SESSION['ok']='
                    <script>
                        UIkit.notification({message: "<span uk-icon=\'icon: warning\'></span> Błąd edycji!", status: "danger"})
                    </script>';
                    exit();
                }
            break;
            case "WIZYTOWKA": //✓ Działa 
                $query='UPDATE WIZYTOWKA SET domena_wizyt="'.$_POST['domena'].'", opis_skr_wizyt="'.$_POST['opis_skr'].'" WHERE id_wizytowka='.$id;
                $query1='UPDATE DANE_WIZYT SET adr_ul_dane="'.$_POST['ul'].'",adr_nr_dane="'.$_POST['nr'].'",adr_miast_dane="'.$_POST['miasto'].'",adr_kod_dane="'.$_POST['kod'].'",adr_pocz_dane="'.$_POST['poczta'].'",telefon_dane="'.$_POST['tel'].'",mail_dane="'.$_POST['mail'].'",str_int_dane="'.$_POST['str'].'",opis_dane="'.$_POST['opis'].'",geo_lat="'.$_POST['lat'].'",geo_lon="'.$_POST['lon'].'" WHERE id_wizytowka='.$id;
                $potw=@mysqli_query($pol,$query) or die("Błąd1");
                if($potw){
                    $potw1=@mysqli_query($pol,$query1) or die("Błąd2");
                    if($potw1){
                        header('Location:view');
                        $_SESSION['ok']=
                        '<script>
                            UIkit.notification({message: "<span uk-icon=\'icon: check\'></span> Dokonano edycji!", status: "success"})
                        </script>';
                        exit();
                    }
                    else {
                        header('Location:view');
                        $_SESSION['ok']='
                        <script>
                            UIkit.notification({message: "<span uk-icon=\'icon: warning\'></span> Błąd edycji!", status: "danger"})
                        </script>';
                        exit();
                    }
                }
                else {
                    header('Location:view');
                    $_SESSION['ok']='
                    <script>
                        UIkit.notification({message: "<span uk-icon=\'icon: warning\'></span> Błąd edycji!", status: "danger"})
                    </script>';
                    exit();
                }
                //echo $query1;
                
            break;
            case "UMOWA": //✓ Działa
                if(isset($_POST['srv'])) $_POST['srv'] = 1; else $_POST['srv'] = 0; 
                $d=strtotime($_POST['czas']);
                $date=date("Y-m-d h:i", $d);
                $zak=date('Y-m-d h:i', strtotime('+1 year', strtotime($date)));
                $query='UPDATE FORMA_UMOWA SET id_wizytowka='.$_POST['id_wizyt'].', nazwa_forma="'.$_POST['forma'].'",czas_zawarcia_forma="'.$date.'",czas_zakonczenia_forma="'.$zak.'",serwer_forma='.$_POST['srv'].',wielkosc_serwer_forma='.$_POST['wielk'].',opis_forma="'.$_POST['opis'].'" WHERE id_forma='.$id;
                $potw=@mysqli_query($pol,$query); //or die("Błąd");		
                if($potw){
                    header('Location:view');
                    $_SESSION['ok']=
                    '<script>
                        UIkit.notification({message: "<span uk-icon=\'icon: check\'></span> Dokonano edycji!", status: "success"})
                    </script>';
                    exit();
                    //echo $query."<br>".$potw; 
                }
                else {
                    header('Location:view');
                    $_SESSION['ok']='
                    <script>
                        UIkit.notification({message: "<span uk-icon=\'icon: warning\'></span> Błąd edycji!", status: "danger"})
                    </script>';
                    exit();
                    //echo $query."<br>".$potw; 
                }
            break;
            case "ZAMAWIAJACY": //✓ Działa
                $query='UPDATE `ZAMAWIAJACY` SET `imie_zamaw`="'.$_POST['imie'].'",`nazwisko_zamaw`="'.$_POST['nazwisko'].'",`nazwa_fr_zamaw`="'.$_POST['firma'].'",`telefon_zamaw`="'.$_POST['tel'].'",`mail_zamaw`="'.$_POST['mail'].'",`adres_ul_zamaw`="'.$_POST['ul'].'",`adres_nr_zamaw`="'.$_POST['nr'].'",`adres_miast_zamaw`="'.$_POST['miasto'].'",`adres_kod_zamaw`="'.$_POST['kod'].'",`adres_pocz_zamaw`="'.$_POST['poczta'].'",`PESEL_zamaw`="'.$_POST['PESEL'].'",`NIP_zamaw`="'.$_POST['NIP'].'" WHERE id_zamawiajacy='.$id;
                $potw=@mysqli_query($pol,$query) or die("Błąd");
                if($potw){
                    header('Location:view');
                    $_SESSION['ok']=
                    '<script>
                        UIkit.notification({message: "<span uk-icon=\'icon: check\'></span> Dokonano edycji!", status: "success"})
                    </script>';
                    exit();;
                }
                else {
                    header('Location:view');
                    $_SESSION['ok']='
                    <script>
                        UIkit.notification({message: "<span uk-icon=\'icon: warning\'></span> Błąd edycji!", status: "danger"})
                    </script>';
                    exit();
                }
            break;
            case "FAKTURA": //✓ Działa
                $query='UPDATE `UMOWA` SET `id_zamawiajacy`='.$_POST['id'].',`data_umowa`="'.$_POST['czas'].'",`netto_umowa`='.$_POST['netto'].',`rabat_umowa`='.$_POST['rabat'].',`VAT_umowa`='.$_POST['vat'].',`kwota_umowa`='.$_POST['kwota'].' WHERE id_umowa='.$id;
                //echo $query;
                $potw=@mysqli_query($pol,$query) or die("Błąd");
                if($potw){
                    header('Location:view');
                    $_SESSION['ok']=
                    '<script>
                        UIkit.notification({message: "<span uk-icon=\'icon: check\'></span> Dokonano edycji!", status: "success"})
                    </script>';
                    exit();
                }
                else {
                    header('Location:view');
                    $_SESSION['ok']='
                    <script>
                        UIkit.notification({message: "<span uk-icon=\'icon: warning\'></span> Błąd edycji!", status: "danger"})
                    </script>';
                    exit();
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
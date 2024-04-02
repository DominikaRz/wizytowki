<?php /* */
session_start();   
    if((!isset($_SESSION['log']))&&($_SESSION['log']!=true)) {       
        header('Location:index');  
        $_SESSION['succe']='<script>
            UIkit.notification({message: "<span uk-icon=\'icon: warning\'></span> Brak dostępu!", status: "danger"})
        </script>';
        exit();   
    }   
/**/

    //$pol=@mysqli_connect("localhost",'root', 'zaq1@WSX',"domeny");
    //echo "{$_SESSION['login']}","{$_SESSION['haslo']}";
    $pol=@mysqli_connect("localhost","{$_SESSION['login']}","{$_SESSION['haslo']}","domeny") or die("Błąd połączenia");
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
                $query='DELETE FROM BRANZA WHERE id_branza='.$id;
                $potw=@mysqli_query($pol,$query); //or die("Błąd");
                if($potw){
                    header('Location:main');  
                    $_SESSION['err']='<script>
                        UIkit.notification({message: "<span uk-icon=\'icon: success\'></span> Usunięto!", status: "success"})
                    </script>';
                    exit();
                }else{
                    header('Location:main');  
                    $_SESSION['err']='<script>
                        Ukit.notification({message: "<span uk-icon=\'icon: warning\'></span> Błąd usuwania!", status: "danger"})
                    </script>';
                    exit();
                }
            break;
            case "WIZYTOWKA": 
                $res = mysqli_fetch_row(mysqli_query($pol,'SELECT CASE WHEN EXISTS(select * from WIZYT_UMOWA where WIZYT_UMOWA.id_wizytowka='.$id.') then true else false end'));
                $res1 = mysqli_fetch_row(mysqli_query($pol,'SELECT CASE WHEN EXISTS(select * from FORMA_UMOWA where FORMA_UMOWA.id_wizytowka='.$id.') then true else false end'));
                if(!(($res[0])||($res1[0]))){
                    $query='DELETE FROM `BRANZA_WIZYT` WHERE id_wizytowka='.$id;
                    $potw=@mysqli_query($pol,$query); //or die('Błąd usuwania!');
                    if($potw){
                        $query1='DELETE FROM DANE_WIZYT WHERE id_wizytowka='.$id;
                        echo $query1.'  '.$potw;
                        $potw1=@mysqli_query($pol,$query1); //or die("Błąd2");
                        if($potw1){
                            $query2='DELETE FROM WIZYTOWKA WHERE id_wizytowka='.$id;
                            $potw2=@mysqli_query($pol,$query2); //or die("Błąd2");
                            if($potw2){
                                header('Location:main');  
                                $_SESSION['err']='<script>
                                    UIkit.notification({message: "<span uk-icon=\'icon: success\'></span> Usunięto!", status: "success"})
                                </script>';
                                exit();
                            }
                            else{
                                header('Location:main');  
                                $_SESSION['err']='<script>
                                    Ukit.notification({message: "<span uk-icon=\'icon: warning\'></span> Błąd usuwania!", status: "danger"})
                                </script>';
                                exit();
                            }
                        } 
                        else{
                            header('Location:main');  
                            $_SESSION['err']='<script>
                                Ukit.notification({message: "<span uk-icon=\'icon: warning\'></span> Błąd usuwania!", status: "danger"})
                            </script>';
                            exit();
                        }
                    }
                    else{
                        header('Location:main');  
                        $_SESSION['err']='<script>
                            Ukit.notification({message: "<span uk-icon=\'icon: warning\'></span> Błąd usuwania!", status: "danger"})
                        </script>';
                        exit();
                        
                    }
                }
                else{
                    header('Location:main');  
                    $_SESSION['err']='<script>
                        UIkit.notification({message: \'Błąd usunięcia: istnieją powiązania\', status: \'danger\'});
                    </script>';
                    //echo $query;
                }
                
            break;
            case "UMOWA": //✓ Działa
                $query='DELETE FROM FORMA_UMOWA WHERE id_forma='.$id;
                $potw=@mysqli_query($pol,$query); //or die("Błąd");		
                if($potw){
                    header('Location:main');  
                    $_SESSION['err']='<script>
                        UIkit.notification({message: "<span uk-icon=\'icon: success\'></span> Usunięto!", status: "success"})
                    </script>';
                    exit();
                }
                else{
                    header('Location:main');  
                    $_SESSION['err']='<script>
                        Ukit.notification({message: "<span uk-icon=\'icon: warning\'></span> Błąd usuwania!", status: "danger"})
                    </script>';
                    exit();
                }
            break;
            case "ZAMAWIAJACY": //✓ Działa
                $query='DELETE FROM ZAMAWIAJACY WHERE id_zamawiajacy='.$id;
                $potw=@mysqli_query($pol,$query) or die("Błąd");
                if($potw){
                    header('Location:main');  
                    $_SESSION['err']='<script>
                        UIkit.notification({message: "<span uk-icon=\'icon: success\'></span> Usunięto!", status: "success"})
                    </script>';
                    exit();
                }
                else{
                    header('Location:main');  
                    $_SESSION['err']='<script>
                        Ukit.notification({message: "<span uk-icon=\'icon: warning\'></span> Błąd usuwania!", status: "danger"})
                    </script>';
                    exit();
                }
            break;
            case "FAKTURA": //✓ Działa
                $query='DELETE FROM WIZYT_UMOWA WHERE id_umowa='.$id;
                $potw=@mysqli_query($pol,$query); //or die("Błąd");
                if($potw){
                    $query1='DELETE FROM UMOWA WHERE id_umowa='.$id;
                    $potw1=@mysqli_query($pol,$query1); //or die("Błąd");
                    if($potw1){
                        header('Location:main');  
                        $_SESSION['err']='<script>
                            UIkit.notification({message: "<span uk-icon=\'icon: success\'></span> Usunięto!", status: "success"})
                        </script>';
                        exit();
                    }
                    else{
                        header('Location:main');  
                        $_SESSION['err']='<script>
                            Ukit.notification({message: "<span uk-icon=\'icon: warning\'></span> Błąd usuwania!", status: "danger"})
                        </script>';
                        exit();
                    }
                }
                else{
                    header('Location:main');  
                    $_SESSION['err']='<script>
                        Ukit.notification({message: "<span uk-icon=\'icon: warning\'></span> Błąd usuwania!", status: "danger"})
                    </script>';
                    exit();
                }
                
            break;
            default:
                header('Location:main');
                $_SESSION['err']='
                <script>
                    UIkit.notification({message: "<span uk-icon=\'icon: warning\'></span> Brak danych!", status: "danger"})
                </script>';
                exit();
            break;
        }
        mysqli_close($pol);
    }
?>

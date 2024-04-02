<?php
    session_start();
    if(($_SESSION['log']!=true)&&($_SESSION['log']==true)){ //pomysleć!
        header('Location:index');
        $_SESSION['succe']='
        <script>
            UIkit.notification({message: "<span uk-icon=\'icon: warning\'></span> Brak dostępu!", status: "danger"})
        </script>';
        exit();
        //window.alert("")
    }
    else{ /**/
        $_SESSION['login']=$_POST['login'];
        $_SESSION['haslo']=$_POST['haslo'];
        $_SESSION['edit']="";
        $_SESSION['add']="";
        $_SESSION['view']="";
        $_SESSION['here']="ma";
        //$_SESSION['loginto']="";
        $_SESSION['out']=false;
        //$pol=@mysqli_connect("localhost",'root', 'zaq1@WSX',"domeny") or die('Błąd');
        $pol=@mysqli_connect("localhost","{$_SESSION['login']}","{$_SESSION['haslo']}","domeny");
        mysqli_query($pol,'SET NAMES UTF8');
        if($pol==true){
            $_SESSION['log']=true;
            header('Location:main');
                $_SESSION['err']='<script>
                UIkit.notification({message: "<span uk-icon=\'icon: sign-in\'></span> Zalogowano!", status: "success"})
                </script>'; // '.$_SESSION['login'].' '.$_SESSION['haslo'].'
        }
        else{
            $_SESSION['log']=false;
            header('Location:index');
            //$_SESSION['succe']='<script>window.alert("Logowanie nie powiodło się!")</script>';
            $_SESSION['succe']='<script>
                UIkit.notification({message: "<span uk-icon=\'icon: warning\'></span> Login lub hasło niepoprawne!", status: "danger"})
                </script>';
        }
        mysqli_close($pol);
    }

?>
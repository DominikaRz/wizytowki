<?php   
if(((!isset($_SESSION['out']))&&($_SESSION['out']!=true))) {       
    header('Location:index');  
    $_SESSION['succe']='<script>
        UIkit.notification({message: "<span uk-icon=\'icon: warning\'></span> Brak dostępu!", status: "danger"})
    </script>';
    exit();   
} 
else{ /**/
     echo '
        <div uk-sticky="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky; bottom: #transparent-sticky-navbar">
            <nav class="uk-navbar-container" style="position: relative; z-index: 980;" uk-navbar>
                <div class="uk-navbar-left">
                    <ul class="uk-navbar-nav">
                        <li'; if($_SESSION['here']=="in") echo ' class="uk-active"'; 
                        echo '><a href="index">Strona główna</a></li>
                        <li'; if($_SESSION['here']=="br") echo ' class="uk-active"'; 
                        echo '>
                            <a href="#">Branże</a>
                            <div class="uk-navbar-dropdown">
                                <ul class="uk-nav uk-navbar-dropdown-nav">';
                                    $pol=@mysqli_connect("localhost",'root', 'zaq1@WSX',"domeny");
                                    @mysqli_query($pol,'SET NAMES UTF8');
                                    $wynik=mysqli_query($pol,'SELECT DISTINCT id_branza, nazwa_branza FROM BRANZA;');
                                    while($tab=mysqli_fetch_assoc($wynik)){
                                        echo '<li><a href="search?id='.$tab['id_branza'].'">'.$tab['nazwa_branza'].'</a></li>';
                                    }
                                    mysqli_close($pol); 
                                    echo '</ul>
                            </div>
                        </li>
                        <li'; if($_SESSION['here']=="br") echo ' class="uk-active"'; 
                        echo '>
                            <a href="#">Wizytówki</a>
                            <div class="uk-navbar-dropdown">
                                <ul class="uk-nav uk-navbar-dropdown-nav">';
                                    $pol=@mysqli_connect("localhost",'root', 'zaq1@WSX',"domeny");
                                    @mysqli_query($pol,'SET NAMES UTF8');
                                    $wynik=mysqli_query($pol,'SELECT id_wizytowka,domena_wizyt FROM WIZYTOWKA');
                                    while($tab=mysqli_fetch_assoc($wynik)){
                                        echo '<li><a href="card?id='.$tab['id_wizytowka'].'">'.$tab['domena_wizyt'].'</a></li>';
                                    }
                                    mysqli_close($pol); 
                                    echo '</ul>
                            </div>
                        </li>
                        <li'; if($_SESSION['here']=="po") echo ' class="uk-active"'; 
                        echo '><a href="pomoc">Pomoc</a>
                        </li>
                    </ul>
                </div>
                <div class="uk-navbar-right">
                    <div uk-grid>
                        <p>
                            <a class="uk-button uk-button-default" href="#modalC" uk-toggle>Zaloguj</a>
                        </p>
                    </div>
                </div>
                <div id="modalC" uk-modal>
                    <div class="uk-modal-dialog">
                        <div class="uk-padding-large uk-flex-middle" uk-grid>
                            <form class="uk-form-stacked" action="log.php" method="POST">
                                <div class="uk-margin">
                                    <label class="uk-form-label" for="form-stacked-text">Login</label>
                                    <input class="uk-input uk-form-width-medium" name="login" type="text" placeholder="Podaj login..." value="root">
                                </div>
                                <div class="uk-margin">
                                    <label class="uk-form-label" for="form-stacked-text">Hasło</label>
                                    <input class="uk-input uk-form-width-medium" name="haslo" type="password" placeholder="Podaj hasło..." value="zaq1@WSX">
                                </div>
                                <div class="uk-margin">
                                    <button class="uk-button uk-button-default uk-modal-close" type="reset">Anuluj</button>
                                    <button class="uk-button uk-button-green" type="submit">Zaloguj</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
        </div>';
    
    }
?>


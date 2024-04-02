<?php /* */
    session_start();   
    if((!isset($_SESSION['log']))&&($_SESSION['log']!=true)) {       
        header('Location:index');  
        $_SESSION['succe']='<script>
            UIkit.notification({message: "<span uk-icon=\'icon: warning\'></span> Brak dostępu!", status: "danger"})
        </script>';
        exit();   
    } 
?> 
<!DOCTYPE HTML>
<html lang="pl">
    <head>
        <!--<base href="zad5DB">-->
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="shortcut icon" href="img/logo.jpg" type="image/x-icon">
        <!--CSS-->
        <link rel="stylesheet" href="css/uikit.css"/>
        <link rel="stylesheet" href="css/uikit-rtl.css"/>
        <link rel="stylesheet" href="css/styles.css"/>
        <!--JS-->
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/jquery.min.js"></script>
        <script src="js/uikit.js"></script>
        <script src="js/uikit-icons.js"></script>
        <script>
            function sendData() {
                const XHR = new XMLHttpRequest();
                const FD = new FormData(form); 
                XHR.onreadystatechange = function () {
                    var result = document.getElementById("result");
                    if (XHR.readyState === 1 || XHR.readyState === 2 || XHR.readyState === 3) {
                        result.innerHTML = "<div class=\"uk-animation-slide-bottom-medium\" uk-alert>Wysyłanie ...</div>";
                    }

                    if (XHR.readyState === 4 && XHR.status === 200) {
                        result.innerHTML = "<div class=\"uk-alert uk-alert-success uk-animation-slide-bottom-medium\" uk-alert><a class=\"uk-alert-close\" uk-close></a>Wiadomość wysłana!</div>";
                        setTimeout(function () {
                            window.location.href = "view"; //will redirect to your blog page (an ex: blog.html)
                        }, 3000);
                        
                    }
                    else if(XHR.readyState === 4 && XHR.status === 404) {
                        result.innerHTML = "<div class=\"uk-alert uk-alert-warrning uk-animation-slide-bottom-medium\" uk-alert><a class=\"uk-alert-close\" uk-close></a>Wiadomość wysłana!</div>";
                    }
                    else if(XHR.readyState === 4 && XHR.status !== 200 || XHR.readyState === 4 && XHR.status !== 404) {
                        var result = document.getElementById("result");
                        document.querySelector('.message').innerHTML = '<div class="uk-alert uk-alert-danger uk-animation-slide-bottom-medium" uk-alert><a class="uk-alert-close" uk-close></a>Wystąpił błąd!</div>';
                    }
                };
                <?php $destination='add_resp?s='.$value; ?>
                <?php //$destination='your-form'; ?>
                XHR.open("POST", "<?php echo $destination; ?>");
                XHR.send(FD); 
            }
        </script>

        <!--ICONS-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/0.8.2/css/flag-icon.min.css"/>
        <!--FONTS-->
        <link href='https://fonts.googleapis.com/css?family=Charmonman' rel='stylesheet'>
        <link href='https://fonts.googleapis.com/css?family=Caveat' rel='stylesheet'>
        <link href='https://fonts.googleapis.com/css?family=Abril Fatface' rel='stylesheet'>
        <link href='https://fonts.googleapis.com/css?family=Amita' rel='stylesheet'>
        <link href='https://fonts.googleapis.com/css?family=Combo' rel='stylesheet'>

        <!-- -->

        <title>Dodawanie</title>
    </head>
    <body>
    <!--NAVBAR-->
        <?php include('menu.php');?>
    <!--MAIN-->
        <main class="uk-padding uk-margin">
            <div id="result"></div>
            <?php 
                $id=$_GET['id'];
                $value=$_GET['s']; 
                //action="edit_resp?s='.$value.'&id='.$id.'" 
                echo '<form class="uk-form-stacked uk-position-relative" id="ThisForm" method="POST">';
            ?>
                <?php
                    $pol=@mysqli_connect("localhost",'root', 'zaq1@WSX',"domeny");
                    //$pol=@mysqli_connect("localhost","{$_SESSION['login']}","{$_SESSION['haslo']}","domeny");
                    @mysqli_query($pol,'SET NAMES UTF8');
                    //$id=3;
                    //$id=1;
                    //$value=$_SESSION['edit'];
                    //$value="BRANZA";
                    //$value="WIZYTOWKA";
                    //$value="UMOWA";
                    //$value="ZAMAWIAJACY";
                    switch($value){
                        case "BRANZA": //Działa w pełni
                            $query='SELECT nazwa_branza FROM BRANZA WHERE id_branza='.$id;
                            $wynik=mysqli_query($pol, $query);
                            while($dane=mysqli_fetch_row($wynik)){
                                echo '
                                    <div class="uk-margin">
                                        <label class="uk-form-label" for="form-stacked-text">Branża *</label>
                                        <div class="uk-form-controls">
                                            <input id="nazwa" class="uk-input" id="form-stacked-text" name="nazwa" type="text" placeholder="Nazwa..." minlength="5" maxlength="20" pattern="^[a-z]*$" value="'.$dane[0].'" required>
                                            <span id="dNazwa" class="uk-text-danger"></span>
                                        </div>
                                        </div><div class="uk-margin">
                                        <button class="uk-button uk-button-default uk-modal-close" type="reset" onclick="window.location.href=\'view\'">Anuluj</button>
                                        <button class="uk-button" type="submit">Zapisz</button>
                                    </div>
                                </form> ';
                                echo '
                                <script>
                                    const form = document.getElementById("ThisForm");
                                    const name = document.getElementById("nazwa");
                                    const nameError = document.getElementById("dNazwa");
                                    //const nameError = document.querySelector("#name + span.uk-text-danger");
                                    
                                    name.addEventListener(\'input\', function (event) {
                                        if (name.validity.valid) {
                                            nameError.innerHTML = \'\';
                                            nameError.className = \'uk-text-danger\';
                                            name.className = \'uk-input uk-form-success\';
                                        }
                                        else {
                                            showError();
                                        }
                                    });
                                    function showError(){
                                        if(name.validity.valueMissing) {
                                            nameError.textContent = \'Pole wymagane\';
                                            name.className = \'uk-input uk-form-danger\';
                                        }
                                        else if(name.validity.patternMismatch) {
                                            nameError.textContent = \'Niepoprawny zapis!\';
                                            name.className = \'uk-input uk-form-danger\';
                                        }
                                        else if(name.validity.tooShort) {
                                            nameError.textContent = `Niepoprawny zapis!`;
                                            name.className = \'uk-input uk-form-danger\';
                                        }
                                        else if(name.validity.tooLong) {
                                            nameError.textContent = `Niepoprawny zapis!`;
                                            name.className = \'uk-input uk-form-danger\';
                                        }
                                    }
    
                                    window.addEventListener("load", function() {
                                        const form = document.getElementById("ThisForm");
                                        form.addEventListener("submit", function (event) {
                                            if(!name.validity.valid) {showError();}
                                            event.preventDefault();
                                            sendData();
                                        });
                                    });
    
                                </script>';
                            }                            
                        break;
                        case "WIZYTOWKA": //Działa w pełni
                            $query='SELECT DISTINCT domena_wizyt,opis_skr_wizyt,adr_ul_dane,adr_nr_dane,adr_miast_dane,adr_kod_dane,adr_pocz_dane,telefon_dane,mail_dane,str_int_dane,opis_dane,geo_lat,geo_lon FROM WIZYTOWKA, DANE_WIZYT WHERE WIZYTOWKA.id_wizytowka=DANE_WIZYT.id_wizytowka AND WIZYTOWKA.id_wizytowka='.$id.' AND DANE_WIZYT.id_wizytowka='.$id;
                            //echo $query;
                                $wynik=mysqli_query($pol, $query);
                                while($dane=mysqli_fetch_row($wynik)){
                            echo '<div class="uk-margin">
                                    <label class="uk-form-label" for="form-stacked-text">Domena *</label>
                                    <div class="uk-form-controls">
                                        <input id="domena" class="uk-input uk-form-width-medium" name="domena" type="text" placeholder="nazwa.wizyt.pl" minlength="3" maxlength="45" pattern="^[a-z]*.wizyt.pl$" value="'.$dane[0].'" required>
                                        <span id="dDomena" class="uk-text-danger"></span>
                                    </div>
                                </div> 
                                <div class="uk-margin">
                                    <label class="uk-form-label" for="form-stacked-text">Skrócony opis</label>
                                    <div class="uk-form-controls">    
                                        <input id="opis_skr" class="uk-input uk-form-width-large" name="opis_skr" type="text" placeholder="np. kawiarnia Dobre Ziarno" value="'.$dane[1].'">
                                        <span id="dOpisSkr" class="uk-text-danger"></span>
                                    </div>  
                                </div>
                                <label class="uk-form-label" for="form-stacked-text">Adres</label>
                                <div class="uk-grid-small" uk-grid>
                                    <div class="uk-width-2-5">
                                        <input id="ul" class="uk-input" type="text" name="ul" placeholder="ulica" minlength="5" maxlength="56" pattern="^[A-ZĄĆŁÓŚŻŹ][a-ząćęłóśżźA-Z ]*$" value="'.$dane[2].'">
                                        <span id="dUl" class="uk-text-danger"></span>
                                    </div>
                                    <div class="uk-width-1-5">
                                        <input id="nr" class="uk-input" type="text" name="nr" placeholder="numer" maxlength="10" pattern="^[0-9A-Za-z/]*$" value="'.$dane[3].'">
                                        <span id="dNr" class="uk-text-danger"></span>
                                    </div>
                                    <br>
                                    <div class="uk-width-2-5">
                                        <input id="miasto" class="uk-input" type="text" name="miasto" maxlength="40" pattern="^[A-ZĄĆŁÓŚŻŹ][a-ząćęłóśżźA-Z ]*$" placeholder="miasto" value="'.$dane[4].'">
                                        <span id="dMiasto" class="uk-text-danger"></span>
                                    </div>
                                </div>
                                <div class="uk-grid-small" uk-grid>
                                    <div class="uk-width-1-5">
                                        <input id="kod" class="uk-input" type="text" name="kod" placeholder="kod pocztowy" maxlength="6" pattern="^([0-9]{2})-([0-9]{3})*$" value="'.$dane[5].'">
                                        <span id="dKod" class="uk-text-danger"></span>
                                    </div>
                                    <div class="uk-width-3-5">
                                        <input id="poczta" class="uk-input" type="text" name="poczta" placeholder="poczta" maxlength="40" pattern="^[A-ZĄĆŁÓŚŻŹ][a-ząćęłóśżźA-Z ]*$" value="'.$dane[6].'">
                                        <span id="dPoczta" class="uk-text-danger"></span>
                                    </div>
                                </div>
                                <div class="uk-grid-small" uk-grid>
                                    <div class="uk-width-1-2">
                                        <label class="uk-form-label" for="form-stacked-text">Telefon *</label>
                                        <div class="uk-form-controls">    
                                            <input id="tel" class="uk-input uk-form-width-large" name="tel" type="phone" maxlength="11" pattern="^([0-9]{3}) ([0-9]{3}) ([0-9]{3})*$" placeholder="np. 123 456 789" value="'.$dane[7].'" required>
                                        </div> 
                                        <span id="dTel" class="uk-text-danger"></span>
                                    </div>
                                    <div class="uk-width-1-2">
                                        <label class="uk-form-label" for="form-stacked-text">Email *</label>
                                        <div class="uk-form-controls">    
                                            <input id="mail" class="uk-input uk-form-width-large" name="mail" type="text" placeholder="np. nazwa@mail.com" maxlength="100" pattern="^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$" value="'.$dane[8].'" required>
                                            <span id="dMail" class="uk-text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="uk-margin">
                                    <label class="uk-form-label" for="form-stacked-text">Strona internetowa</label>
                                    <div class="uk-form-controls">    
                                        <input id="str" class="uk-input uk-form-width-large" name="str" maxlength="63" pattern="https?://.+"  type="text" placeholder="np. https://nazwa.pl" value="'.$dane[9].'">
                                        <span id="dStr" class="uk-text-danger"></span>
                                    </div>  
                                </div>
                                <div class="uk-margin">
                                    <label class="uk-form-label" for="form-stacked-text">Opis działalności *</label>
                                    <div class="uk-form-controls">    
                                        <textarea id="opis" class="uk-textarea" rows="6" name="opis" placeholder="Opisz tutaj..." required>'.$dane[10].'</textarea>
                                        <span id="dOpis" class="uk-text-danger"></span>
                                    </div>  
                                </div>
                                <label class="uk-form-label" for="form-stacked-text">Lokalizacja</label>
                                <div class="uk-grid-small" uk-grid>
                                    <div class="uk-width-1-2">
                                        <input id="lat" class="uk-input" type="text" name="lat" placeholder="szerokość geograficzna" maxlength="18" pattern="^([0-9]){1,2}.([0-9]{1,16})*$" value="'.$dane[11].'">
                                        <span id="dLat" class="uk-text-danger"></span>
                                    </div>
                                    <div class="uk-width-1-2">
                                        <input id="lon" class="uk-input" type="text" name="lon" placeholder="długość geograliczna" maxlength="18" pattern="^([0-9]){1,2}.([0-9]{1,16})*$" value="'.$dane[12].'">
                                        <span id="dLon" class="uk-text-danger"></span>
                                    </div>
                                </div>
                                </div><div class="uk-margin">
                                    <button class="uk-button uk-button-default uk-modal-close" type="reset" onclick="window.location.href=\'view\'">Anuluj</button>
                                    <button class="uk-button" type="submit">Zapisz</button>
                                </div>
                            </form> ';
                            $ids1 = array( 'opis_skr', 'ul', 'nr', 'miasto', 'kod', 'poczta', 'str', 'lat', 'lon','domena', 'tel', 'mail', 'opis');
                            $idsErr1 = array( 'dOpisSkr', 'dUl', 'dNr', 'dMiasto', 'dKod', 'dPoczta', 'dStr', 'dLat', 'dLon', 'dDomena', 'dTel', 'dMail', 'dOpis');
                           //ważniejsze:
                            $ids = array( 'opskr', 'ul', 'nr', 'mias', 'kod', 'pocz', 'str', 'lat', 'lon', 'dome', 'tel', 'mail', 'opis');
                            $idsErr = array( 'opskrError', 'ulError', 'nrError', 'miasError', 'kodError', 'poczError', 'strError', 'latError', 'lonError', 'domeError', 'telError', 'mailError', 'opisError');
                            echo '
                            <script>
                                const form = document.getElementById("ThisForm");
                                ';
                            for($i=0; $i<sizeof($ids) ;$i++){
                                    echo '
                                    const '.$ids[$i].' = document.getElementById("'.$ids1[$i].'");';
                            }
                            for($i=0; $i<sizeof($ids) ;$i++){
                                echo '
                                const '.$idsErr[$i].' = document.getElementById("'.$idsErr1[$i].'");';
                            }
                            for($i=0; $i<sizeof($ids) ;$i++){
                                echo '
                                '.$ids[$i].'.addEventListener(\'input\', function (event) {
                                    if ('.$ids[$i].'.validity.valid) {
                                        '.$idsErr[$i].'.innerHTML = \'\';
                                        '.$idsErr[$i].'.className = \'uk-text-danger\';';
                                        if(($ids[$i]=='opskr')||($ids[$i]=='mail')||($ids[$i]=='str')) echo $ids[$i].'.className = \'uk-input uk-form-width-large uk-form-success\';';
                                        else if(($ids[$i]=='dome')) echo $ids[$i].'.className = \'uk-input uk-form-width-medium uk-form-success\';';
                                        else if($ids[$i]=='opis') echo $ids[$i].'.className = \'uk-textarea uk-form-success\';';
                                        else echo $ids[$i].'.className = \'uk-input uk-form-success\';';
                                echo'
                                    }
                                    else showError'.($i+1).'();
                                });';
                            }
                            echo '
                                window.addEventListener("load", function() {
                                    const form = document.getElementById("ThisForm");
                                    form.addEventListener("submit", function (event) {
                                        ';
                                    for($i=0; $i<sizeof($ids) ;$i++){
                                            if(($ids[$i]=='tel')||($ids[$i]=='mail')||($ids[$i]=='opis')) 
                                                echo 'else if(!'.$ids[$i].'.validity.valid) {showError'.($i+1).'();}
                                            ';
                                            else echo 'if(!'.$ids[$i].'.validity.valid) {showError'.($i+1).'();}
                                            ';
                                    }
                                    echo '
                                        else{sendData();}
                                        event.preventDefault();
                                    });
                                });';

                            for($i=0; $i<sizeof($ids) ;$i++){
                                echo '
                                function showError'.($i+1).'() {
                                      if('.$ids[$i].'.validity.valueMissing) {
                                        '.$idsErr[$i].'.textContent = \'Pole wymagane!\';';
                                        if(($ids[$i]=='opskr')||($ids[$i]=='mail')||($ids[$i]=='str')) echo $ids[$i].'.className = \'uk-input uk-form-width-large uk-form-danger\';';
                                        else if($ids[$i]=='opis') echo $ids[$i].'.className = \'uk-textarea uk-form-danger\';';
                                        else if(($ids[$i]=='dome')) echo $ids[$i].'.className = \'uk-input uk-form-width-medium uk-form-danger\';';
                                        else echo $ids[$i].'.className = \'uk-input uk-form-danger\';';
                                    echo '}
                                      else if('.$ids[$i].'.validity.patternMismatch) {
                                        '.$idsErr[$i].'.textContent = \'Niepoprawny zapis!\';';
                                        if(($ids[$i]=='opskr')||($ids[$i]=='mail')||($ids[$i]=='str')) echo $ids[$i].'.className = \'uk-input uk-form-width-large uk-form-danger\';';
                                        else if($ids[$i]=='dome') echo $ids[$i].'.className = \'uk-input uk-form-width-medium uk-form-danger\';';
                                        else if($ids[$i]=='opis') echo $ids[$i].'.className = \'uk-textarea uk-form-danger\';';
                                        else echo $ids[$i].'.className = \'uk-input uk-form-danger\';';
                                    echo '
                                    }
                                  }';
                            }
                            echo '
                                </script>';
                            }
                        break; 
                        case "UMOWA": //Działa w pełni
                            $query='SELECT WIZYTOWKA.id_wizytowka,WIZYTOWKA.domena_wizyt, FORMA_UMOWA.nazwa_forma, FORMA_UMOWA.czas_zawarcia_forma, FORMA_UMOWA.serwer_forma, FORMA_UMOWA.wielkosc_serwer_forma, FORMA_UMOWA.opis_forma FROM FORMA_UMOWA,WIZYTOWKA WHERE WIZYTOWKA.id_wizytowka=FORMA_UMOWA.id_wizytowka AND id_forma='.$id.' ORDER BY FORMA_UMOWA.czas_zawarcia_forma DESC';
                            //echo $query;
                            $wynik=mysqli_query($pol, $query);
                            while($dane=mysqli_fetch_row($wynik)){
                                echo '<div class="uk-margin">
                                <label class="uk-form-label" for="id_dom">Domena *</label>
                                <div class="uk-form-controls">
                                    <select class="uk-select uk-form-width-medium" id="id_dom" name="id_wizyt" required>
                                    <option value="'.$dane[0].'" selected>'.$dane[1].'</option>';
                                        @mysqli_query($pol,'SET NAMES UTF8');
                                        $wynik=mysqli_query($pol,'SELECT id_wizytowka,domena_wizyt FROM WIZYTOWKA');	
                                        echo '';
                                        while($tab=mysqli_fetch_assoc($wynik)){
                                            echo '<option value="'.$tab['id_wizytowka'].'">'.$tab['domena_wizyt']."</option>";
                                        }
                                    echo '</select>
                                    <span id="dDomen" class="uk-text-danger"></span>
                                    </div>
                                </div> 
                                <div class="uk-margin">
                                    <label class="uk-form-label">Forma umowy *</label>
                                    <div class="uk-form-controls">
                                        <select class="uk-select uk-form-width-small" name="forma" id="forma" required>
                                            <option value="'.$dane[2].'" selected>'.$dane[2].'</option>
                                            <option value="roczna">roczna</option>
                                            <option value="kwartalna">kwartalna</option>
                                            <option value="miesięczna">miesięczna</option>
                                        </select>
                                        <span id="dForma" class="uk-text-danger"></span>
                                    </div>
                                </div>
                                <div class="uk-margin">
                                    <label class="uk-form-label">Czas zawarcia umowy *</label>
                                    <div class="uk-form-controls">    
                                        <input class="uk-input uk-form-width-large" name="czas" id="czas" type="datetime-local" placeholder="data" value="'.strftime('%Y-%m-%dT%H:%M:%S', strtotime($dane[3])).'" required>
                                        <span id="dCzas" class="uk-text-danger"></span>
                                    </div>
                                </div>
                                <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                                    <label><input class="uk-checkbox" id="srv" name="srv" type="checkbox" ';
                                    if($dane[4]==1) echo 'checked';
                                    echo '> Dodatkowe miejsce</label>
                                </div>
                                <div class="uk-margin" id="miejsce">
                                    <label class="uk-form-label" for="wielkosc">Wielkość (podane w GB): </label>
                                    <div class="uk-form-controls">
                                        <input class="uk-input uk-form-width-small" id="wielkosc" name="wielk" type="number" step="0.01" value="'.$dane[5].'">
                                        <span id="dWielk" class="uk-text-danger"></span>
                                    </div>
                                </div>
                                <div class="uk-margin">
                                    <label class="uk-form-label" for="form-stacked-text">Dodatkowy opis umowy:</label>
                                    <div class="uk-form-controls">    
                                        <textarea class="uk-textarea" rows="6" name="opis"  id="opis" placeholder="Opisz tutaj...">'.$dane[6].'</textarea>
                                        <span id="dOpis" class="uk-text-danger"></span>
                                    </div>  
                                </div>
                                </div><div class="uk-margin">
                                    <button class="uk-button uk-button-default uk-modal-close" type="reset" onclick="window.location.href=\'view\'">Anuluj</button>
                                    <button class="uk-button" type="submit">Zapisz</button>
                                </div>
                            </form> '; 
                            $ids1 = array('opis','wielkosc','id_dom', 'forma', 'czas');
                            $idsErr1 = array('dOpis','dWielk','dDomen', 'dForma', 'dCzas');
                           //ważniejsze:
                            $ids = array( 'opis', 'wielk', 'dome', 'forma', 'czas'); 
                            $idsErr = array( 'opisErr', 'wielkErr', 'domeErr', 'formaErr', 'czasErr');
                            echo '
                            <script>
                                const form = document.getElementById("ThisForm");
                                ';
                            for($i=0; $i<sizeof($ids) ;$i++){
                                    echo '
                                    const '.$ids[$i].' = document.getElementById("'.$ids1[$i].'");';
                            }
                            for($i=0; $i<sizeof($ids) ;$i++){
                                echo '
                                const '.$idsErr[$i].' = document.getElementById("'.$idsErr1[$i].'");';
                            }
                            for($i=0; $i<sizeof($ids) ;$i++){
                                echo '
                                '.$ids[$i].'.addEventListener(\'input\', function (event) {
                                    if ('.$ids[$i].'.validity.valid) {
                                        '.$idsErr[$i].'.innerHTML = \'\';
                                        '.$idsErr[$i].'.className = \'uk-text-danger\';';
                                        if(($ids[$i]=='dome')||($ids[$i])=='forma') echo $ids[$i].'.className = \'uk-select uk-form-width-medium uk-form-success\';';
                                        else if($ids[$i]=='opis') echo $ids[$i].'.className = \'uk-textarea uk-form-success\';';
                                        else echo $ids[$i].'.className = \'uk-input uk-form-success\';';
                                echo'
                                    }
                                    else showError'.($i+1).'();
                                });';
                            }
                            echo '
                                window.addEventListener("load", function() {
                                    const form = document.getElementById("ThisForm");
                                    form.addEventListener("submit", function (event) {
                                        ';
                                    for($i=0; $i<sizeof($ids) ;$i++){
                                            if(($ids[$i]=='forma')||($ids[$i]=='czas')) 
                                                echo 'else if(!'.$ids[$i].'.validity.valid) {showError'.($i+1).'();}
                                            ';
                                            else echo 'if(!'.$ids[$i].'.validity.valid) {showError'.($i+1).'();}
                                            ';
                                    }
                                    echo '
                                        else{sendData();}
                                        event.preventDefault();
                                    });
                                });';

                            for($i=0; $i<sizeof($ids) ;$i++){
                                echo '
                                function showError'.($i+1).'() {
                                      if('.$ids[$i].'.validity.valueMissing) {
                                        '.$idsErr[$i].'.textContent = \'Pole wymagane!\';';
                                        if($ids[$i]=='opis') echo $ids[$i].'.className = \'uk-textarea uk-form-danger\';';
                                        else if(($ids[$i]=='dome')||($ids[$i]=='forma')) echo $ids[$i].'.className = \'uk-select uk-form-width-medium uk-form-danger\';';
                                        else echo $ids[$i].'.className = \'uk-input uk-form-danger\';';
                                    echo '}
                                      else if('.$ids[$i].'.validity.patternMismatch) {
                                        '.$idsErr[$i].'.textContent = \'Niepoprawny zapis!\';';
                                        if(($ids[$i]=='opskr')||($ids[$i]=='mail')||($ids[$i]=='str')) echo $ids[$i].'.className = \'uk-input uk-form-width-large uk-form-danger\';';
                                        else if(($ids[$i]=='dome')||($ids[$i]=='forma')) echo $ids[$i].'.className = \'uk-select uk-form-width-medium uk-form-danger\';';
                                        else if($ids[$i]=='opis') echo $ids[$i].'.className = \'uk-textarea uk-form-danger\';';
                                        else echo $ids[$i].'.className = \'uk-input uk-form-danger\';';
                                    echo '
                                    }
                                  }';
                            }
                            echo '
                                </script>';
                            }
                        break;
                        case "ZAMAWIAJACY": //Działa w pełni
                            $query='SELECT * FROM ZAMAWIAJACY WHERE id_zamawiajacy='.$id;
                            $wynik=mysqli_query($pol, $query);
                            while($dane=mysqli_fetch_row($wynik)){
                                echo '<div class="uk-grid-small" uk-grid>
                                    <div class="uk-width-1-4">
                                        <input class="uk-input" type="text" name="imie" id="imie" placeholder="Imię *" pattern="^[A-ZĄĆŁÓŚŻŹ][a-ząćęłóśżź]*$" value="'.$dane[1].'" required>
                                        <span id="dImie" class="uk-text-danger"></span>
                                    </div>
                                    <div class="uk-width-1-4">
                                        <input class="uk-input" type="text" id="nazwisko" name="nazwisko" placeholder="Nazwisko *" pattern="^[A-ZĄĆŁÓŚŻŹ][a-ząćęłóśżź]*$" value="'.$dane[2].'" required>
                                        <span id="dNazwisko" class="uk-text-danger"></span>
                                    </div>
                                </div>
                                <div class="uk-margin">
                                    <label class="uk-form-label" for="form-stacked-text">Nazwa firmy</label>
                                    <div class="uk-form-controls">
                                        <input class="uk-input uk-form-width-medium" id="firma" name="firma" type="text" placeholder="np. Dobre Ziarno" value="'.$dane[3].'">
                                        <span id="dFirma" class="uk-text-danger"></span>
                                    </div>
                                </div>
                                <div class="uk-grid-small" uk-grid>
                                    <div class="uk-width-1-2">
                                        <label class="uk-form-label" for="form-stacked-text">Telefon *</label>
                                        <div class="uk-form-controls">    
                                            <input id="tel" class="uk-input uk-form-width-large" name="tel" type="phone" maxlength="11" pattern="^([0-9]{3}) ([0-9]{3}) ([0-9]{3})*$" placeholder="np. 123 456 789" value="'.$dane[4].'" required>
                                        </div> 
                                        <span id="dTel" class="uk-text-danger"></span>
                                    </div>
                                    <div class="uk-width-1-2">
                                        <label class="uk-form-label" for="form-stacked-text">Email *</label>
                                        <div class="uk-form-controls">    
                                            <input id="mail" class="uk-input uk-form-width-large" name="mail" type="text" placeholder="np. nazwa@mail.com" maxlength="100" pattern="^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$" value="'.$dane[5].'" required>
                                            <span id="dMail" class="uk-text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="uk-margin"></div>
                                <label class="uk-form-label" for="form-stacked-text">Adres</label>
                                <div class="uk-grid-small" uk-grid>
                                    <div class="uk-width-2-5">
                                        <input id="ul" class="uk-input" type="text" name="ul" placeholder="ulica" minlength="5" maxlength="56" pattern="^[A-ZĄĆŁÓŚŻŹ][a-ząćęłóśżźA-Z ]*$" value="'.$dane[6].'">
                                        <span id="dUl" class="uk-text-danger"></span>
                                    </div>
                                    <div class="uk-width-1-5">
                                        <input id="nr" class="uk-input" type="text" name="nr" placeholder="numer" maxlength="10" pattern="^[0-9A-Za-z/]*$" value="'.$dane[7].'">
                                        <span id="dNr" class="uk-text-danger"></span>
                                    </div>
                                    <br>
                                    <div class="uk-width-2-5">
                                        <input id="miasto" class="uk-input" type="text" name="miasto" maxlength="40" pattern="^[A-ZĄĆŁÓŚŻŹ][a-ząćęłóśżźA-Z ]*$" placeholder="miasto" value="'.$dane[8].'">
                                        <span id="dMiasto" class="uk-text-danger"></span>
                                    </div>
                                </div>
                                <div class="uk-grid-small" uk-grid>
                                    <div class="uk-width-1-5">
                                        <input id="kod" class="uk-input" type="text" name="kod" placeholder="kod pocztowy" maxlength="6" pattern="^([0-9]{2})-([0-9]{3})*$" value="'.$dane[9].'">
                                        <span id="dKod" class="uk-text-danger"></span>
                                    </div>
                                    <div class="uk-width-3-5">
                                        <input id="poczta" class="uk-input" type="text" name="poczta" placeholder="poczta" maxlength="40" pattern="^[A-ZĄĆŁÓŚŻŹ][a-ząćęłóśżźA-Z ]*$" value="'.$dane[10].'">
                                        <span id="dPoczta" class="uk-text-danger"></span>
                                    </div>
                                </div>
                                <div class="uk-margin"></div>
                                <div class="uk-grid-small" uk-grid>
                                    <div class="uk-width-1-2">
                                        <label class="uk-form-label" for="form-stacked-text">Pesel *</label>
                                        <input class="uk-input" type="text" id="PESEL" name="PESEL" placeholder="12345678974" pattern="^([0-9]{11})*$" value="'.$dane[11].'" required>
                                        <span id="dPesel" class="uk-text-danger"></span>
                                    </div>
                                    <div class="uk-width-1-2">
                                        <label class="uk-form-label" for="form-stacked-text">Nip</label>
                                        <input class="uk-input" type="text" id="NIP" name="NIP" placeholder="1236547890" pattern="^([0-9]{10})*$" value="'.$dane[12].'">
                                        <span id="dNip" class="uk-text-danger"></span>
                                    </div>
                                </div>
                                </div><div class="uk-margin">
                                    <button class="uk-button uk-button-default uk-modal-close" type="reset" onclick="window.location.href=\'view\'">Anuluj</button>
                                    <button class="uk-button" type="submit">Zapisz</button>
                                </div>
                            </form> ';
                            $ids1 = array('ul', 'nr', 'miasto', 'kod', 'poczta', 'NIP', 'firma', 'imie', 'nazwisko', 'tel', 'mail', 'PESEL');
                            $idsErr1 = array('dUl', 'dNr', 'dMiasto', 'dKod', 'dPoczta','dNip', 'dFirma','dImie','dNazwisko', 'dTel', 'dMail', 'dPesel');
                           //ważniejsze:
                            $ids = array('ul', 'nr', 'miasto', 'kod', 'poczta', 'nip', 'firma', 'imie', 'nazwisko', 'tel', 'mail', 'pesel');
                            $idsErr = array('ulErr', 'nrErr', 'miastoErr', 'kodErr', 'pocztaErr', 'nipErr', 'firmaErr', 'imieErr', 'nazwiskoErr', 'telErr', 'mailErr', 'peselErr');
                            echo '
                            <script>
                                const form = document.getElementById("ThisForm");
                                ';
                            for($i=0; $i<sizeof($ids) ;$i++){
                                    echo '
                                    const '.$ids[$i].' = document.getElementById("'.$ids1[$i].'");';
                            }
                            for($i=0; $i<sizeof($ids) ;$i++){
                                echo '
                                    const '.$idsErr[$i].' = document.getElementById("'.$idsErr1[$i].'");';
                            }
                            for($i=0; $i<sizeof($ids) ;$i++){
                                echo '
                                '.$ids[$i].'.addEventListener(\'input\', function (event) {
                                    if ('.$ids[$i].'.validity.valid) {
                                        '.$idsErr[$i].'.innerHTML = \'\';
                                        '.$idsErr[$i].'.className = \'uk-text-danger\';';
                                        if(($ids[$i]=='mail')) echo $ids[$i].'.className = \'uk-input uk-form-width-large uk-form-success\';';
                                        if(($ids[$i]=='firma')) echo $ids[$i].'.className = \'uk-input uk-form-width-medium uk-form-success\';';
                                        else echo $ids[$i].'.className = \'uk-input uk-form-success\';';
                                echo'
                                    }
                                    else showError'.($i+1).'();
                                });';
                            }
                            echo '
                                window.addEventListener("load", function() {
                                    const form = document.getElementById("ThisForm");
                                    form.addEventListener("submit", function (event) {
                                        ';
                                    for($i=0; $i<sizeof($ids) ;$i++){
                                            if(($ids[$i]=='nazwisko')||($ids[$i]=='tel')||($ids[$i]=='mail')||($ids[$i]=='pesel'))
                                                echo 'else if(!'.$ids[$i].'.validity.valid) {showError'.($i+1).'();}
                                            ';
                                            else echo 'if(!'.$ids[$i].'.validity.valid) {showError'.($i+1).'();}
                                            ';
                                    }
                                    echo '
                                        else{sendData();}
                                        event.preventDefault();
                                    });
                                });';

                            for($i=0; $i<sizeof($ids) ;$i++){
                                echo '
                                function showError'.($i+1).'() {
                                      if('.$ids[$i].'.validity.valueMissing) {
                                        '.$idsErr[$i].'.textContent = \'Pole wymagane!\';';
                                        if(($ids[$i]=='mail')) echo $ids[$i].'.className = \'uk-input uk-form-width-large uk-form-danger\';';
                                        if(($ids[$i]=='firma')) echo $ids[$i].'.className = \'uk-input uk-form-width-medium uk-form-danger\';';
                                        else echo $ids[$i].'.className = \'uk-input uk-form-danger\';';
                                    echo '}
                                      else if('.$ids[$i].'.validity.patternMismatch) {
                                        '.$idsErr[$i].'.textContent = \'Niepoprawny zapis!\';';
                                        if(($ids[$i]=='mail')) echo $ids[$i].'.className = \'uk-input uk-form-width-large uk-form-danger\';';
                                        if(($ids[$i]=='firma')) echo $ids[$i].'.className = \'uk-input uk-form-width-medium uk-form-danger\';';
                                        else echo $ids[$i].'.className = \'uk-input uk-form-danger\';';
                                    echo '
                                    }
                                  }';
                            }
                            echo '
                                </script>';
                            }
                        break;
                        case "FAKTURA": //Działa w pełni
                            $query='SELECT DISTINCT domena_wizyt,data_umowa,wielkosc_serwer_forma,rabat_umowa,netto_umowa,vat_umowa,kwota_umowa,UMOWA.id_zamawiajacy FROM UMOWA, ZAMAWIAJACY, WIZYTOWKA, WIZYT_UMOWA, FORMA_UMOWA WHERE UMOWA.id_zamawiajacy = ZAMAWIAJACY.id_zamawiajacy AND WIZYT_UMOWA.id_umowa = UMOWA.id_umowa AND WIZYT_UMOWA.id_wizytowka = WIZYTOWKA.id_wizytowka AND FORMA_UMOWA.id_wizytowka=WIZYTOWKA.id_wizytowka AND FORMA_UMOWA.id_wizytowka=WIZYT_UMOWA.id_wizytowka AND UMOWA.id_umowa='.$id;
                            //echo $query;
                            $wynik=mysqli_query($pol, $query);
                            while($dane=mysqli_fetch_row($wynik)){
                                echo '<div class="uk-margin">
                            <label class="uk-form-label">Domena i zamawiający*</label>
                            <div class="uk-form-controls">
                            <input class="uk-input uk-form-width-large" name="domena" type="text" value="'.$dane[0].'" disabled id="domena" required>
                                </div><span id="dDomena" class="uk-text-danger"></span>
                            </div> 
                                <div class="uk-form-controls">
                                    <select class="uk-select uk-form-width-large" id="id" name="id" required>'; 
                                    $resb = mysqli_fetch_assoc(mysqli_query($pol, "SELECT id_zamawiajacy,imie_zamaw,nazwisko_zamaw,adres_ul_zamaw,adres_nr_zamaw,adres_kod_zamaw,adres_miast_zamaw FROM ZAMAWIAJACY WHERE id_zamawiajacy=".$dane[7]));
                                    echo '<option value="'.$resb['id_zamawiajacy'].'">'.$resb['imie_zamaw'].' '.$resb['nazwisko_zamaw'].' '.$resb['adres_ul_zamaw'].' '.$resb['adres_nr_zamaw'].' '.$resb['adres_kod_zamaw'].' '.$resb['adres_miast_zamaw']."</option>";
                                    $wyn=mysqli_query($pol,'SELECT id_zamawiajacy,imie_zamaw,nazwisko_zamaw,adres_ul_zamaw,adres_nr_zamaw,adres_kod_zamaw,adres_miast_zamaw FROM ZAMAWIAJACY');
                                    while($tab=mysqli_fetch_assoc($wyn)){
                                        echo '<option value="'.$tab['id_zamawiajacy'].'">'.$tab['imie_zamaw'].' '.$tab['nazwisko_zamaw'].' '.$tab['adres_ul_zamaw'].' '.$tab['adres_nr_zamaw'].' '.$tab['adres_kod_zamaw'].' '.$tab['adres_miast_zamaw']."</option>";
                                    }
                                echo '</select>
                                </div><span id="dId" class="uk-text-danger"></span>
                                <div class="uk-margin">
                                    <label class="uk-form-label">Czas zawarcia umowy *</label>
                                    <div class="uk-form-controls">    
                                        <input class="uk-input uk-form-width-large" id="czas" name="czas" type="datetime-local" value="'.strftime('%Y-%m-%dT%H:%M:%S', strtotime($dane[1])).'" required>
                                        <span id="dCzas" class="uk-text-danger"></span>
                                    </div>  
                                </div>
                                <div class="uk-grid-small" uk-grid>
                                    <div class="uk-width-1-5">
                                        <label class="uk-form-label">Rabat</label>
                                        <input class="uk-input" type="number" step="1" name="rabat" id="rabat" value="'.$dane[3].'">
                                        <span id="dRabat" class="uk-text-danger"></span>
                                    </div>
                                </div>
                                <div class="uk-grid-small" uk-grid>
                                    <div class="uk-width-1-5">
                                        <label class="uk-form-label">Netto *</label>
                                        <input class="uk-input" type="number" step="0.01" name="netto" id="netto" value="'.$dane[4].'" required>
                                        <span id="dNetto" class="uk-text-danger"></span>
                                    </div>
                                    <div class="uk-width-1-5">
                                        <label class="uk-form-label">VAT *</label>
                                        <input class="uk-input" type="number" step="0.01" name="vat" id="vat" value="'.$dane[5].'" required>
                                        <span id="dVat" class="uk-text-danger"></span>
                                    </div>
                                    <div class="uk-width-1-5">
                                        <label class="uk-form-label">Kwota *</label>
                                        <input class="uk-input" type="number" step="0.01" name="kwota" id="kwota" value="'.$dane[6].'" required>
                                        <span id="dKwota" class="uk-text-danger"></span>
                                    </div>
                                </div>
                                </div><div class="uk-margin">
                                    <button class="uk-button uk-button-default uk-modal-close" type="reset" onclick="window.location.href=\'view\'">Anuluj</button>
                                    <button class="uk-button" type="submit">Zapisz</button>
                                </div>
                            </form> ';
                            $ids1 = array('rabat','domena','id', 'czas', 'netto', 'vat', 'kwota');
                            $idsErr1 = array('dRabat','dDomena','dId', 'dCzas', 'dNetto', 'dVat', 'dKwota');
                           //ważniejsze:
                            $ids = array('rabat','domena','id', 'czas', 'netto', 'vat', 'kwota'); 
                            $idsErr = array( 'rabatErr','domenaErr','idErr', 'czasErr', 'nettoErr', 'vatErr', 'kwotaErr');
                            echo '
                            <script>
                                const form = document.getElementById("ThisForm");
                                ';
                            for($i=0; $i<sizeof($ids) ;$i++){
                                    echo '
                                    const '.$ids[$i].' = document.getElementById("'.$ids1[$i].'");';
                            }
                            for($i=0; $i<sizeof($ids) ;$i++){
                                echo '
                                const '.$idsErr[$i].' = document.getElementById("'.$idsErr1[$i].'");';
                            }
                            for($i=0; $i<sizeof($ids) ;$i++){
                                echo '
                                '.$ids[$i].'.addEventListener(\'input\', function (event) {
                                    if ('.$ids[$i].'.validity.valid) {
                                        '.$idsErr[$i].'.innerHTML = \'\';
                                        '.$idsErr[$i].'.className = \'uk-text-danger\';';
                                        if(($ids[$i])=='id') echo $ids[$i].'.className = \'uk-select uk-form-width-large uk-form-success\';';
                                        else echo $ids[$i].'.className = \'uk-input uk-form-success\';';
                                echo'
                                    }
                                    else showError'.($i+1).'();
                                });';
                            }
                            echo '
                                window.addEventListener("load", function() {
                                    const form = document.getElementById("ThisForm");
                                    form.addEventListener("submit", function (event) {
                                        ';
                                    for($i=0; $i<sizeof($ids) ;$i++){
                                            if(($ids[$i]=='czas')||($ids[$i]=='netto')||($ids[$i]=='vat')||($ids[$i]=='kwota'))
                                                echo 'else if(!'.$ids[$i].'.validity.valid) {showError'.($i+1).'();}
                                            ';
                                            else echo 'if(!'.$ids[$i].'.validity.valid) {showError'.($i+1).'();}
                                            ';
                                    }
                                    echo '
                                        else{sendData();}
                                        event.preventDefault();
                                    });
                                });';

                            for($i=0; $i<sizeof($ids) ;$i++){
                                echo '
                                function showError'.($i+1).'() {
                                      if('.$ids[$i].'.validity.valueMissing) {
                                        '.$idsErr[$i].'.textContent = \'Pole wymagane!\';';
                                        if(($ids[$i]=='id')) echo $ids[$i].'.className = \'uk-select uk-form-width-large uk-form-danger\';';
                                        else echo $ids[$i].'.className = \'uk-input uk-form-danger\';';
                                    echo '}
                                      else if('.$ids[$i].'.validity.patternMismatch) {
                                        '.$idsErr[$i].'.textContent = \'Niepoprawny zapis!\';';
                                        if(($ids[$i]=='id')) echo $ids[$i].'.className = \'uk-select uk-form-width-large uk-form-danger\';';
                                        else echo $ids[$i].'.className = \'uk-input uk-form-danger\';';
                                    echo '
                                    }
                                  }';
                            }
                            echo '
                                </script>';
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
                ?>
        </main> 
    <!--FOOTER-->    
        <footer>
            <p>Dominika Rzepka &copy; 2021</p>
        </footer>
    </body>
</html>
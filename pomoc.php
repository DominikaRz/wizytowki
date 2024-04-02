<?php 
    session_start(); 
    $_SESSION['here']="po";
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
            if($_SESSION['out']) include('menu2.php');
            else include('menu1.php');
        ?>
    <!--MAIN-->
        <main class="uk-padding uk-margin">
          <h1>Zadanie 6</h1>
            <p>Strona stworzona na potrzeby zadania 6 z baz danych w 2020/2021 rok. Semestr zimowy.</p>
            <p>
                Wszystko w pelni funkcjonalne<br>
                Strona oparta na UIkit, jQuery, PHP, HTML, CSS<br>
                <b>Wszelkie prawa zastrzeżone.<br>
                Publikacja tylko za zgodą wykonawcy!</b>
            </p>
            <!--
                Eksport bazy danych:
                -- phpMyAdmin SQL Dump
                -- version 5.0.2
                -- https://wwwmyadmin.net/
                --
                -- Host: localhost
                -- Czas generowania: 29 Gru 2020, 12:48
                -- Wersja serwera: 10.4.13-MariaDB
                -- Wersja PHP: 7.4.8

                SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
                START TRANSACTION;
                SET time_zone = "+00:00";


                /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
                /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
                /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
                /*!40101 SET NAMES utf8mb4 */;

                --
                -- Baza danych: `domeny`
                --

                -- --------------------------------------------------------

                --
                -- Struktura tabeli dla tabeli `BRANZA`
                --

                CREATE TABLE `BRANZA` (
                `id_branza` int(11) NOT NULL,
                `nazwa_branza` varchar(20) COLLATE utf8mb4_polish_ci NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

                --
                -- Zrzut danych tabeli `BRANZA`
                --

                INSERT INTO `BRANZA` (`id_branza`, `nazwa_branza`) VALUES
                (1, 'administracja'),
                (2, 'budownictwo'),
                (3, 'edukacja'),
                (4, 'ekonomia'),
                (5, 'elektronika'),
                (6, 'gastronomia'),
                (7, 'handel'),
                (8, 'medycyna'),
                (9, 'motoryzacja'),
                (10, 'poligrafia'),
                (11, 'prawo'),
                (12, 'rekreacja'),
                (13, 'rolnictwo'),
                (14, 'technika'),
                (15, 'uroda'),
                (16, 'usługi'),
                (17, 'wyposarzenie wnętrz'),
                (18, 'zdrowie'),
                (19, 'inne');

                -- --------------------------------------------------------

                --
                -- Struktura tabeli dla tabeli `BRANZA_WIZYT`
                --

                CREATE TABLE `BRANZA_WIZYT` (
                `id_branza` int(11) NOT NULL,
                `id_wizytowka` int(11) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

                --
                -- Zrzut danych tabeli `BRANZA_WIZYT`
                --

                INSERT INTO `BRANZA_WIZYT` (`id_branza`, `id_wizytowka`) VALUES
                (5, 1),
                (5, 9),
                (6, 4),
                (6, 5),
                (6, 6),
                (7, 1),
                (7, 2),
                (7, 3),
                (7, 4),
                (7, 5),
                (7, 6),
                (7, 7),
                (7, 8),
                (8, 2),
                (10, 8),
                (16, 1),
                (16, 9),
                (18, 2);

                -- --------------------------------------------------------

                --
                -- Struktura tabeli dla tabeli `DANE_WIZYT`
                --

                CREATE TABLE `DANE_WIZYT` (
                `id_dane` int(11) NOT NULL,
                `id_wizytowka` int(11) NOT NULL,
                `adr_ul_dane` varchar(56) COLLATE utf8mb4_polish_ci DEFAULT NULL,
                `adr_nr_dane` varchar(10) COLLATE utf8mb4_polish_ci DEFAULT NULL,
                `adr_miast_dane` varchar(40) COLLATE utf8mb4_polish_ci DEFAULT NULL,
                `adr_kod_dane` varchar(6) COLLATE utf8mb4_polish_ci DEFAULT NULL,
                `adr_pocz_dane` varchar(40) COLLATE utf8mb4_polish_ci DEFAULT NULL,
                `telefon_dane` varchar(11) COLLATE utf8mb4_polish_ci NOT NULL,
                `mail_dane` varchar(100) COLLATE utf8mb4_polish_ci NOT NULL,
                `str_int_dane` varchar(63) COLLATE utf8mb4_polish_ci DEFAULT NULL,
                `opis_dane` varchar(2000) COLLATE utf8mb4_polish_ci NOT NULL,
                `geo_lat` varchar(9) COLLATE utf8mb4_polish_ci DEFAULT NULL,
                `geo_lon` varchar(9) COLLATE utf8mb4_polish_ci DEFAULT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

                --
                -- Zrzut danych tabeli `DANE_WIZYT`
                --

                INSERT INTO `DANE_WIZYT` (`id_dane`, `id_wizytowka`, `adr_ul_dane`, `adr_nr_dane`, `adr_miast_dane`, `adr_kod_dane`, `adr_pocz_dane`, `telefon_dane`, `mail_dane`, `str_int_dane`, `opis_dane`, `geo_lat`, `geo_lon`) VALUES
                (1, 1, 'Pawłowa', '12/3', 'Wrocław', '53-604', 'Wrocław', '873 462 509', 'biuro@pcserwis.pl', 'https://pcserwis.pl/', 'Oferta PCSERWIS WROCŁAW skierowana jest przede wszystkim do małych i średnich firm. Naszą zaletą jest indywidualne podejście do Klienta, zarówno przy tworzeniu potrzeb działalności konfiguracja w.w. komponentów; udoskonalanie już istniejącej infrastruktury komputerowej; serwis komputerowy(usuwanie usterek sprzętowych i oprogramowania) konfiguracja serwerów', '51.127078', '16.991864'),
                (2, 2, 'Śliczna', '10', 'Wrocław', '50-566', 'Wrocław', '584 751 364', 'meddent@wp.pl', NULL, 'Centrum stomatologii - stomatolog, dentysta Wrocław. Jesteśmy zespołem doświadczonych dentystów w zakresie: Protetyki, Implantologii, Endodoncji, Chirurgii stomatologicznej, Ortodoncji oraz Stomatologii Estetycznej z uwzględnieniem wybielania zębów.Szczycimy się komfortowymi warunkami obsługi Pacjenta oraz zaawansowanymi technologiami medycznymi', '51.084715', '17.03670'),
                (3, 3, 'Nowowiejska', '98', 'Wrocław', '50-339', 'Wrocław', '478 254 645', 'roza@o2.pl', NULL, 'Kwiaciarnia Róża, nieprzerwanie od trzydziestu lat działa na rynku ogólnopolskim jak i zagranicznym, dostarczając kwiaty i prezenty wprost pod drzwi klienta. Wiemy, że w pędzie dzisiejszego życia trudno znaleźć czas na wybór, kupno oraz odbiór kwiatów i upominków. Od tego właśnie jesteśmy my. Nie tylko fachowo doradzimy i dobierzemy odpowiedni gatunek kwiatów i upominków do okoliczności, ale także nasza niezawodna poczta kwiatowo-prezentowa, poprzez współpracujące z nami lokalne kwiaciarnie, doręczy je pod wskazany adres. Nie musicie się niczym martwić, nasz zespół profesjonalistów wprowadzi Państwa w niesamowity świat kwiatów i aranżacji kwiatowych.', '51.118602', '17.059384'),
                (4, 4, 'Sucha', '1', 'Wrocław', '50-086', 'Wrocław', '532 169 306', 'lindt@wroclavia.pl', 'https://www.lindt.pl/', 'Od 175 lat tworzymy najlepszą czekoladę według tradycyjnych wyjątkowych receptur naszych Maître Chocolatier. Nasze produkty powstają na bazie najwyższej jakości składników, zachwycając jakością, kunsztem wykonania i prawdziwie czekoladowym charakterem. Możesz je znaleźć w ponad 120 krajach na całym świecie. Każda tabliczka to niepowtarzalne doświadczenie, którym chcemy się z Tobą dzielić. \r\nHistoria Lindt & Sprüngli sięga roku 1845, kiedy to ojciec i syn zaczęli produkcję jednej z pierwszych czekolad w stałej postaci w niewielkiej cukierni Sprüngli & Son. Dzięki innowacyjnej metodzie konszowania udało się uzyskać wyróżniającą nas jedwabiście gładką konsystencję, z której słyniemy. Właśnie tak powstała prawdziwa szwajcarska czekolada! \r\nNajwyższej jakości czekolada gorzka, aksamitna czekolada mleczna, wyśmienita czekolada biała i dopracowane w każdym calu praliny - mamy nadzieję, że znajdziesz w naszej ofercie swoją ulubioną czekoladę.', '51.097448', '17.034090'),
                (5, 5, 'Bolesława Krzywoustego', '126', 'Wrocław', '51-421', 'Wrocław', '584 326 545', 'biuro@karmello.pl', 'https://www.karmello.pl/', 'Niezwykła i intrygująca historia wyrobu czekolady sięga wieku XVII i jest związana z Hiszpanią. Dla nas przygoda z produkcją czekolady rozpoczęła się w belgijskiej Brugii.\r\nTo niezwykle urokliwe miasteczko, gdzie wśród krętych uliczek istnieje wiele małych i niepowtarzalnych manufaktur czekolady, stało się dla właścicieli firmy inspiracją do \r\nstworzenia Karmello. Ich podróżnicza pasja i miłość do czekolady połączona z chęcią odkrywania nieznanych Polakom kultur i tradycji innych narodów zaowocowała powstaniem \r\nw 2010 roku fabryki w Bielsku- Białej. Zachwyt nad pięknem wyrobów belgijskich mistrzów i rozsmakowanie w wyjątkowych aromatach wzbudziły chęć przeniesienia na rodzimy grunt \r\nkoncepcji wysokiej jakości, niepowtarzalnych czekoladowych specjałów.', '51.14378,', '17.092546'),
                (6, 7, 'Tęczowa', '38', 'Wrocław', '52-007', 'Wrocław', '478 248 468', 'magnolia@wp.pl', NULL, 'Kwiaciarnia Magnolia powstała z marzeń, które towarzyszyły mi w głębi serca od samego dzieciństwa… Z sentymentem wspominam zabawę kwiatami polnymi w układanie bukietów czy zasiadanie na łące i wicie wianków z kończyny dla młodszej siostry… Dziś moje marzenie o otaczaniu się pięknem kwiatów i przebywanie w ich czarujących zapachach realizuje się w mojej codziennej pracy. Współpracuję ze wspaniałymi Kobietami, które tak jak ja, kochają otaczającą nas przyrodę, są wrażliwe na piękno kwiatów, mają wysokie poczucie estetyki i cieszą się swoją pracą.', '51.105654', '17.015840'),
                (7, 6, 'Klecińska', '186', 'Wrocław', '54-412', 'Wrocław', '478 458 246', 'eden-wroclaw@gmail.com', 'https://www.eden.pl/', 'Krystalicznie czysta woda źródlana Eden wypływa z najczystszych ujęć głębinowych w Polsce. Naszą wodę wydobywamy z szacunkiem dla środowiska naturalnego i z zachowaniem najwyższych norm kontroli jakości. Własne laboratoria przy rozlewniach pozwalają na regularne badania wody co 2 godziny, na każdym etapie jej wydobycia i nalewania do butli.', '51.11082', '16.96777'),
                (8, 8, 'Piotra Skargi', '23/1', 'Wrocław', '50-082', 'Wrocław', '458 588 989', 'artshop@gmail.com', NULL, 'Zaopatrujemy w potrzebne materiały: artystów,  plastyków, architektów, konserwatorów, uczniów szkół plastycznych i uczelnie artystyczne od 2002 roku. Każdy odnajdzie w sieci naszych sklepów artykuły plastyczne i artystyczne potrzebne do stworzenia wielkich i małych dzieł sztuki. Nasza oferta to najwyższej jakości artykuły plastyczne zapewniające komfort pracy profesjonalistom jak i amatorom.  Zatrudniamy fachowców służących cennymi poradami. Przodujący na rynku producenci zaopatrują nasze sklepy w artykuły dla plastyków i amatorów sztuk plastycznych, a także nasz sklep internetowy w papier, farby akrylowe, olejne, farby do szkła, do tkanin i ceramiki, pędzle, sztalugi, dłuta i wiele innych. Dla mniej wymagających służymy tańszymi odpowiednikami.', '51.10506', '17.03427'),
                (9, 9, 'Jerzego Bajana', '67', 'Wrocław', '54-129', 'Wrocław', '478 658 671', 'agdkowalczyk@gamil.com', NULL, 'Jest to firma o ugruntowanej pozycji i wieloletnim doświadczeniu. Od 2000 roku z sukcesem wzmacniamy naszą rynkową pozycję. Obecnie jesteśmy jednym z liderów  branży IT. Swoją markę budujemy na długofalowych relacjach, opartych na wysokiej jakości świadczonych usług. Dostarczamy naszym Klientom produkty największych światowych producentów. W budowaniu sukcesu bazujemy na wiedzy, doświadczeniu i innowacyjności.', '51.124941', '16.959942');

                -- --------------------------------------------------------

                --
                -- Struktura tabeli dla tabeli `FORMA_UMOWA`
                --

                CREATE TABLE `FORMA_UMOWA` (
                `id_forma` int(11) NOT NULL,
                `id_wizytowka` int(11) NOT NULL,
                `nazwa_forma` varchar(10) COLLATE utf8mb4_polish_ci NOT NULL,
                `czas_zawarcia_forma` datetime NOT NULL,
                `czas_zakonczenia_forma` datetime NOT NULL,
                `serwer_forma` tinyint(1) DEFAULT NULL,
                `wielkosc_serwer_forma` float DEFAULT NULL,
                `opis_forma` varchar(400) COLLATE utf8mb4_polish_ci DEFAULT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

                --
                -- Zrzut danych tabeli `FORMA_UMOWA`
                --

                INSERT INTO `FORMA_UMOWA` (`id_forma`, `id_wizytowka`, `nazwa_forma`, `czas_zawarcia_forma`, `czas_zakonczenia_forma`, `serwer_forma`, `wielkosc_serwer_forma`, `opis_forma`) VALUES
                (1, 1, 'roczna', '2019-12-20 15:45:12', '2020-12-20 15:45:12', 0, 0, 'Wizytówka bez dodatowych danych.'),
                (2, 2, 'roczna', '2020-01-03 13:21:00', '2021-01-03 13:21:00', 0, 0, 'Wizytówka bez dodatowych danych.'),
                (3, 3, 'roczna', '2020-01-24 12:24:21', '2021-01-24 12:24:21', 1, 10.25, 'Wizytówka z dodatowym miejscem na życzenie zamawiającego.'),
                (4, 4, 'miesięczna', '2020-02-28 10:12:20', '2020-03-28 10:12:20', 0, 0, 'Wizytówka bez dodatowych danych.'),
                (5, 5, 'kwartalna', '2020-02-28 12:09:30', '2020-04-28 12:09:30', 0, 0, 'Wizytówka bez dodatowych danych.'),
                (6, 4, 'miesięczna', '2020-03-28 10:12:20', '2020-04-28 10:12:20', 0, 0, 'Wizytówka bez dodatowych danych.'),
                (7, 4, 'miesięczna', '2020-04-28 10:12:20', '2020-05-28 10:12:20', 0, 0, 'Wizytówka bez dodatowych danych.'),
                (8, 6, 'roczna', '2020-05-02 20:10:20', '2020-05-02 20:10:20', 0, 0, 'Wizytówka bez dodatowych danych.'),
                (9, 5, 'kwartalna', '2020-04-28 12:09:30', '2020-07-28 12:09:30', 0, 0, 'Wizytówka bez dodatowych danych.'),
                (10, 4, 'miesięczna', '2020-05-28 10:12:20', '2020-06-28 10:12:20', 0, 0, 'Wizytówka bez dodatowych danych.'),
                (11, 4, 'miesięczna', '2020-06-28 10:12:20', '2020-07-28 10:12:20', 0, 0, 'Wizytówka bez dodatowych danych.'),
                (12, 4, 'miesięczna', '2020-07-28 10:12:20', '2020-08-28 10:12:20', 0, 0, 'Wizytówka bez dodatowych danych.'),
                (13, 5, 'kwartalna', '2020-07-28 12:09:30', '2020-10-28 12:09:30', 0, 0, 'Wizytówka bez dodatowych danych.'),
                (14, 7, 'roczna', '2020-07-31 20:20:10', '2021-07-31 20:20:10', 1, 5.3, 'Wizytówka z dodatowym miejscem na życzenie zamawiającego.'),
                (15, 4, 'miesięczna', '2020-08-28 10:12:20', '2020-09-28 10:12:20', 0, 0, 'Wizytówka bez dodatowych danych.'),
                (16, 4, 'miesięczna', '2020-09-28 10:12:20', '2020-10-28 10:12:20', 0, 0, 'Wizytówka bez dodatowych danych.'),
                (17, 8, 'roczna', '2020-09-30 12:10:11', '2021-09-30 12:10:11', 0, 0, 'Wizytówka bez dodatowych danych.'),
                (18, 9, 'roczna', '2020-10-04 17:30:00', '2021-10-04 17:30:00', 0, 0, 'Wizytówka bez dodatowych danych.'),
                (19, 4, 'miesięczna', '2020-10-28 10:12:20', '2020-11-28 10:12:20', 0, 0, 'Wizytówka bez dodatowych danych.'),
                (20, 5, 'kwartalna', '2020-10-28 12:09:30', '2021-01-28 12:09:30', 0, 0, 'Wizytówka bez dodatowych danych.'),
                (21, 4, 'miesięczna', '2020-11-28 10:12:20', '2020-12-28 10:12:20', 0, 0, 'Wizytówka bez dodatowych danych.');

                -- --------------------------------------------------------

                --
                -- Struktura tabeli dla tabeli `UMOWA`
                --

                CREATE TABLE `UMOWA` (
                `id_umowa` int(11) NOT NULL,
                `id_zamawiajacy` int(11) NOT NULL,
                `data_umowa` date NOT NULL,
                `netto_umowa` float NOT NULL,
                `rabat_umowa` int(11) DEFAULT NULL,
                `VAT_umowa` float NOT NULL,
                `kwota_umowa` float NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

                --
                -- Zrzut danych tabeli `UMOWA`
                --

                INSERT INTO `UMOWA` (`id_umowa`, `id_zamawiajacy`, `data_umowa`, `netto_umowa`, `rabat_umowa`, `VAT_umowa`, `kwota_umowa`) VALUES
                (1, 1, '2019-12-20', 205, 0, 47.15, 252.15),
                (2, 2, '2020-01-03', 205, 0, 47.15, 252.15),
                (3, 3, '2020-01-24', 245, 0, 56.35, 301.35),
                (4, 4, '2020-02-28', 15, 0, 3.45, 18.45),
                (5, 5, '2020-02-28', 50, 0, 11.5, 61.5),
                (6, 4, '2020-03-28', 15, 0, 3.45, 18.45),
                (7, 4, '2020-04-28', 15, 0, 3.45, 18.45),
                (8, 6, '2020-05-02', 205, 0, 47.15, 252.15),
                (9, 5, '2020-04-28', 50, 0, 11.5, 61.5),
                (10, 4, '2020-05-28', 15, 0, 3.45, 18.45),
                (11, 4, '2020-06-28', 15, 0, 3.45, 18.45),
                (12, 4, '2020-06-28', 15, 0, 3.45, 18.45),
                (13, 5, '2020-07-28', 50, 0, 11.5, 61.5),
                (14, 3, '2020-07-31', 220, 0, 50.6, 270.6),
                (15, 4, '2020-08-28', 15, 0, 3.45, 18.45),
                (16, 4, '2020-08-28', 15, 0, 3.45, 18.45),
                (17, 7, '2020-09-30', 205, 0, 47.15, 252.15),
                (18, 8, '2020-10-04', 205, 0, 47.15, 252.15),
                (19, 4, '2020-10-28', 15, 0, 3.45, 18.45),
                (20, 5, '2020-10-28', 50, 0, 11.5, 61.5),
                (21, 4, '2020-11-28', 15, 0, 3.45, 18.45);

                -- --------------------------------------------------------

                --
                -- Struktura tabeli dla tabeli `WIZYTOWKA`
                --

                CREATE TABLE `WIZYTOWKA` (
                `id_wizytowka` int(11) NOT NULL,
                `domena_wizyt` varchar(45) COLLATE utf8mb4_polish_ci NOT NULL,
                `logo_wizyt` longblob DEFAULT NULL,
                `opis_skr_wizyt` longtext COLLATE utf8mb4_polish_ci NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

                --
                -- Zrzut danych tabeli `WIZYTOWKA`
                --

                INSERT INTO `WIZYTOWKA` (`id_wizytowka`, `domena_wizyt`, `logo_wizyt`, `opis_skr_wizyt`) VALUES
                (1, 'pcserwis.wizyt.pl', NULL, 'Serwis komputerowy Wrocław.'),
                (2, 'meddent.wizyt.pl', NULL, 'Przychodnia stomatologiczna Wrocław.'),
                (3, 'roza.wizyt.pl', NULL, 'kwiaciarnia \"RÓŻA\" Wrocław.'),
                (4, 'lindt.wizyt.pl', NULL, 'Sklep firmowy Lindt Lindor Wrocław.'),
                (5, 'karmello.wizyt.pl', NULL, 'Czekoladziarnia Karmello Wrocław.'),
                (6, 'woda.wizyt.pl', NULL, 'Dystrybucja wody butelkowanej Wrocław.'),
                (7, 'magnolia.wizyt.pl', NULL, 'kwiaciarnia \"MAGNOLIA\" Wrocław.'),
                (8, 'artshop.wizyt.pl', NULL, 'Sklep artystyczny \"ArtShop\" Wrocław.'),
                (9, 'agd.wizyt.pl', NULL, 'Sklep AGD Wrocław.');

                -- --------------------------------------------------------

                --
                -- Struktura tabeli dla tabeli `WIZYT_UMOWA`
                --

                CREATE TABLE `WIZYT_UMOWA` (
                `id_wizytowka` int(11) NOT NULL,
                `id_umowa` int(11) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

                --
                -- Zrzut danych tabeli `WIZYT_UMOWA`
                --

                INSERT INTO `WIZYT_UMOWA` (`id_wizytowka`, `id_umowa`) VALUES
                (1, 1),
                (2, 2),
                (3, 3),
                (4, 4),
                (4, 6),
                (4, 7),
                (4, 10),
                (4, 11),
                (4, 12),
                (4, 15),
                (4, 16),
                (4, 19),
                (4, 21),
                (5, 5),
                (5, 9),
                (5, 13),
                (5, 20),
                (6, 8),
                (7, 14),
                (8, 17),
                (9, 18);

                -- --------------------------------------------------------

                --
                -- Struktura tabeli dla tabeli `ZAMAWIAJACY`
                --

                CREATE TABLE `ZAMAWIAJACY` (
                `id_zamawiajacy` int(11) NOT NULL,
                `imie_zamaw` varchar(13) COLLATE utf8mb4_polish_ci NOT NULL,
                `nazwisko_zamaw` varchar(27) COLLATE utf8mb4_polish_ci NOT NULL,
                `nazwa_fr_zamaw` varchar(40) COLLATE utf8mb4_polish_ci DEFAULT NULL,
                `telefon_zamaw` varchar(11) COLLATE utf8mb4_polish_ci NOT NULL,
                `mail_zamaw` varchar(100) COLLATE utf8mb4_polish_ci NOT NULL,
                `adres_ul_zamaw` varchar(56) COLLATE utf8mb4_polish_ci NOT NULL,
                `adres_nr_zamaw` varchar(10) COLLATE utf8mb4_polish_ci NOT NULL,
                `adres_miast_zamaw` varchar(40) COLLATE utf8mb4_polish_ci NOT NULL,
                `adres_kod_zamaw` varchar(6) COLLATE utf8mb4_polish_ci NOT NULL,
                `adres_pocz_zamaw` varchar(40) COLLATE utf8mb4_polish_ci NOT NULL,
                `PESEL_zamaw` longtext COLLATE utf8mb4_polish_ci NOT NULL,
                `NIP_zamaw` varchar(10) COLLATE utf8mb4_polish_ci DEFAULT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

                --
                -- Zrzut danych tabeli `ZAMAWIAJACY`
                --

                INSERT INTO `ZAMAWIAJACY` (`id_zamawiajacy`, `imie_zamaw`, `nazwisko_zamaw`, `nazwa_fr_zamaw`, `telefon_zamaw`, `mail_zamaw`, `adres_ul_zamaw`, `adres_nr_zamaw`, `adres_miast_zamaw`, `adres_kod_zamaw`, `adres_pocz_zamaw`, `PESEL_zamaw`, `NIP_zamaw`) VALUES
                (1, 'Hubert', 'Garecki', 'PCSerwis', '478 669 946', 'hubertg@gmail.com', 'Iwana Pawłowa', '12/4', 'Wrocław', '53-604', 'Wrocław', '47854879586', '4784757845'),
                (2, 'Jadwiga', 'Rodecka', 'MedDent', '475 414 548', 'radeckaj@gmail.com', 'Śliczna', '11', 'Wrocław', '50-566', 'Wrocław', '4784758965', '4784875986'),
                (3, 'Zuzanna', 'Korczyńska', NULL, '748 578 265', 'zuza.korczynska@gmail.com', 'Wojciecha Cybulskiego', '8', 'Wrocław', '52-007', 'Wrocław', '25416548495', '4784759613'),
                (4, 'Adam', 'Kowalski', 'Lindt Lindor Polska', '148 574 954', 'a.kowalski@lindt.pl', 'Kurzy Targ', '2', 'Wrocław', '50-114', 'Wrocław', '54875986256', '1452854795'),
                (5, 'Wojciech', 'Adamowicz', 'Karmello Polska', '478 547 947', 'adamowiczw@karmello.pl', 'Kazimierza Wielkiego', '43', 'Wrocław', '50-116', 'Wrocław', '4875847895', '3265895784'),
                (6, 'Roman', 'Hojnowski', 'Eden Wrocław', '478 874 587', 'hojnowski.roman@eden.pl', 'Piłsudskiego', '72', 'Wrocław', '50-529', 'Wrocław', '6254789587', '4784579265'),
                (7, 'Marcelina', 'Gazda', 'ArtDhop', '475 947 356', 'gazda_marce@o2.pl', 'Skwierzyńska', '27', 'Wrocław', '53-521', 'Wrocław', '5478475895', '3526487598'),
                (8, 'Jan', 'Kowalczyk', 'AGD Kowalczyk', '147 958 125', 'agdkowalczyk@gamil.com', 'Jerzego Bajana', '68', 'Wrocław', '54-129', 'Wrocław', '2541578495', '2587495875');

                --
                -- Indeksy dla zrzutów tabel
                --

                --
                -- Indeksy dla tabeli `BRANZA`
                --
                ALTER TABLE `BRANZA`
                ADD PRIMARY KEY (`id_branza`);

                --
                -- Indeksy dla tabeli `BRANZA_WIZYT`
                --
                ALTER TABLE `BRANZA_WIZYT`
                ADD PRIMARY KEY (`id_branza`,`id_wizytowka`),
                ADD KEY `FK_BRANZA_WIZYT2` (`id_wizytowka`);

                --
                -- Indeksy dla tabeli `DANE_WIZYT`
                --
                ALTER TABLE `DANE_WIZYT`
                ADD PRIMARY KEY (`id_dane`),
                ADD KEY `FK_WIZYT_DANE` (`id_wizytowka`);

                --
                -- Indeksy dla tabeli `FORMA_UMOWA`
                --
                ALTER TABLE `FORMA_UMOWA`
                ADD PRIMARY KEY (`id_forma`),
                ADD KEY `FK_FORMA2` (`id_wizytowka`);

                --
                -- Indeksy dla tabeli `UMOWA`
                --
                ALTER TABLE `UMOWA`
                ADD PRIMARY KEY (`id_umowa`),
                ADD KEY `FK_ZAMAW_UMOWA` (`id_zamawiajacy`);

                --
                -- Indeksy dla tabeli `WIZYTOWKA`
                --
                ALTER TABLE `WIZYTOWKA`
                ADD PRIMARY KEY (`id_wizytowka`);

                --
                -- Indeksy dla tabeli `WIZYT_UMOWA`
                --
                ALTER TABLE `WIZYT_UMOWA`
                ADD PRIMARY KEY (`id_wizytowka`,`id_umowa`),
                ADD KEY `FK_WIZYT_UMOWA2` (`id_umowa`);

                --
                -- Indeksy dla tabeli `ZAMAWIAJACY`
                --
                ALTER TABLE `ZAMAWIAJACY`
                ADD PRIMARY KEY (`id_zamawiajacy`);

                --
                -- AUTO_INCREMENT for dumped tables
                --

                --
                -- AUTO_INCREMENT dla tabeli `BRANZA`
                --
                ALTER TABLE `BRANZA`
                MODIFY `id_branza` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

                --
                -- AUTO_INCREMENT dla tabeli `DANE_WIZYT`
                --
                ALTER TABLE `DANE_WIZYT`
                MODIFY `id_dane` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

                --
                -- AUTO_INCREMENT dla tabeli `FORMA_UMOWA`
                --
                ALTER TABLE `FORMA_UMOWA`
                MODIFY `id_forma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

                --
                -- AUTO_INCREMENT dla tabeli `UMOWA`
                --
                ALTER TABLE `UMOWA`
                MODIFY `id_umowa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

                --
                -- AUTO_INCREMENT dla tabeli `WIZYTOWKA`
                --
                ALTER TABLE `WIZYTOWKA`
                MODIFY `id_wizytowka` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

                --
                -- AUTO_INCREMENT dla tabeli `ZAMAWIAJACY`
                --
                ALTER TABLE `ZAMAWIAJACY`
                MODIFY `id_zamawiajacy` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

                --
                -- Ograniczenia dla zrzutów tabel
                --

                --
                -- Ograniczenia dla tabeli `BRANZA_WIZYT`
                --
                ALTER TABLE `BRANZA_WIZYT`
                ADD CONSTRAINT `FK_BRANZA_WIZYT` FOREIGN KEY (`id_branza`) REFERENCES `BRANZA` (`id_branza`),
                ADD CONSTRAINT `FK_BRANZA_WIZYT2` FOREIGN KEY (`id_wizytowka`) REFERENCES `WIZYTOWKA` (`id_wizytowka`);

                --
                -- Ograniczenia dla tabeli `DANE_WIZYT`
                --
                ALTER TABLE `DANE_WIZYT`
                ADD CONSTRAINT `FK_WIZYT_DANE` FOREIGN KEY (`id_wizytowka`) REFERENCES `WIZYTOWKA` (`id_wizytowka`);

                --
                -- Ograniczenia dla tabeli `FORMA_UMOWA`
                --
                ALTER TABLE `FORMA_UMOWA`
                ADD CONSTRAINT `FK_FORMA2` FOREIGN KEY (`id_wizytowka`) REFERENCES `WIZYTOWKA` (`id_wizytowka`);

                --
                -- Ograniczenia dla tabeli `UMOWA`
                --
                ALTER TABLE `UMOWA`
                ADD CONSTRAINT `FK_ZAMAW_UMOWA` FOREIGN KEY (`id_zamawiajacy`) REFERENCES `ZAMAWIAJACY` (`id_zamawiajacy`);

                --
                -- Ograniczenia dla tabeli `WIZYT_UMOWA`
                --
                ALTER TABLE `WIZYT_UMOWA`
                ADD CONSTRAINT `FK_WIZYT_UMOWA` FOREIGN KEY (`id_wizytowka`) REFERENCES `WIZYTOWKA` (`id_wizytowka`),
                ADD CONSTRAINT `FK_WIZYT_UMOWA2` FOREIGN KEY (`id_umowa`) REFERENCES `UMOWA` (`id_umowa`);
                COMMIT;

                /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
                /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
                /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;  
                -->
        </main> 
    <!--FOOTER-->    
        <footer>
            <p>Dominika Rzepka &copy; 2021</p>
        </footer>
    </body>
</html>
<?php
    $current_file_name = basename($_SERVER['PHP_SELF']);
    switch($current_file_name)
    {
        case "footer.php":
            $snum = 0;
            break;
        default:
            $snum = 1;
            break;
    }
    if(!$snum)
    {
        exit("Pristup odbijen");
    }
?>


<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="CSS/footer.css">
<link href='https://fonts.googleapis.com/css?family=Alegreya Sans SC' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Aldrich' rel='stylesheet'>
<script src="https://kit.fontawesome.com/64aa23952d.js" crossorigin="anonymous"></script>

<footer class="footer-distributed">

    <div id="footer-left">
        <div id="f_logo">
            <img src="Images/f_logo.png" alt="">
            <span id="logo_s">
                <div>Srednja</div>
                <div>Strukovna</div>
                <div>Škola</div>
            </span>
            <span id="logo_j">JAJCE</span>
        </div>

        <div id="footer-links">
            <a href="/">Obavijesti</a>
            <a href="zanimanja">Zanimanja</a>
            <a href="o-nama">O nama</a>
        </div>

        <div id="footer-company-name">Srednja Strukovna Škola "Jajce", Jajce &bull; <?php echo date("Y");?></div>
    </div>
    
    <div class="sep">&nbsp;</div>

    <div id="footer-center">
        <div>
            <i class="fa-solid fa-location-dot"></i>
            <span><a href="https://www.google.com/maps/@44.3471397,17.2540817,167m/data=!3m1!1e3" target="_blank">Berte Kučere 3, 70101 Jajce</a></span>
        </div>

        <div>
            <i class="fa-solid fa-phone"></i>
            <span>+387 30 654 273</span>
        </div>

        <div>
            <i class="fa-solid fa-envelope"></i>
            <span><a href="mailto:s.strukovna.s.jajce@outlook.com">s.strukovna.s.jajce@outlook.com</a></span>
        </div>
    </div>

    <div class="sep">&nbsp;</div>

    <div id="footer-right">
        <p id="footer-company-about">
            <span>www.sssjajce.com</span>

            <span class="description">
                Službena web stranica Srednje Strukovne Škole "Jajce".
                Ovdje možete pronaći školske obavijesti, aktivnosti, zanimanja i druge informacije...
            </span>
        </p>

        <div id="footer-icon">
            <a href="https://www.facebook.com/Srednja-strukovna-%C5%A1kola-Jajce-Jajce-109062934059121/" target="_blank"><i class="fa-brands fa-facebook"></i></a>
            <a href="https://www.facebook.com/Srednja-strukovna-%C5%A1kola-Jajce-Jajce-109062934059121/" target="_blank" class="fb_t">Facebook stranica</a>
        </div>

        <div id="right-end">
            <div class="footer_by">
                <span>
                    Developed by:<br>
                    Designed by:
                </span>
                <span>
                    Ivan Tokić<br>
                    Ajdin Kahrić
                </span>
            </div>
            <a href="login" id="login">
                Administrator prijava
            </a>
        </div>
    </div>

</footer>


<footer class="footer-mob">

    <div id="fr">
        <span id="fr-t">www.sssjajce.com</span>

        <span class="description">
            Službena web stranica Srednje Strukovne Škole "Jajce".
            Ovdje možete pronaći školske obavijesti, aktivnosti, zanimanja i druge informacije...
        </span>
    </div>

    <div class="sep" id="sep1">&nbsp;</div>

    <div id="se">
        <div class="nzd">
            <i class="fa-solid fa-location-dot"></i>
            <span><a href="https://www.google.com/maps/@44.3471397,17.2540817,167m/data=!3m1!1e3" target="_blank">Berte Kučere 3, 70101 Jajce</a></span>
        </div>

        <div class="nzd">
            <i class="fa-solid fa-phone"></i>
            <span>+387 30 654 273</span>
        </div>

        <div id="zdd">
            <i class="fa-solid fa-envelope"></i>
            <span><a href="mailto:s.strukovna.s.jajce@outlook.com">s.strukovna.s.jajce@outlook.com</a></span>
        </div>
    </div>

    <div class="sep" id="sep2">&nbsp;</div>

    <div id="th">
        <div id="fb-mob">
            <a href="https://www.facebook.com/Srednja-strukovna-%C5%A1kola-Jajce-Jajce-109062934059121/" target="_blank"><i class="fa-brands fa-facebook"></i></a>
            <a href="https://www.facebook.com/Srednja-strukovna-%C5%A1kola-Jajce-Jajce-109062934059121/" target="_blank" class="fb_t">Facebook stranica</a>
        </div>

        <div id="th-end">
            <div class="footer_by">
                <span>
                    Developed by:<br>
                    Designed by:
                </span>
                <span>
                    Ivan Tokić<br>
                    Ajdin Kahrić
                </span>
            </div>
            <a href="login" id="login-mob">
                Administrator prijava
            </a>
        </div>

        <div id="com-mob">
            <span>Srednja Strukovna Škola "Jajce", Jajce &bull; <?php echo date("Y");?></span>
        </div>
    </div>

</footer>
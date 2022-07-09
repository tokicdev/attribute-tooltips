<?php
    $current_file_name = basename($_SERVER['PHP_SELF']);
    switch($current_file_name)
    {
        case "index.php":
            $snum = 1;
            break;
        case "zanimanja.php":
            $snum = 2;
            break;
        case "o-nama.php":
            $snum = 3;
            break;
        case "menu.php":
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
<link rel="stylesheet" href="CSS/menu.css">
<script>
    var menunc = 0;
    var menustat = 0;
    function menu()
    {
        menunc = 1;
        if(!menustat)
        {
            menustat = 1;
            document.getElementsByTagName("body")[0].scroll = "no";
            document.getElementsByTagName("body")[0].style.overflow = "hidden";
            document.getElementById("menu-wrap2").style.height = "30vmin";
            document.getElementById("menu-wrap2").style.opacity = "1";
            document.getElementById("menu-wrap2").style.borderBottom = "1px solid white";
            document.getElementById("blur").style.display = "block";
            document.getElementById("blur").style.opacity = "1";
        }
        else
        {
            menustat = 0;
            document.getElementsByTagName("body")[0].scroll = "yes";
            document.getElementsByTagName("body")[0].style.overflow = "visible";
            document.getElementById("menu-wrap2").style.height = "0";
            document.getElementById("menu-wrap2").style.opacity = "0";
            document.getElementById("menu-wrap2").style.borderBottom = "none";
            document.getElementById("blur").style.display = "none";
            document.getElementById("blur").style.opacity = "0";
        }
    }

    setInterval(menucheck, 500);
    function menucheck()
    {
        if(innerHeight <= innerWidth)
        {
            if(menunc == 1)
            {
                if(menustat == 0)
                {
                    menustat = 1;
                    menunc = 5;
                    document.getElementsByTagName("body")[0].scroll = "yes";
                    document.getElementsByTagName("body")[0].style.overflow = "visible";
                    document.getElementById("menu-wrap2").style.height = "100%";
                    document.getElementById("menu-wrap2").style.opacity = "1";
                    document.getElementById("menu-wrap2").style.borderBottom = "1px solid white";
                    document.getElementById("blur").style.display = "none";
                    document.getElementById("blur").style.opacity = "0";
                }
                else
                {
                    menustat = 0;
                    document.getElementsByTagName("body")[0].scroll = "yes";
                    document.getElementsByTagName("body")[0].style.overflow = "visible";
                    document.getElementById("menu-wrap2").style.height = "0";
                    document.getElementById("menu-wrap2").style.opacity = "0";
                    document.getElementById("menu-wrap2").style.borderBottom = "none";
                    document.getElementById("blur").style.display = "none";
                    document.getElementById("blur").style.opacity = "0";
                }
            }
        }
        else
        {
            if(menunc == 5)
            {
                menustat = 0;
                document.getElementsByTagName("body")[0].scroll = "yes";
                document.getElementsByTagName("body")[0].style.overflow = "visible";
                document.getElementById("menu-wrap2").style.height = "0";
                document.getElementById("menu-wrap2").style.opacity = "0";
                document.getElementById("menu-wrap2").style.borderBottom = "none";
                document.getElementById("blur").style.display = "none";
                document.getElementById("blur").style.opacity = "0";
                menunc = 1;
            }
        }
    }
</script>
<div id="menu-wrap">
        <nav class="menu">
            <div id="menu-wrap2">
                <a href="/"><span class="span-left"></span>Obavijesti<span class="span-right"></span></a>
                <a href="zanimanja"><span class="span-left"></span>Zanimanja<span class="span-right"></span></a>
                <a href="o-nama"><span class="span-left"></span>O nama<span class="span-right"></span></a>
                <div class="ans animation start-<?php echo $snum; ?>"></div>
            </div>
            <div id="menu-logo">
                <span id="m-l-img1"><img onclick="window.open('/', '_self')" src="Images/m_logo.png" alt=""></span>
                <span id="m-l-t">Srednja Strukovna Škola<br><span>"JAJCE"</span></span>
                <span id="m-l-img2"><img onclick="menu()" src="Images/navimg.png" alt=""></span>
            </div>
        </nav>
</div>
<div id="blur" onclick="menu()">&nbsp;</div>
<html lang="bs">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Službena web stranica Srednje Strukovne Škole &quot;Jajce&quot;. Ovdje možete pronaći školske obavijesti, aktivnosti, zanimanja i druge informacije...">
    <meta name="keywords" content="Srednja, strukovna, škola, Jajce, skola, &quot;Jajce&quot;, sssjajce, sssjajce.com, SSŠ, SSS, zanimanja, upis, smjerovi">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Srednja Strukovna Škola "Jajce" - Zanimanja</title>
    <link rel="icon" href="Images/favicon.png">
    <link rel="stylesheet" href="CSS/zanimanja.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php include "menu.php";?>

    <div id="title">
        Srednja Strukovna Škola "JAJCE"
    </div>

    <div id="main">
        
        <div id="z_title_out"></div>
        <div id="z_title">
            <p>Zanimanja</p>
        </div>

        <div id="container">
            <div id="mttl">
                <span>Zanimanja u školskoj 2021./2022. godini</span>
            </div>

            <table id="tA">
                <tr class="cc">
                    <td>
                        Elektrotehnika (A)
                    </td>
                    <td>
                        Ugostiteljstvo i turizam (A)
                    </td>
                    <td>
                        Graditeljstvo, geodezija i građevinski materijali (A)
                    </td>
                    <td>
                        Šumarstvo (A)
                    </td>
                </tr>
                <tr class="nc">
                    <td onclick="openPop(1)">
                        <span class="sp">Tehničar za računalstvo</span>
                        <span class="tooltip"><div></div></span>
                    </td>
                    <td onclick="openPop(2)" rowspan="2">
                        <span class="sp">Hotelijersko-turistički tehničar</span>
                        <span class="tooltip"><div></div></span>
                    </td>
                    <td onclick="openPop(3)" rowspan="2">
                        <span class="sp">Građevinski tehničar (visokogradnja)</span>
                        <span class="tooltip"><div></div></span>
                    </td>
                    <td onclick="openPop(0)" rowspan="2">
                        Šumarski tehničar
                    </td>
                </tr>
                <tr class="nc">
                    <td onclick="openPop(0)">
                        Tehničar za mehatroniku
                    </td>
                </tr>
            </table>

            <table id="tC">
                <tr class="cc">
                    <td>
                        Ugostiteljstvo i turizam (C)
                    </td>
                    <td>
                        Graditeljstvo, geodezija i građevinski materijali (C)
                    </td>
                    <td>
                        Strojarstvo (C)
                    </td>
                </tr>
                <tr class="nc">
                    <td onclick="openPop(6)">
                        <span class="sp">Kuhar</span>
                        <span class="tooltip"><div></div></span>
                    </td>
                    <td onclick="openPop(0)" rowspan="2">
                        Keramičar-oblagač
                    </td>
                    <td onclick="openPop(4)">
                        <span class="sp">Bravar</span>
                        <span class="tooltip"><div></div></span>
                    </td>
                </tr>
                <tr class="nc">
                    <td onclick="openPop(0)">
                        Konobar
                    </td>
                    <td onclick="openPop(5)">
                        <span class="sp">CNC-operater</span>
                        <span class="tooltip"><div></div></span>
                    </td>
                </tr>
            </table>

            <div id="mob">
                <div id="mob_mttl">
                    <span>Zanimanja u školskoj 2021./2022. godini</span>
                </div>
                <table id="tM">
                    <tr class="norm">
                        <td class="nas">
                            Elektrotehnika (A)
                        </td>
                    </tr>
                    <tr class="norm">
                        <td onclick="openPop(1)">
                            <span>Tehničar za računalstvo</span>
                            <div></div>
                        </td>
                    </tr>
                    <tr class="norm">
                        <td onclick="openPop(0)">
                            Tehničar za energetiku
                        </td>
                    </tr>
                    <tr class="odv"><td>&nbsp;</td></tr>
                    <tr class="norm">
                        <td class="nas">
                            Ugostiteljstvo i turizam (A)
                        </td>
                    </tr>
                    <tr class="norm">
                        <td onclick="openPop(2)">
                            <span>Hotelijersko-turistički tehničar</span>
                            <div></div>
                        </td>
                    </tr>
                    <tr class="odv"><td>&nbsp;</td></tr>
                    <tr class="norm">
                        <td class="nas">
                            Graditeljstvo, geodezija i građevinski materijali (A)
                        </td>
                    </tr>
                    <tr class="norm">
                        <td onclick="openPop(3)">
                            <span>Građevinski tehničar (visokogradnja)</span>
                            <div></div>
                        </td>
                    </tr>
                    <tr class="odv"><td>&nbsp;</td></tr>
                    <tr class="norm">
                        <td class="nas">
                            Šumarstvo (A)
                        </td>
                    </tr>
                    <tr class="norm">
                        <td onclick="openPop(0)">
                            Šumarski tehničar
                        </td>
                    </tr>
                    <tr class="odv"><td>&nbsp;</td></tr>
                    <tr class="odv"><td>&nbsp;</td></tr>
                    <tr class="norm">
                        <td class="nas">
                            Ugostiteljstvo i turizam (C)
                        </td>
                    </tr>
                    <tr class="norm">
                        <td onclick="openPop(6)">
                            <span>Kuhar</span>
                            <div></div>
                        </td>
                    </tr>
                    <tr class="norm">
                        <td onclick="openPop(0)">
                            Konobar
                        </td>
                    </tr>
                    <tr class="odv"><td>&nbsp;</td></tr>
                    <tr class="norm">
                        <td class="nas">
                            Graditeljstvo, geodezija i građevinski materijali (C)
                        </td>
                    </tr>
                    <tr class="norm">
                        <td onclick="openPop(0)">
                            Keramičar-oblagač
                        </td>
                    </tr>
                    <tr class="odv"><td>&nbsp;</td></tr>
                    <tr class="norm">
                        <td class="nas">
                            Strojarstvo (C)
                        </td>
                    </tr>
                    <tr class="norm">
                        <td onclick="openPop(4)">
                            <span>Bravar</span>
                            <div></div>
                        </td>
                    </tr>
                    <tr class="norm">
                        <td onclick="openPop(5)">
                            <span>CNC-operater</span>
                            <div></div>
                        </td>
                    </tr>
                </table>
            </div>

            <div id="n-wrap">
                <div id="nap">
                    * Područja rada:
                </div>
                <div id="n-det">
                    <span>
                        A - četverogodišnji plan i program
                    </span>
                    <span>
                        C - trogodišnji plan i program
                    </span>
                </div>
            </div>
        </div>

        <div id="zanim">
            <span id="zanimttl"></span>
            <img id="zanimimg" onclick="dwnldPop()" src="" alt="">
            <div><a id="dwnld" href="" download><i class="fa fa-download"></i>&nbsp;Preuzmi datoteku (.xlsx)</a></div>
        </div>
    </div>
    
    <?php include "footer.php";?>

    <script>
        setInterval(d, 70);
        var oldHeight = window.innerHeight;
        function d()
        {
            if(innerHeight <= innerWidth)
            {
                if((document.documentElement.scrollTop || document.body.scrollTop) > 0)
                {
                    if((document.getElementsByTagName("body")[0].offsetHeight / (document.documentElement.scrollTop || document.body.scrollTop)) < 3.14)
                    {
                        document.getElementById("title").style.opacity = 0;
                    }
                    else
                    {
                        document.getElementById("title").style.opacity = 1;
                    }
                }
            }
        }

        function openPop(id)
        {
            switch(id)
            {
                case 1:
                    window.open("zanimanja?u=tehnicar-za-racunalstvo", "_self");
                    break;
                case 2:
                    window.open("zanimanja?u=hotelijersko-turisticki-tehnicar", "_self");
                    break;
                case 3:
                    window.open("zanimanja?u=gradevinski-tehnicar", "_self");
                    break;
                case 4:
                    window.open("zanimanja?u=bravar", "_self");
                    break;
                case 5:
                    window.open("zanimanja?u=cnc-operater", "_self");
                    break;
                case 6:
                    window.open("zanimanja?u=kuhar", "_self");
                    break;
                default:
                    window.alert("Detalji o ovom zanimanju trenutno nisu dostupni...");
                    break;
            }
        }

        function dwnldPop()
        {
            if(innerHeight <= innerWidth)
            {
                if(confirm("Želite li preuzeti ovu tablicu u MS Excel formatu?"))
                {
                    document.getElementById("dwnld").click();
                }
            }
        }

        function isEmpty(str)
        {
            return (!str || str.length === 0);
        }


        var parts = window.location.search.substr(1).split("&");
        var $_GET = {};
        for (var i = 0; i < parts.length; i++) 
        {
            var temp = parts[i].split("=");
            $_GET[decodeURIComponent(temp[0])] = decodeURIComponent(temp[1]);
        }
        if(!isEmpty($_GET["u"]))
        {
            switch($_GET["u"])
            {
                case "tehnicar-za-racunalstvo":
                    document.getElementById("container").style.display = "none";
                    document.getElementById("zanim").style.display = "block";
                    document.getElementById("zanimttl").innerHTML = "Tehničar za računalstvo";
                    document.getElementById("zanimimg").src = "Images/Zanimanja/Tehnicar-za-racunalstvo.jpg";
                    document.getElementById("dwnld").href = "Storage/Tehni%C4%8Dar%20za%20ra%C4%8Dunalstvo.xlsx";
                    break;
                case "hotelijersko-turisticki-tehnicar":
                    document.getElementById("container").style.display = "none";
                    document.getElementById("zanim").style.display = "block";
                    document.getElementById("zanimttl").innerHTML = "Hotelijersko-turistički tehničar";
                    document.getElementById("zanimimg").src = "Images/Zanimanja/Hotelijersko-turisticki-tehnicar.jpg";
                    document.getElementById("dwnld").href = "Storage/Hotelijersko-turisti%C4%8Dki%20tehni%C4%8Dar.xlsx";
                    break;
                case "gradevinski-tehnicar":
                    document.getElementById("container").style.display = "none";
                    document.getElementById("zanim").style.display = "block";
                    document.getElementById("zanimttl").innerHTML = "Građevinski tehničar";
                    document.getElementById("zanimimg").src = "Images/Zanimanja/Gradevinski-tehnicar.jpg";
                    document.getElementById("dwnld").href = "Storage/Gra%C4%91evinski%20tehni%C4%8Dar.xlsx";
                    break;
                case "bravar":
                    document.getElementById("container").style.display = "none";
                    document.getElementById("zanim").style.display = "block";
                    document.getElementById("zanimttl").innerHTML = "Bravar";
                    document.getElementById("zanimimg").src = "Images/Zanimanja/Bravar.jpg";
                    document.getElementById("dwnld").href = "Storage/Bravar.xlsx";
                    break;
                case "cnc-operater":
                    document.getElementById("container").style.display = "none";
                    document.getElementById("zanim").style.display = "block";
                    document.getElementById("zanimttl").innerHTML = "CNC-operater";
                    document.getElementById("zanimimg").src = "Images/Zanimanja/CNC-operater.jpg";
                    document.getElementById("dwnld").href = "Storage/CNC-operater.xlsx";
                    break;
                case "kuhar":
                    document.getElementById("container").style.display = "none";
                    document.getElementById("zanim").style.display = "block";
                    document.getElementById("zanimttl").innerHTML = "Kuhar";
                    document.getElementById("zanimimg").src = "Images/Zanimanja/Kuhar.jpg";
                    document.getElementById("dwnld").href = "Storage/Kuhar.xlsx";
                    break;
                default:
                    break;
            } 
        }
    </script>
</body>
</html>
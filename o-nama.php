<html lang="bs">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Službena web stranica Srednje Strukovne Škole &quot;Jajce&quot;. Ovdje možete pronaći školske obavijesti, aktivnosti, zanimanja i druge informacije...">
    <meta name="keywords" content="Srednja, strukovna, škola, Jajce, skola, &quot;Jajce&quot;, sssjajce, sssjajce.com, SSŠ, SSS, nama, info, informacije, kontakt, broj, mail, e-mail">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Srednja Strukovna Škola "Jajce" - O nama</title>
    <link rel="icon" href="Images/favicon.png">
    <link rel="stylesheet" href="CSS/o-nama.css">
</head>
<body>
    <?php include "menu.php";?>

    <div id="title">
        Srednja Strukovna Škola "JAJCE"
    </div>

    <div id="main">
        
        <div id="o_title_out"></div>
        <div id="o_title">
            <p>Informacije o školi</p>
        </div>

        <div id="container"> 
            <div id="school_history">
                <div class="line"></div>

                <div class="o_title1_w">
                    <div class="o_title_out1"></div>
                    <div class="o_title1">
                        Povijest / Historija
                    </div>
                </div>

                <div id="his_text"> 
                    Srednja strukovna škola „Jajce“ je osnovana 1961. godine pod imenom Srednja tehnička škola „Jajce“.  U proteklom periodu škola je nekoliko puta mijenjala ime, a pod današnjim djeluje od 1995. godine.<br><br>
                    U školi se obrazuju učenici za zanimanja u trogodišnjem i četverogodišnjem trajanju.  Sva nastava se odvija u jednoj smjeni u specijaliziranim učionicama, a učenici su ti koji mijenjaju učionice. Ovakva nastava omogućava nastavnicima bolju pripremu i lakšu prezentaciju nastavnog gradiva.  <br> <br>
                    Nastava se odvija u 23 učionice, kabinetu računalstva, školskim radionicama (bravarska radionica, elektro radionica i moderno opremljena kuhinja za praktičnu nastavu kuharstva) i dvorani za tjelesnu i zdravstvenu kulturu. Dio praktične nastave, osim u školskim prostorijama, izvodi se i u poduzećima i ugostiteljskim objektima. Škola ima i otvoreno igralište za košarku. <br><br>
                    U školskoj godini 2021./2022. škola broji ukupno 318 učenika. Obrazuju se za sljedeća zanimanja u trogodišnjem trajanju: keramičar, kuhar, bravar, CNC operater i konobar; kao i za zanimanja u četverogodišnjem trajanju: tehničar za računalstvo, tehničar za mehatroniku, šumarski tehničar, građevinski tehničar - visokogradnja i hotelijersko-turistički tehničar. <br><br>
                </div>

                <div class="line"></div>
                
                <div class="o_title1_w">
                    <div class="o_title_out1"></div>
                    <div class="o_title1">
                        Kontakt
                    </div>
                </div>

                <table id="land">
                    <tr>
                        <td style="width: 30%;"></td>
                        <td style="width: 30%;">Telefon</td>
                    </tr>
                    <tr>
                        <td><span>Juro Šimunović</span><br> ravnatelj</td>
                        <td>+387 30 654 043</td>
                    </tr>
                    <tr>
                        <td><span>Dragana Crnoja</span><br> pedagogica</td>
                        <td>+387 30 654 042</td>
                    </tr>
                    <tr>
                        <td><span>Smiljan Kovačević</span><br> pravnik / tajnik</td>
                        <td>+387 30 654 274</td>
                    </tr>
                    <tr>
                        <td><span>Nevenka Jakešević</span><br> administrativni djelatnik</td>
                        <td>+387 30 654 273</td>
                    </tr>
                </table>

                <table id="port">
                    <tr>
                        <td><span>Juro Šimunović</span><br> ravnatelj</td>
                        <td>
                            +387 30 654 043 <br>
                        </td>
                    </tr>
                    <tr>
                        <td><span>Dragana Crnoja</span><br> pedagogica</td>
                        <td>
                            +387 30 654 042 <br>
                        </td>
                    </tr>
                    <tr>
                        <td><span>Smiljan Kovačević</span><br> pravnik / tajnik</td>
                        <td>
                            +387 30 654 274 <br>
                        </td>
                    </tr>
                    <tr>
                        <td><span>Nevenka Jakešević</span><br> administrativni djelatnik</td>
                        <td>
                            +387 30 654 273 <br>
                        </td>
                    </tr>
                </table>
 
            </div>
        </div>
    </div>

    <?php include "footer.php";?>

    <script>
        setInterval(d, 70);
        function d()
        {
            //Ispis koef.
            //document.getElementById("ddd").innerHTML = document.getElementsByTagName("body")[0].offsetHeight / (document.documentElement.scrollTop || document.body.scrollTop);
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
    </script>
</body>
</html>
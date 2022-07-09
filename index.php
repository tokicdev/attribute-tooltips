<?php
    if($_SERVER['REMOTE_ADDR'] == "127.0.0.1" || $_SERVER['REMOTE_ADDR'] == "::1")
    {
        $conn = mysqli_connect("localhost", "root", "", "OB"); //local
    }
    else
    {
        $conn = mysqli_connect("localhost", "sssjajce_root", "xce367bh29oi4", "sssjajce_main"); //host
    }

    if(!$conn)
    {
        exit("Problem pri povezivanju na databazu");
    }
    mysqli_set_charset($conn, "utf8mb4");

    //napravi table ako ga nema
    mysqli_query($conn, "CREATE TABLE IF NOT EXISTS Obavijesti (unix INT(20) UNSIGNED UNIQUE NOT NULL, tekst VARCHAR(15000) NOT NULL, postavio VARCHAR(60), datum TIMESTAMP DEFAULT CURRENT_TIMESTAMP, slike INT(4) UNSIGNED)");
    //vrati broj obavijesti
    $count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) FROM Obavijesti"));
    $brojob = $count["COUNT(*)"];
?>

<html lang="bs">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Službena web stranica Srednje Strukovne Škole &quot;Jajce&quot;. Ovdje možete pronaći školske obavijesti, aktivnosti, zanimanja i druge informacije...">
    <meta name="keywords" content="Srednja, strukovna, škola, Jajce, skola, &quot;Jajce&quot;, sssjajce, sssjajce.com, SSŠ, SSS, obavijesti, obavijest, obavjesti, obavjest">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Srednja Strukovna Škola "Jajce"</title>
    <link rel="icon" href="Images/favicon.png">
    <link rel="stylesheet" href="CSS/index.css">
</head>
<body>
    <?php include "menu.php";?>

    <div id="title">
        Srednja Strukovna Škola "JAJCE"
    </div>

    <div id="main">
        
        <div id="news_title_out"></div>
        <div id="news_title">
            <p>Školske obavijesti</p>
        </div>

        <div id="wrap_news">
        <?php
            if($brojob <= 0)
            {
                echo("<h2 id='noob'>Trenutno nema obavijesti</h2><br>");
            }
            else
            {
                $data = mysqli_query($conn, "SELECT * FROM Obavijesti ORDER BY unix DESC"); //ucitaj data iz baze
                
                $ob = array();
                $ob[0] = array(); //napravi 2D array
                $ob[0]["cuttekst"] = 0;

                $j = $brojob;
                while($obdata = mysqli_fetch_assoc($data)) //konvertuj data iz baze u 2D array
                {
                    if($j >= 0)
                    {
                        $ob[$j]["unix"] = $obdata["unix"];
                        $ob[$j]["cuttekst"] = 0;

                        $obdata["tekst"] = strip_tags($obdata["tekst"], "<B><I><U>"); //ukloni sve HTML tagove osim ovih

                        if(strlen($obdata["tekst"]) > 327) //odrezi predug tekst
                        {
                            $ob[$j]["cuttekst"] = 1;
                            if($obdata["tekst"][327] == " ")
                            {
                                $obdata["tekst"] = substr($obdata["tekst"], 0, 327);
                            }
                            else if(ctype_alpha($obdata["tekst"][328]))
                            {
                                $obdata["tekst"] = substr($obdata["tekst"], 0, 327);
                                $find = strrpos($obdata["tekst"], " ");
                                if($find != false)
                                {
                                    $obdata["tekst"] = substr($obdata["tekst"], 0, $find);
                                }
                            }
                            else
                            {
                                $obdata["tekst"] = substr($obdata["tekst"], 0, 327);
                            }
                        }

                        $ob[$j]["tekst"] = $obdata["tekst"];

                        $ob[$j]["tekst"] = preg_replace('/(http[s]{0,1}\:\/\/\S{4,})\s{0,}/ims', '<a href="$1" target="_blank">$1</a> ', $ob[$j]["tekst"]); // izmjeni URL-ove sa <a> elementima

                        $pos0 = strpos($ob[$j]["tekst"], "\r\n"); // ostavi najvise dvije nove linije u ovom prikazu
                        if($pos0 !== false)
                        {
                            $pos = strpos($ob[$j]["tekst"], "\r\n", $pos0+1);
                            if($pos !== false)
                            {
                                $ob[$j]["tekst"] = substr($ob[$j]["tekst"], 0, $pos+1) . str_replace("\r\n", " ", substr($ob[$j]["tekst"], $pos+1));
                            }
                        }
                        else
                        {
                            $pos0 = strpos($ob[$j]["tekst"], "\n");
                            if($pos0 !== false)
                            {
                                $pos = strpos($ob[$j]["tekst"], "\n", $pos0+1);
                                if($pos !== false)
                                {
                                    $ob[$j]["tekst"] = substr($ob[$j]["tekst"], 0, $pos+1) . str_replace("\n", " ", substr($ob[$j]["tekst"], $pos+1));
                                }
                            }
                        }


                        $ob[$j]["tekst"] = nl2br($ob[$j]["tekst"]); // za ukljucenje novih linija u tekst
                        
                        
                        
                        $ob[$j]["postavio"] = $obdata["postavio"];
                        $ob[$j]["slike"] = $obdata["slike"];

                        $j--;
                    }
                }
                for($i = $brojob; $i > 0; $i--) //ispisi news elemente na sajtu
                {
                    $cutdod = "";
                    if($ob[$i]["cuttekst"])
                    {
                        $cutdod = ' <a href="obavijest?u=' . $ob[$i]["unix"] . '">...</a>';
                    }
                    if($ob[$i]["slike"] <= 0) //ako nema slika
                    {
                        echo('<div class="news" id="news-' . $i . '">
                                <p class="post_date">' . date("j. n. Y.", $ob[$i]["unix"]) . '</p>   
                                <img class="post_pic" src="Images/logo.png" alt="">
                                <img class="post_pic2" src="" alt="">
                                <p class="post_admin">postavio/la:<br><span>' . $ob[$i]["postavio"] . '</span></p>
                                <p class="post_text">' . $ob[$i]["tekst"] . $cutdod . '</p>
                                <span class="post_full_wrap"><a href="obavijest?u=' . $ob[$i]["unix"] . '" class="post_full">Pogledajte cijelu obavijest</a></span>
                            </div>');
                    }
                    else //ako ima slika
                    {
                        echo('<div class="news" id="news-' . $i . '">
                                <p class="post_date">' . date("j. n. Y.", $ob[$i]["unix"]) . '</p>
                                <img class="post_pic" src="Images/logo.png" alt="">
                                <img class="post_pic2" src="Images/pics.png" alt="">
                                <p class="post_admin">postavio/la:<br><span>' . $ob[$i]["postavio"] . '</span></p>
                                <p class="post_text">' . $ob[$i]["tekst"] . $cutdod . '</p>
                                <span class="post_full_wrap"><a href="obavijest?u=' . $ob[$i]["unix"] . '" class="post_full">Pogledajte cijelu obavijest i slike</a></span>
                            </div>');
                    }
                }

            }
            mysqli_close($conn);
        ?>
        </div>
        
    </div>
            
    <?php include "footer.php";?>

    <script>
        setInterval(d, 70);
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
    </script>
</body>
</html>
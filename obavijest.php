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

    if(empty($_GET["u"]))
    {
        http_response_code(404);
        exit("<center><h1>[404]</h1><h2>Ova stranica ne postoji!</h2><br><a href='/'>Pocetna</a></center>");
    }
    $c_unix = $_GET["u"];

    $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM Obavijesti WHERE unix=" . $c_unix . " LIMIT 1"));
    
    if(empty($data["unix"]))
    {
        http_response_code(404);
        exit("<center><h1>[404]</h1><h2>Ova stranica ne postoji!</h2><br><a href='/'>Pocetna</a></center>");
    }

    $data["tekst"] = nl2br($data["tekst"]); // za ukljucenje novih linija u tekst

    $data["tekst"] = str_ireplace("<LEFT>", "<div style='text-align: left;'>", $data["tekst"]);
    $data["tekst"] = str_ireplace("</LEFT>", "</div>", $data["tekst"]);
    $data["tekst"] = str_ireplace("<CENTER>", "<div style='text-align: center;'>", $data["tekst"]);
    $data["tekst"] = str_ireplace("</CENTER>", "</div>", $data["tekst"]);
    $data["tekst"] = str_ireplace("<RIGHT>", "<div style='text-align: right;'>", $data["tekst"]);
    $data["tekst"] = str_ireplace("</RIGHT>", "</div>", $data["tekst"]);

    $data["tekst"] = preg_replace('/(http[s]{0,1}\:\/\/\S{4,})\s{0,}/ims', '<a href="$1" target="_blank">$1</a> ', $data["tekst"]); // izmjeni URL-ove sa <a> elementima
    

    $slikenum = $data["slike"];

    mysqli_close($conn);

    error_reporting(E_ERROR | E_PARSE); //zaustavi warning dobijen kod scandir(), ako ne postoji folder od ove obavijesti ispisi img_err.png
?>

<html lang="bs">
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Srednja Strukovna Škola "Jajce" - Obavijest - <?php echo(date("j. n. Y.", $data["unix"]));?></title>
    <link rel="icon" href="Images/favicon.png">
    <link rel="stylesheet" href="CSS/obavijest.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php include "menu.php";?>

    <div id="title">
        Srednja Strukovna Škola "JAJCE"
    </div>

    <div id="main">
        <div class="sep_line"></div>

        <div class="top_mobile">
                OBAVIJEST
        </div>

        <div class="news_ext">
            <div class="top">
                OBAVIJEST
            </div>

            <div id="middle1">
                <div id="txt">
                    <?php echo($data["tekst"]);?>
                </div>
            </div>

            <div id="slike">
                <img id="slika" src="Images/logo.png" alt="Problem pri učitavanju slike...">
                <div>
                    <span onclick="imgOpen(0)">
                        <img class="prew" id="prew1" src="Images/logo.png" alt="">
                        <b>1</b>
                    </span>
                    <?php
                        if($slikenum > 1)
                        {
                            for($i = 1; $i < $slikenum; $i++)
                            {
                                echo('<span onclick="imgOpen(' . $i . ')">
                                    <img class="prew" id="prew' . ($i+1) . '" src="" alt="">
                                    <b>' . ($i+1) . '</b>
                                </span>');
                            }
                        }
                    ?>
                </div>
            </div>

            <div id="slike_m">
                <?php
                    if($slikenum > 0)
                    {
                        $slikenum_mob = $slikenum;
                        $cont = scandir("./Obavijesti/" . $data["unix"] . "/");
                        $nodir = 0;
                        if($cont === false)
                        {
                            $nodir = 1;
                        }
                        else
                        {
                            $cont = array_values(array_diff($cont, array('.', '..')));
                            if(empty($cont)) //ako nema nista u folderu
                            {
                                $nodir = 1;
                            }
                        }
                        $slika = array();
                        if($nodir || count($cont) <= 0)
                        {
                            $slika[0] = "Images/img_err.png";
                            $slika[1] = "Images/img_err.png";
                            $slika[2] = "Images/img_err.png";
                            $slika[3] = "Images/img_err.png";
                            $slika[4] = "Images/img_err.png";
                            
                        }
                        else if(count($cont) > 5)
                        {
                            $cont = array_slice($cont, 0, 5);
                            $slikenum_mob = 5;
                        }

                        if(!$nodir)
                        {
                            for($i = 0; $i < $slikenum_mob; $i++)
                            {
                                if($i >= count($cont) || empty($cont[$i]))
                                {
                                    $slika[$i] = "Images/img_err.png";
                                }
                                else
                                {
                                    $slika[$i] = "./Obavijesti/" . $data["unix"] . "/" . $cont[$i];
                                }
                            }
                        }

                        for($i = 0; $i < $slikenum_mob; $i++)
                        {
                            if($i == 0)
                            {
                                echo("<img id='slika_m" . ($i+1) . "' src='" . $slika[$i] . "' src='' alt='Problem pri učitavanju slike...'>");
                            }
                            else
                            {
                                echo("\n\t\t<img id='slika_m" . ($i+1) . "' src='" . $slika[$i] . "' src='' alt='Problem pri učitavanju slike...'>"); 
                            }
                        }
                    }
                ?>
            </div>

            <div class="bottom">
                <div class="date">
                    <?php echo(date("j. n. Y.", $data["unix"]));?>
                </div>

                <div class="postedby">
                    Postavio/la: <br>
                    <span><?php echo($data["postavio"]);?></span>
                    <div class="admincmd" onclick="acmd(1)">
                        Administator opcije
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="blurr" onclick="acmd(0)">
        <div id="ac-wrap" onclick="event.stopPropagation()">
            <div>
                Odaberite radnju:
            </div>
            <div id="ac-close" onclick="acmd(0)">&#10006;</div>
            <div>
                <span onclick="acmd(2)">
                    <i class="fa fa-pencil"></i>
                    Uredi obavijest
                </span>
                <span onclick="acmd(3)">
                    <i class="fa fa-trash"></i>
                    Izbriši obavijest
                </span>
            </div>
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

        <?php
            if($slikenum <= 0)
            {
                echo("document.getElementById('slike').style.position = 'absolute';");
                echo("\n\t\tdocument.getElementById('slike').style.display = 'none';");
            }
            else
            {
                $cont = scandir("./Obavijesti/" . $data["unix"] . "/");
                $nodir = 0;
                if($cont === false)
                {
                    $nodir = 1;
                }
                else
                {
                    $cont = array_values(array_diff($cont, array('.', '..')));
                    if(empty($cont)) //ako nema nista u folderu
                    {
                        $nodir = 1;
                    }
                }
                if($nodir || count($cont) <= 0)
                {
                    echo("slika[0] = 'Images/img_err.png';\n");
                    echo("\t\tslika[1] = 'Images/img_err.png';\n");
                    echo("\t\tslika[2] = 'Images/img_err.png';\n");
                    echo("\t\tslika[3] = 'Images/img_err.png';\n");
                    echo("\t\tslika[4] = 'Images/img_err.png';\n");
                }
                else if(count($cont) > 5)
                {
                    $cont = array_slice($cont, 0, 5);
                    $slikenum = 5;
                }

                if(!$nodir)
                {
                    echo("var slika = [];\n");
                    for($i = 0; $i < $slikenum; $i++)
                    {
                        if($i >= count($cont) || empty($cont[$i]))
                        {
                            echo("\t\tslika[" . $i . "] = 'Images/img_err.png';\n");
                        }
                        else
                        {
                            echo("\t\tslika[" . $i . "] = '" . "./Obavijesti/" . $data["unix"] . "/" . $cont[$i] . "';\n");
                        }
                    }
                }
            }
        ?>

        function imgOpen(id)
        {
            if(id < 0 || id > 5) return;
            document.getElementById("slika").src = slika[id];
            for(let i = 0; i < <?php echo($slikenum);?>; i++)
            {
                if(i != id)
                {
                    document.querySelector("#slike div span:nth-child(" + (i+1) + ")").style.border = "1px solid black";
                }
            }
            document.querySelector("#slike div span:nth-child(" + (id+1) + ")").style.border = "1px solid red";
        }
        function acmd(action)
        {
            if(action == 1)
            {
                document.getElementsByTagName("body")[0].scroll = "no";
                document.getElementsByTagName("body")[0].style.overflow = "hidden";
                document.getElementById("blurr").style.display = "flex";
            }
            else if(action == 2)
            {
                window.open("login?rdr=<?php echo($data["unix"]);?>&rdrtype=edit", "_self");
            }
            else if(action == 3)
            {
                window.open("login?rdr=<?php echo($data["unix"]);?>&rdrtype=delete", "_self");
            }
            else if(!action)
            {
                document.getElementsByTagName("body")[0].scroll = "yes";
                document.getElementsByTagName("body")[0].style.overflow = "visible";
                document.getElementById("blurr").style.display = "none";
            }
        }

        <?php if($slikenum > 0) echo('document.getElementById("slika").src = slika[0];');?>
        document.querySelector("#slike div span:nth-child(1)").style.border = "1px solid red";
        for(let i = 0; i < <?php echo($slikenum);?>; i++)
        {
            document.getElementById("prew" + (i+1)).src = slika[i];
        }
    </script>
</body>
</html>
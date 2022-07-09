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

    //napravi tableove ako ih nema
    mysqli_query($conn, "CREATE TABLE IF NOT EXISTS Obavijesti (unix INT(20) UNSIGNED UNIQUE NOT NULL, tekst VARCHAR(15000) NOT NULL, postavio VARCHAR(60), datum TIMESTAMP DEFAULT CURRENT_TIMESTAMP, slike INT(4) UNSIGNED)");
    mysqli_query($conn, "CREATE TABLE IF NOT EXISTS Nalozi (user VARCHAR(20) UNIQUE NOT NULL, pw VARCHAR(255) NOT NULL, datum TIMESTAMP DEFAULT CURRENT_TIMESTAMP)");
    mysqli_query($conn, "CREATE TABLE IF NOT EXISTS IPLog (IP VARCHAR(64) UNIQUE NOT NULL, failed INT(10), unix INT(20) UNSIGNED NOT NULL)");
    
    //////////////////////////////////////////////////////////////////////////
    $date = new DateTime(null, new DateTimeZone('Europe/Amsterdam'));
    $unixx = $date->getTimestamp() + $date->getOffset();

    $ip = mysqli_fetch_assoc(mysqli_query($conn, "SELECT IP FROM IPLog WHERE IP='" . $_SERVER['REMOTE_ADDR'] . "' LIMIT 1"));
    $pok = mysqli_fetch_assoc(mysqli_query($conn, "SELECT failed FROM IPLog WHERE IP='" . $_SERVER['REMOTE_ADDR'] . "' LIMIT 1"));
    if(!empty($ip["IP"]))
    {
        if(!empty($pok["failed"]))
        {
            if($pok["failed"] >= 1)
            {
                $un = mysqli_fetch_assoc(mysqli_query($conn, "SELECT unix FROM IPLog WHERE IP='" . $_SERVER['REMOTE_ADDR'] . "' LIMIT 1"));
                if(!empty($un["unix"]))
                {
                    if($unixx >= ($un["unix"] + 600)) // + 10 minuta
                    {
                        mysqli_query($conn, "DELETE FROM IPLog WHERE IP='" . $_SERVER['REMOTE_ADDR'] . "'");
                    }
                    else if($pok["failed"] >= 3)
                    {
                        exit("<center><b><h1>Previše pokušaja, pokušajte ponovo nakon 10 minuta...</h1><br><a href='login'>Nazad</a></b></center>");
                    }
                }
                else
                {
                    exit("<center><b><h1>Previše pokušaja, pokušajte ponovo nakon 10 minuta...</h1><br><a href='login'>Nazad</a></b></center>");
                }
            }
        }
    }
    //////////////////////////////////////////////////////////////////////////

    if(empty($_POST["username"]) || empty($_POST["password"]))
    {
        if(empty($ip["IP"]))
        {
            mysqli_query($conn, "INSERT INTO IPLog (IP, failed, unix) VALUES ('" . $_SERVER['REMOTE_ADDR'] . "', 1, " . $unixx . ")");
            exit("<center><b><h1>Pristup odbijen!</h1><br><a href='login'>Nazad</a></b></center>");
        }
        else if(!empty($pok["failed"]) && $pok["failed"] > 0 && $pok["failed"] < 3)
        {
            $newp = $pok["failed"] + 1;
            mysqli_query($conn, "UPDATE IPLog SET failed=" . $newp . ", unix=" . $unixx . " WHERE IP='" . $_SERVER['REMOTE_ADDR'] . "'");
            exit("<center><b><h1>Pristup odbijen!</h1><br><a href='login'>Nazad</a></b></center>");
        }
        else
        {
            exit("<center><b><h1>Pristup odbijen!</h1><br><a href='login'>Nazad</a></b></center>"); 
        }
    }
    else
    {
        $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT pw FROM Nalozi WHERE user='" . $_POST["username"] . "' LIMIT 1"));

        if(empty($data["pw"]))
        {
            if(empty($ip["IP"]))
            {
                mysqli_query($conn, "INSERT INTO IPLog (IP, failed, unix) VALUES ('" . $_SERVER['REMOTE_ADDR'] . "', 1, " . $unixx . ")");
                exit("<center><b><h1>Pristup odbijen!</h1><br><a href='login'>Nazad</a></b></center>");
            }
            else if(!empty($pok["failed"]) && $pok["failed"] > 0 && $pok["failed"] < 3)
            {
                $newp = $pok["failed"] + 1;
                mysqli_query($conn, "UPDATE IPLog SET failed=" . $newp . ", unix=" . $unixx . " WHERE IP='" . $_SERVER['REMOTE_ADDR'] . "'");
                exit("<center><b><h1>Pristup odbijen!</h1><br><a href='login'>Nazad</a></b></center>");
            }
            else
            {
                exit("<center><b><h1>Pristup odbijen!</h1><br><a href='login'>Nazad</a></b></center>"); 
            }
        }
        else if(!password_verify($_POST["password"], $data["pw"]))
        {
            if(empty($ip["IP"]))
            {
                mysqli_query($conn, "INSERT INTO IPLog (IP, failed, unix) VALUES ('" . $_SERVER['REMOTE_ADDR'] . "', 1, " . $unixx . ")");
                exit("<center><b><h1>Pristup odbijen!</h1><br><a href='login'>Nazad</a></b></center>");
            }
            else if(!empty($pok["failed"]) && $pok["failed"] > 0 && $pok["failed"] < 3)
            {
                $newp = $pok["failed"] + 1;
                mysqli_query($conn, "UPDATE IPLog SET failed=" . $newp . ", unix=" . $unixx . " WHERE IP='" . $_SERVER['REMOTE_ADDR'] . "'");
                exit("<center><b><h1>Pristup odbijen!</h1><br><a href='login'>Nazad</a></b></center>");
            }
            else
            {
                exit("<center><b><h1>Pristup odbijen!</h1><br><a href='login'>Nazad</a></b></center>"); 
            }
        }
    }

    mysqli_query($conn, "DELETE FROM IPLog WHERE IP='" . $_SERVER['REMOTE_ADDR'] . "'");

    mysqli_close($conn);
?>

<html lang="bs">
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Srednja Strukovna Škola "Jajce"</title>
    <link rel="icon" href="Images/favicon.png">
    <link rel="stylesheet" href="CSS/admin.css">
</head>
<body>
    <?php include "menu.php";?>

    <div id="whole">

        <div id="nav">
            <div><span onclick="showG(1)">Dodaj novu obavijest</span></div><br>
            <div><span onclick="showG(2)">Uredi postojeću obavijest</span></div><br>
            <div><span onclick="showG(3)">Izbriši obavijest</span></div><br>
            <div><span onclick="showG(4)">Promjeni ime / lozinku</span></div>
        </div>

        <div id="back" onclick="showG(0)">&larr;</div>

        <div id="add">
            <div class="title">
                - Nova obavijest -
            </div>
            <form id="obformid" name="obform" method="post" action="objava" enctype="multipart/form-data">
                    
                <div id="tekst">
                    <label form="obform">Unesite tekst obavijesti</label><br>
                    <textarea id="tekst_a" name="tekst" cols="50" wrap="hard" placeholder="" formid="obformid" required></textarea>
                    <span id="editc">
                        <span class="e_sec">
                            <span class="j" id="e_b" onclick="editc(0)">B</span>
                            <span class="j" id="e_i" onclick="editc(1)">I</span>
                            <span class="j" id="e_u" onclick="editc(2)">U</span>
                        </span>
                        <span class="e_sec">
                            <span class="j" onclick="editc(3)"><img src="Images/align-left.png" alt=""></span>
                            <span class="j" onclick="editc(4)"><img src="Images/align-center.png" alt=""></span>
                            <span class="j" onclick="editc(5)"><img src="Images/align-right.png" alt=""></span>
                        </span>
                    </span>
                </div>

                <div id="slika">
                    <label form="obform">Dodavanje slika (max. 5)</label><br>
                    <input name="slika[]" type="file" accept=".png,.jpg,.jpeg,.gif" multiple>
                </div>

                <div id="submit" onclick="submit()">
                    <span>Objavi</span>
                </div>

                <input class="check" type="text" name="usercheck" value="<?php echo($_POST["username"]);?>">
                <input class="check" type="text" name="pwcheck" value="<?php echo($_POST["password"]);?>">

            </form>
        </div>

        <div id="edit">
            <div class="title">
                - Uređivanje obavijesti -
            </div>

            <div class="del_tekst">
                <div>
                    Da biste uredili obavijest na <a href="/">početnoj stranici</a> pronađite željenu obavijest te onda kliknite na "Pogledajte cijelu obavijest". <br> <br>
                    Nakon toga na dnu obavijesti kliknite na "ADMINISTRATOR OPCIJE", pa odaberite "Uredi obavijest".
                </div>
                <a href="Images/upute-1.png" target="_blank"><img src="Images/upute-1.png" alt=""></a>
                <a href="Images/upute-2.png" target="_blank"><img src="Images/upute-2.png" alt="" class="del_imgse"></a>
            </div>
        </div>

        <div id="delete">
            <div class="title">
                - Brisanje obavijesti -
            </div>

            <div class="del_tekst">
                <div>
                    Da biste izbrisali obavijest na <a href="/">početnoj stranici</a> pronađite željenu obavijest te onda kliknite na "Pogledajte cijelu obavijest". <br> <br>
                    Nakon toga na dnu obavijesti kliknite na "ADMINISTRATOR OPCIJE", pa odaberite "Izbriši obavijest".
                </div>
                <a href="Images/upute-1.png" target="_blank"><img src="Images/upute-1.png" alt=""></a>
                <a href="Images/upute-2.png" target="_blank"><img src="Images/upute-2.png" alt="" class="del_imgse"></a>
            </div>
        </div>

        <div id="cng">
            <form action="admin-c" method="post" id="cformid">
                <div id="cngdiv">
                    <div>
                        <span>Novo ime naloga:</span>
                        <span>Nova lozinka naloga:</span>
                    </div>
                    <div>
                        <input type="text" name="ime" id="inp1" maxlength="20" value="">
                        <input type="password" name="lozinka" id="inp2" maxlength="20" value="">
                    </div>
                </div>

                <br>

                <div id="podnesi" onclick="submitC()">
                    Podnesi
                </div>

                <input class="check" type="text" name="usercheck" value="<?php echo($_POST["username"]);?>">
                <input class="check" type="text" name="pwcheck" value="<?php echo($_POST["password"]);?>">
            </form>

            * Ostavite prazno polje koje ne želite mijenjati
        </div>

    </div>

    <script>
        function showG(id)
        {
            switch(id)
            {
                case 0:
                    document.getElementById("back").style.display = "none";
                    document.getElementById("add").style.display = "none";
                    document.getElementById("edit").style.display = "none";
                    document.getElementById("delete").style.display = "none";
                    document.getElementById("cng").style.display = "none";
                    document.getElementById("nav").style.display = "block";
                    break;
                case 1:
                    document.getElementById("nav").style.display = "none";
                    document.getElementById("add").style.display = "block";
                    document.getElementById("back").style.display = "block";
                    break;
                case 2:
                    document.getElementById("nav").style.display = "none";
                    document.getElementById("edit").style.display = "block";
                    document.getElementById("back").style.display = "block";
                    break;
                case 3:
                    document.getElementById("nav").style.display = "none";
                    document.getElementById("delete").style.display = "block";
                    document.getElementById("back").style.display = "block";
                    break;
                case 4:
                    document.getElementById("nav").style.display = "none";
                    document.getElementById("cng").style.display = "block";
                    document.getElementById("back").style.display = "block";
                    toutinp();
                    break;
                default:
                    break;
            }
        }

        function submit()
        {
            if(isEmpty(document.getElementById("tekst_a").value))
            {
                alert("Tekst obavijesti je prazan!");
            }
            else if(document.forms["obform"]["slika[]"].files.length > 5)
            {
                alert("Ne možete odabrati više od 5 slika!");
            }
            else if(document.getElementById("tekst_a").value.length + ((document.getElementById("tekst_a").value.match(/\n/g) || []).length) > 15000)
            {
                alert("Tekst ne može imati više od 15000 karaktera!");
            }
            else
            {
                document.getElementById("obformid").submit();
            }
        }

        function editc(type)
        {   
            if(type > 5 || type < 0) return;

            var tog = 0;
            
            if(document.getElementById("tekst_a").selectionStart == document.getElementById("tekst_a").selectionEnd) tog = 1;

            var sStart = document.getElementById("tekst_a").selectionStart;
            var sEnd = document.getElementById("tekst_a").selectionEnd;

            var inst = "";
            var inste = "";

            switch(type)
            {
                case 0:
                    if(tog)
                    {
                        inst = "<B></B>";
                    }
                    else
                    {
                        inst = "<B>";
                        inste = "</B>";
                    }
                    break;
                case 1:
                    if(tog)
                    {
                        inst = "<I></I>";
                    }
                    else
                    {
                        inst = "<I>";
                        inste = "</I>";
                    }
                    break;
                case 2:
                    if(tog)
                    {
                        inst = "<U></U>";
                    }
                    else
                    {
                        inst = "<U>";
                        inste = "</U>";
                    }
                    break;
                case 3:
                    if(tog)
                    {
                        inst = "<LEFT></LEFT>";
                    }
                    else
                    {
                        inst = "<LEFT>";
                        inste = "</LEFT>";
                    }
                    break;
                case 4:
                    if(tog)
                    {
                        inst = "<CENTER></CENTER>";
                    }
                    else
                    {
                        inst = "<CENTER>";
                        inste = "</CENTER>";
                    }
                    break;
                case 5:
                    if(tog)
                    {
                        inst = "<RIGHT></RIGHT>";
                    }
                    else
                    {
                        inst = "<RIGHT>";
                        inste = "</RIGHT>";
                    }
                    break;
                default:
                    break;
            }

            sEnd = sEnd + inst.length;

            if(tog)
            {
                document.getElementById("tekst_a").value = document.getElementById("tekst_a").value.splice(sStart, 0, inst);
            }
            else
            {
                document.getElementById("tekst_a").value = document.getElementById("tekst_a").value.splice(sStart, 0, inst);
                document.getElementById("tekst_a").value = document.getElementById("tekst_a").value.splice(sEnd, 0, inste);
            }

            document.getElementById("tekst_a").selectionEnd = sEnd + inste.length;
            document.getElementById("tekst_a").blur();
            document.getElementById("tekst_a").focus();
            
        }

        document.addEventListener("keyup", function(e) {
            if(e.key === "Escape")
            {
                if(document.getElementById("nav").style.display === "none")
                {
                    showG(0);
                }
            }
        });

        function toutinp()
        {
            setTimeout(() => {
                document.getElementById("inp1").value = "<?php echo($_POST["username"]);?>";
                document.getElementById("inp2").value = "";
            }, 200);
        }

        function submitC()
        {
            if(isEmpty(document.getElementById("inp1").value) && isEmpty(document.getElementById("inp2").value))
            {
                return 0;
            }
            if(isEmpty(document.getElementById("inp2").value) && document.getElementById("inp1").value === "<?php echo($_POST["username"]);?>")
            {
                return 0;
            }

            if(!isEmpty(document.getElementById("inp1").value))
            {
                if(document.getElementById("inp1").value.length > 20 || document.getElementById("inp1").value.length < 3)
                {
                    alert("Ime mora imati najmanje 3 karaktera i najviše 20!");
                    return 0;
                }

                for(let i = 0; i < document.getElementById("inp1").value.length; i++)
                {
                    code = document.getElementById("inp1").value.charCodeAt(i);
                    if(!(code > 47 && code < 58) && !(code > 64 && code < 91) && !(code > 96 && code < 123) && code != 32 && code != 268 && code != 269 && code != 263 && code != 262 && code != 382 && code != 381 && code != 273 && code != 272 && code != 353 && code != 352)
                    {
                        alert("Ime može sadržavati samo mala i velika slova, brojeve i razmake.")
                        return 0;
                    }
                }
            }

            if(!isEmpty(document.getElementById("inp2").value))
            {
                if(document.getElementById("inp2").value.length > 20 || document.getElementById("inp2").value.length < 8)
                {
                    alert("Lozinka mora imati najmanje 8 karaktera i najviše 20!");
                    return 0;
                }

                for(let i = 0; i < document.getElementById("inp2").value.length; i++)
                {
                    code = document.getElementById("inp2").value.charCodeAt(i);
                    if(!(code > 47 && code < 58) && !(code > 64 && code < 91) && !(code > 96 && code < 123))
                    {
                        alert("Ime može sadržavati samo mala slova, velika slova i brojeve.")
                        return 0;
                    }
                }
            }

            if(document.getElementById("inp1").value === "<?php echo($_POST["username"]);?>")
            {
                document.getElementById("inp1").value = "";
            }

            document.getElementById("cformid").submit();
        }


        String.prototype.splice = function(idx, rem, str) 
        {
            return this.slice(0, idx) + str + this.slice(idx + Math.abs(rem));
        };

        function isEmpty(str)
        {
            return (!str || str.length === 0);
        }
    </script>
</body>
</html>
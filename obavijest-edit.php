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
    mysqli_query($conn, "CREATE TABLE IF NOT EXISTS Obavijesti (unix INT(20) UNSIGNED UNIQUE NOT NULL, tekst VARCHAR(1500) NOT NULL, postavio VARCHAR(60), datum TIMESTAMP DEFAULT CURRENT_TIMESTAMP, slike INT(4) UNSIGNED)");
    mysqli_query($conn, "CREATE TABLE IF NOT EXISTS Nalozi (user VARCHAR(20) UNIQUE NOT NULL, pw VARCHAR(255) NOT NULL, datum TIMESTAMP DEFAULT CURRENT_TIMESTAMP)");
    mysqli_query($conn, "CREATE TABLE IF NOT EXISTS IPLog (IP VARCHAR(64) UNIQUE NOT NULL, failed INT(10), unix INT(20) UNSIGNED NOT NULL)");
    
    if(empty($_GET["u"]))
    {
        exit("<center><b><h1>Pristup odbijen!</h1><br><a href='/'>Nazad</a></b></center>");
    }
    
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
                        exit("<center><b><h1>Previše pokušaja, pokušajte ponovo nakon 10 minuta...</h1><br><a href='login?rdr=" . $_REQUEST["u"] . "&rdrtype=edit'>Nazad</a></b></center>");
                    }
                }
                else
                {
                    exit("<center><b><h1>Previše pokušaja, pokušajte ponovo nakon 10 minuta...</h1><br><a href='login?rdr=" . $_REQUEST["u"] . "&rdrtype=edit'>Nazad</a></b></center>");
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
            exit("<center><b><h1>Pristup odbijen!</h1><br><a href='login?rdr=" . $_REQUEST["u"] . "&rdrtype=edit'>Nazad</a></b></center>");
        }
        else if(!empty($pok["failed"]) && $pok["failed"] > 0 && $pok["failed"] < 3)
        {
            $newp = $pok["failed"] + 1;
            mysqli_query($conn, "UPDATE IPLog SET failed=" . $newp . ", unix=" . $unixx . " WHERE IP='" . $_SERVER['REMOTE_ADDR'] . "'");
            exit("<center><b><h1>Pristup odbijen!</h1><br><a href='login?rdr=" . $_REQUEST["u"] . "&rdrtype=edit'>Nazad</a></b></center>");
        }
        else
        {
            exit("<center><b><h1>Pristup odbijen!</h1><br><a href='login?rdr=" . $_REQUEST["u"] . "&rdrtype=edit'>Nazad</a></b></center>");
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
                exit("<center><b><h1>Pristup odbijen!</h1><br><a href='login?rdr=" . $_REQUEST["u"] . "&rdrtype=edit'>Nazad</a></b></center>");
            }
            else if(!empty($pok["failed"]) && $pok["failed"] > 0 && $pok["failed"] < 3)
            {
                $newp = $pok["failed"] + 1;
                mysqli_query($conn, "UPDATE IPLog SET failed=" . $newp . ", unix=" . $unixx . " WHERE IP='" . $_SERVER['REMOTE_ADDR'] . "'");
                exit("<center><b><h1>Pristup odbijen!</h1><br><a href='login?rdr=" . $_REQUEST["u"] . "&rdrtype=edit'>Nazad</a></b></center>");
            }
            else
            {
                exit("<center><b><h1>Pristup odbijen!</h1><br><a href='login?rdr=" . $_REQUEST["u"] . "&rdrtype=edit'>Nazad</a></b></center>");
            }
        }
        else if(!password_verify($_POST["password"], $data["pw"]))
        {
            if(empty($ip["IP"]))
            {
                mysqli_query($conn, "INSERT INTO IPLog (IP, failed, unix) VALUES ('" . $_SERVER['REMOTE_ADDR'] . "', 1, " . $unixx . ")");
                exit("<center><b><h1>Pristup odbijen!</h1><br><a href='login?rdr=" . $_REQUEST["u"] . "&rdrtype=edit'>Nazad</a></b></center>");
            }
            else if(!empty($pok["failed"]) && $pok["failed"] > 0 && $pok["failed"] < 3)
            {
                $newp = $pok["failed"] + 1;
                mysqli_query($conn, "UPDATE IPLog SET failed=" . $newp . ", unix=" . $unixx . " WHERE IP='" . $_SERVER['REMOTE_ADDR'] . "'");
                exit("<center><b><h1>Pristup odbijen!</h1><br><a href='login?rdr=" . $_REQUEST["u"] . "&rdrtype=edit'>Nazad</a></b></center>");
            }
            else
            {
                exit("<center><b><h1>Pristup odbijen!</h1><br><a href='login?rdr=" . $_REQUEST["u"] . "&rdrtype=edit'>Nazad</a></b></center>");
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
    <link rel="stylesheet" href="CSS/edit.css">
</head>
<body>
    <?php include "menu.php";?>

    <div id="whole">
        <div id="ww">
            <div id="title">
                - Uređivanje obavijesti -
            </div>

            <form id="obformid" name="obform" method="post" action="edit">
                    
                <div id="tekst">
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

                        $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT tekst FROM Obavijesti WHERE unix=" . $_GET["u"] . " LIMIT 1"));
                        if(empty($data["tekst"]))
                        {
                            exit("<center><b><h1>Pristup odbijen!</h1><br><a href='login?rdr=" . $_REQUEST["u"] . "&rdrtype=edit'>Nazad</a></b></center>");
                        }
                
                        mysqli_close($conn);
                    ?>
                    <textarea id="tekst_a" name="tekst" cols="50" wrap="hard" placeholder="" formid="obformid" required><?php echo($data["tekst"]);?></textarea>
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

                <div id="dat">
                    Datum postavljanja obavijesti: <?php echo(date("j. n. Y.", $_GET["u"]));?>
                </div>

                <div id="submit" onclick="submit()">
                    <span>Podnesi</span>
                </div>

                <input class="check" type="text" name="unix" value="<?php echo($_GET["u"]);?>">
                <input class="check" type="text" name="usercheck" value="<?php echo($_POST["username"]);?>">
                <input class="check" type="text" name="pwcheck" value="<?php echo($_POST["password"]);?>">

            </form>
        </div>
    </div>

    <script>
        function submit()
        {
            if(isEmpty(document.getElementById("tekst_a").value))
            {
                alert("Tekst obavijesti je prazan!");
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
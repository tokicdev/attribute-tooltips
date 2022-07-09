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
                        exit("<center><b><h1>Previše pokušaja, pokušajte ponovo nakon 10 minuta...</h1><br><a href='login?rdr=" . $_REQUEST["u"] . "&rdrtype=delete'>Nazad</a></b></center>");
                    }
                }
                else
                {
                    exit("<center><b><h1>Previše pokušaja, pokušajte ponovo nakon 10 minuta...</h1><br><a href='login?rdr=" . $_REQUEST["u"] . "&rdrtype=delete'>Nazad</a></b></center>");
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
            exit("<center><b><h1>Pristup odbijen!</h1><br><a href='login?rdr=" . $_REQUEST["u"] . "&rdrtype=delete'>Nazad</a></b></center>");
        }
        else if(!empty($pok["failed"]) && $pok["failed"] > 0 && $pok["failed"] < 3)
        {
            $newp = $pok["failed"] + 1;
            mysqli_query($conn, "UPDATE IPLog SET failed=" . $newp . ", unix=" . $unixx . " WHERE IP='" . $_SERVER['REMOTE_ADDR'] . "'");
            exit("<center><b><h1>Pristup odbijen!</h1><br><a href='login?rdr=" . $_REQUEST["u"] . "&rdrtype=delete'>Nazad</a></b></center>");
        }
        else
        {
            exit("<center><b><h1>Pristup odbijen!</h1><br><a href='login?rdr=" . $_REQUEST["u"] . "&rdrtype=delete'>Nazad</a></b></center>");
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
                exit("<center><b><h1>Pristup odbijen!</h1><br><a href='login?rdr=" . $_REQUEST["u"] . "&rdrtype=delete'>Nazad</a></b></center>");
            }
            else if(!empty($pok["failed"]) && $pok["failed"] > 0 && $pok["failed"] < 3)
            {
                $newp = $pok["failed"] + 1;
                mysqli_query($conn, "UPDATE IPLog SET failed=" . $newp . ", unix=" . $unixx . " WHERE IP='" . $_SERVER['REMOTE_ADDR'] . "'");
                exit("<center><b><h1>Pristup odbijen!</h1><br><a href='login?rdr=" . $_REQUEST["u"] . "&rdrtype=delete'>Nazad</a></b></center>");
            }
            else
            {
                exit("<center><b><h1>Pristup odbijen!</h1><br><a href='login?rdr=" . $_REQUEST["u"] . "&rdrtype=delete'>Nazad</a></b></center>");
            }
        }
        else if(!password_verify($_POST["password"], $data["pw"]))
        {
            if(empty($ip["IP"]))
            {
                mysqli_query($conn, "INSERT INTO IPLog (IP, failed, unix) VALUES ('" . $_SERVER['REMOTE_ADDR'] . "', 1, " . $unixx . ")");
                exit("<center><b><h1>Pristup odbijen!</h1><br><a href='login?rdr=" . $_REQUEST["u"] . "&rdrtype=delete'>Nazad</a></b></center>");
            }
            else if(!empty($pok["failed"]) && $pok["failed"] > 0 && $pok["failed"] < 3)
            {
                $newp = $pok["failed"] + 1;
                mysqli_query($conn, "UPDATE IPLog SET failed=" . $newp . ", unix=" . $unixx . " WHERE IP='" . $_SERVER['REMOTE_ADDR'] . "'");
                exit("<center><b><h1>Pristup odbijen!</h1><br><a href='login?rdr=" . $_REQUEST["u"] . "&rdrtype=delete'>Nazad</a></b></center>");
            }
            else
            {
                exit("<center><b><h1>Pristup odbijen!</h1><br><a href='login?rdr=" . $_REQUEST["u"] . "&rdrtype=delete'>Nazad</a></b></center>");
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
</head>
<body>
    <h1 style="text-align: center; margin-top: 20%;">Brisanje obavijesti ID: <?php echo($_GET["u"]);?></h1>
    <form id="formid" method="post" style="display: none;">
        <input type="text" name="username" value="<?php echo($_POST["username"]);?>">
        <input type="password" name="password" value="<?php echo($_POST["password"]);?>">
        <input type="text" name="u" value="<?php echo($_REQUEST["u"]);?>">
        <input type="text" id="conf" name="conf" value="<?php if(empty($_POST["conf"]) || $_POST["conf"] != "yes") { echo("no"); } else { echo("yes"); }?>">
    </form>
    <script>
        setTimeout(delay, 500);
        function delay()
        {
            <?php
                if(empty($_POST["conf"]) || $_POST["conf"] != "yes")
                {
                    echo("if(confirm('Jeste li sigurni da želite obrisati ovu obavijest?') == true)\n");
                    echo("\t\t\t\t{\n");
                    echo("\t\t\t\t\tdocument.getElementById('conf').value = 'yes';\n");
                    echo("\t\t\t\t\tdocument.getElementById('formid').submit();\n");
                    echo("\t\t\t\t}\n");
                    echo("\t\t\telse\n");
                    echo("\t\t\t\twindow.open('obavijest?u=" . $_REQUEST["u"] . "', '_self');\n");
                }
                else
                {
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

                    mysqli_query($conn, "DELETE FROM Obavijesti WHERE unix=" . $_POST["u"] . " LIMIT 1");
                    mysqli_close($conn);

                    if(is_dir("./Obavijesti/" . $_POST["u"]))
                    {
                        rmdir("./Obavijesti/" . $_POST["u"]);
                    }

                    echo("window.open('/', '_self');\n");
                }
            ?>
        }
    </script>
</body>
</html>
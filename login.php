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

    mysqli_close($conn);
?>

<html lang="bs">
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Srednja Strukovna Škola "Jajce"</title>
    <link rel="icon" href="Images/favicon.png">
    <link rel="stylesheet" href="CSS/login.css">
</head>
<body>
    <?php include "menu.php";?>

    <div id="content">
        <div id="loginbody">
            
            <div id="lgned">Prijava administratora</div>

            <?php
                $rdr = "admin";
                if(!empty($_GET["rdr"]) && !empty($_GET["rdrtype"]))
                {
                    if(is_numeric($_GET["rdr"]) && $_GET["rdrtype"] == "edit")
                    {
                        $rdr = "obavijest-edit?u=" . $_GET["rdr"];
                    }
                    else if(is_numeric($_GET["rdr"]) && $_GET["rdrtype"] == "delete")
                    {
                        $rdr = "obavijest-delete?u=" . $_GET["rdr"];
                    }
                }
            ?>

            <form id="loginformid" name="loginform" method="post" action="<?php echo($rdr);?>">
                <div id="username">
                    <input type="text" placeholder="Unesite ime i prezime" name="username" required>
                </div>

                <div id="password">
                    <input type="password" placeholder="Unesite lozinku" name="password" required>
                </div>
            
                <div id="login-lower">
                    <span id="logbtn" onclick="submitLogin()">Prijava</span>
                </div>
            </form>
        </div>
    </div>

    <script>
        function submitLogin()
        {
            document.getElementById("loginformid").submit();
        }
    </script>
</body>
</html>
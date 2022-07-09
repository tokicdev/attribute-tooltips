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

    if(empty($_POST["usercheck"]) || empty($_POST["pwcheck"]))
    {
        exit("<center><b><h1>Pristup odbijen!</h1><br><a href='login?rdr=" . $_REQUEST["unix"] . "&rdrtype=edit'>Nazad</a></b></center>");
    }
    else if(empty($_POST["unix"]))
    {
        exit("<center><b><h1>Pristup odbijen!</h1><br><a href='login?rdr=" . $_REQUEST["unix"] . "&rdrtype=edit'>Nazad</a></b></center>");
    }
    else if(empty($_POST["tekst"]))
    {
        exit("<center><b><h1>Tekst obavijesti je prazan!</h1><br><a href='login?rdr=" . $_REQUEST["unix"] . "&rdrtype=edit'>Nazad</a></b></center>");
    }
    else if(strlen($_POST["tekst"]) > 15000)
    {
        exit("<center><b><h1>Tekst obavijesti ne može imati preko 15000 karaktera!</h1><br><a href='login?rdr=" . $_REQUEST["unix"] . "&rdrtype=edit'>Nazad</a></b></center>");
    }
    else //login check
    {
        $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT pw FROM Nalozi WHERE user='" . $_POST["usercheck"] . "' LIMIT 1"));

        if(empty($data["pw"]))
        {
            exit("<center><b><h1>Pristup odbijen!</h1><br><a href='login?rdr=" . $_REQUEST["unix"] . "&rdrtype=edit'>Nazad</a></b></center>");
        }
        else if(!password_verify($_POST["pwcheck"], $data["pw"]))
        {
            exit("<center><b><h1>Pristup odbijen!</h1><br><a href='login?rdr=" . $_REQUEST["unix"] . "&rdrtype=edit'>Nazad</a></b></center>");
        }
    }

    //uredi obavijest

    $tekst_s = strip_tags($_POST["tekst"], "<B><I><U><LEFT><CENTER><RIGHT>"); //ukloni sve HTML tagove osim ovih

    $tekst_s = preg_replace("/<([a-z][a-z0-9]*)[^>]*?(\/?)>/si",'<$1$2>', $tekst_s); //ukloni sve HTMl atribute preko regex-a

    $tekst_s = mysqli_real_escape_string($conn, $tekst_s); //escape-uj unsafe charactere (navodnici, \, itd...)

    mysqli_query($conn, "UPDATE Obavijesti SET tekst='" . $tekst_s . "' WHERE unix=" . $_POST["unix"]);

    mysqli_close($conn);

    exit("<center><b><h1>Uspješno uređena obavijest!</h1><br><a href='/'>Nazad</a></b></center>");
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
    

</body>
</html>
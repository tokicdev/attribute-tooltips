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
        exit("<center><b><h1>Pristup odbijen!</h1><br><a href='login'>Nazad</a></b></center>");
    }
    else //login check
    {
        $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT pw FROM Nalozi WHERE user='" . $_POST["usercheck"] . "' LIMIT 1"));

        if(empty($data["pw"]))
        {
            exit("<center><b><h1>Pristup odbijen!</h1><br><a href='login'>Nazad</a></b></center>");
        }
        else if(!password_verify($_POST["pwcheck"], $data["pw"]))
        {
            exit("<center><b><h1>Pristup odbijen!</h1><br><a href='login'>Nazad</a></b></center>");
        }
    }

    $iime = $_POST["usercheck"];

    if(!empty($_POST["ime"]))
    {
        if(strlen($_POST["ime"]) > 20 || strlen($_POST["ime"]) < 3)
        {
            exit("<center><b><h1>Pristup odbijen!</h1><br><a href='login'>Nazad</a></b></center>");
        }

        for($i = 0; $i < strlen($_POST["ime"]); $i++)
        {
            if(ctype_alnum($_POST["ime"][$i]) || $_POST["ime"][$i] == " " || $_POST["ime"][$i] == "Č" || $_POST["ime"][$i] == "č" || $_POST["ime"][$i] == "Ć" || $_POST["ime"][$i] == "ć" || $_POST["ime"][$i] == "Ž" || $_POST["ime"][$i] == "ž" || $_POST["ime"][$i] == "Đ" || $_POST["ime"][$i] == "đ" || $_POST["ime"][$i] == "Š" || $_POST["ime"][$i] == "š")
            {
                continue;
            }
            else
            {
                exit("<center><b><h1>Pristup odbijen!</h1><br><a href='login'>Nazad</a></b></center>");
                break;
            }
        }

        mysqli_query($conn, "UPDATE Nalozi SET user='" . $_POST["ime"] . "' WHERE user='" . $_POST["usercheck"] . "'"); 
        $iime = $_POST["ime"];
    }

    if(!empty($_POST["lozinka"]))
    {
        if(strlen($_POST["lozinka"]) > 20 || strlen($_POST["lozinka"]) < 8)
        {
            exit("<center><b><h1>Pristup odbijen!</h1><br><a href='login'>Nazad</a></b></center>");
        }

        if(!ctype_alnum($_POST["lozinka"]))
        {
            exit("<center><b><h1>Pristup odbijen!</h1><br><a href='login'>Nazad</a></b></center>");
        }
        else
        {
            $pwen = password_hash($_POST["lozinka"], PASSWORD_DEFAULT);
            mysqli_query($conn, "UPDATE Nalozi SET pw='" . $pwen . "' WHERE user='" . $iime . "'"); 
        }
    }


    echo("<script>window.open('/login', '_self');</script>");

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
    

</body>
</html>
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
    else if(empty($_POST["tekst"]))
    {
        exit("<center><b><h1>Tekst obavijesti je prazan!</h1><br><a href='login'>Nazad</a></b></center>");
    }
    else if(strlen($_POST["tekst"]) > 15000)
    {
        exit("<center><b><h1>Tekst obavijesti ne može imati preko 15000 karaktera!</h1><br><a href='login'>Nazad</a></b></center>");
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

    //kreiranje obavijesti

    $date = new DateTime(null, new DateTimeZone('Europe/Amsterdam'));
    $unix = $date->getTimestamp() + $date->getOffset();

    if(is_dir("./Obavijesti/" . $unix)) //napravi folder (za slike)
    {
        if(!dir_is_empty("./Obavijesti/" . $unix))
        {
            exit("<center><b><h1>Problem pri upisivanju u databazu!</h1><br><a href='login'>Nazad</a></b></center>");
        }
    }
    else 
    {
        if(!mkdir("./Obavijesti/" . $unix))
        {
            exit("<center><b><h1>Problem pri upisivanju u databazu!</h1><br><a href='login'>Nazad</a></b></center>");
        }
    }
    
    $total_count = count($_FILES['slika']['name']);

    if($_FILES['slika']['name'][0] == "" || empty($_FILES['slika']['name'][0]))
    {
        $total_count = 0;
    }

    if($total_count > 5)
    {
        rmdir("./Obavijesti/" . $unix);
        exit("<center><b><h1>Ne možete prenijeti više od 5 slika!</h1><br><a href='login'>Nazad</a></b></center>");
    }
    else if($total_count > 0 && $total_count <= 5)
    {
        for($i = 0; $i < $total_count; $i++)
        {
            $tmpFilePath = $_FILES['slika']['tmp_name'][$i];
            
            $file_type = $_FILES['slika']['type'][$i];
            $allowed = array("image/jpeg", "image/gif", "image/png");
            if(!in_array($file_type, $allowed))
            {
                rmdir("./Obavijesti/" . $unix);
                exit("<center><b><h1>Možete prenijeti samo slike png, jpg, jpeg ili gif formata!</h1><br><a href='login'>Nazad</a></b></center>");
            }

            if($tmpFilePath != "")
            {
                $newFilePath = "./Obavijesti/" . $unix . "/" . $_FILES['slika']['name'][$i];
               
                if(!move_uploaded_file($tmpFilePath, $newFilePath))
                {
                    rmdir("./Obavijesti/" . $unix);
                    exit("<center><b><h1>Problem pri prijenosu slika!</h1><br><a href='login'>Nazad</a></b></center>");
                }
            }
        }
    }

    $tekst_s = strip_tags($_POST["tekst"], "<B><I><U><LEFT><CENTER><RIGHT>"); //ukloni sve HTML tagove osim ovih

    $tekst_s = preg_replace("/<([a-z][a-z0-9]*)[^>]*?(\/?)>/si",'<$1$2>', $tekst_s); //ukloni sve HTMl atribute preko regex-a

    $tekst_s = mysqli_real_escape_string($conn, $tekst_s); //escape-uj unsafe charactere (navodnici, \, itd...)

    mysqli_query($conn, "INSERT INTO Obavijesti (unix, tekst, postavio, slike) VALUES (" . $unix . ", '" . $tekst_s . "', '" . $_POST["usercheck"] . "', " . $total_count . ")");

    mysqli_close($conn);

    exit("<center><b><h1>Uspješno objavljena nova obavijesti!</h1><br><a href='/'>Nazad</a></b></center>");

    function dir_is_empty($dir)
    {
        $handle = opendir($dir);
        while(false !== ($entry = readdir($handle))) 
        {
            if($entry != "." && $entry != "..") 
            {
                closedir($handle);
                return false;
            }
        }
        closedir($handle);
        return true;
    }
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
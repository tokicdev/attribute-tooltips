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

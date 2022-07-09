<?php
    exit("Pristup odbijen!");
?>
<html lang="bs">
<head>
    <meta charset="UTF-8">
    <title>Srednja Strukovna Škola "Jajce" - Galerija</title>
    <link rel="icon" href="Images/favicon.png">
    <link rel="stylesheet" href="CSS/galerija.css">
</head>
<body>
    <?php include "menu.php";?>

    <div id="title">
        Srednja Strukovna Škola "JAJCE"
    </div>

    <div id="main">
        
        <div id="g_title_out"></div>
        <div id="g_title">
            <p>Galerija škole</p>
        </div>

        <div id="gwrapper">
            <div class="pic">
                <img src="Images/test_pic.jpg" alt="">
            </div>
            <div class="pic">
                <img src="Images/test_pic.jpg" alt="">
            </div>
        </div>

    </div>

    <?php include "footer.php";?>

    <script>
        setInterval(d, 70);
        function d()
        {
            //Ispis koef.
            //document.getElementById("ddd").innerHTML = document.getElementsByTagName("body")[0].offsetHeight / (document.documentElement.scrollTop || document.body.scrollTop);
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
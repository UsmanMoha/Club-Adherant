<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="styles.css">
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
            <title>Menu principal</title>
        </head>
        <body>
            <button id="bars" class="button open" onclick="openMenu()"><i class="fa fa-bars" aria-hidden="true"></i></button>
            <div class="flip-box">
                <div class="flip-box-inner" id="flip-box-click">
                    <div class="flip-box-front">
                        <h1>BIENVENUE</h1>
                        <h3>au club Maria Rose Sina</h3>
                    </div>
                    <div class="flip-box-back">
                        <div class="menu">
                            <div class="menu-items">
                                <h1>Connexion</h1>
                                <a href="crud/login.php">Admin</a>
                                <br><a href="info.php">Information</a>
                            </div>
                            <button class="button close" onclick="closeMenu()">&times;</button>

                        </div>
                    </div>
                </div>
            </div>
        </body>
        <script>
            function openMenu(){
                var open = document.getElementById("flip-box-click");
                var bars = document.getElementById("bars")
                open.style.transform = "rotateX(180deg)";
                bars.style.opacity = 0;
            }
            function closeMenu(){
                var close = document.getElementById("flip-box-click");
                var bars = document.getElementById("bars")
                close.style.transform = "rotateX(360deg)";
                bars.style.opacity = 1;
            }
        </script>
</html>
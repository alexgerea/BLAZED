<?php
    session_start();
    include "Scripturi/Login/dbconnect.php";
    if(isset($_POST['search']))
    {
        $search=$_POST['search'];
        header("Location: Pagini/produse?search=$search");
    }
    ?>
<!DOCTYPE html>
<html lang="ro">
    <head>
        <title>BLAZED - PC Building & Componente</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <meta name="theme-color" content="#282828">
        <link rel="icon" href="Imagini/Favicon/Blazed Favicon.png">
        <link rel="stylesheet" type="text/css" href="CSS/mainstyle.css">
        <!-- Font Awesome-->
        <script src="https://kit.fontawesome.com/ced6c6f4c0.js" crossorigin="anonymous"></script>
        <!-- Roboto font -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Koulen&family=Roboto:ital,wght@0,400;0,700;1,700&display=swap" rel="stylesheet">
    </head>
    <body>
        <header>
            <a href="index"><img class="logo" src="Imagini/Logo/BLAZED.svg"></a>
            <ul class="navigation">
                <li><a href="Pagini/produse">Calculatoare</a></li>
                <li><a href="Pagini/produse?categorie=Periferice">Periferice</a></li>
                <li><a href="Pagini/desprenoi">Despre Noi</a></li>
                <li><a href="Pagini/contact">Contact</a></li>
            </ul>
            <div class="icons">
                <div class="dropdown" data-dropdown>
                    <button class="link" data-dropdown-button><i style="pointer-events:none" class="fa-solid fa-magnifying-glass"></i></button>
                    <div class="dropdown-menu search">
                        <div class="search-input">
                            <form action="#" method="post">
                                <input type="text" class="popup-search-input" name="search" placeholder="Scrie pentru a căuta produse">
                                <button type="submit" class="popup-search-button"><i class="fa-solid fa-magnifying-glass-arrow-right"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="dropdown<?php if(isset($_GET['error']) || isset($_GET['success']) || isset($_GET['alert'])) echo " active"?>" data-dropdown>
                    <button class="link" data-dropdown-button><i style="pointer-events:none" class="fa-solid fa-user"></i></button>
                    <div class="dropdown-menu user" <?php if(isset($_SESSION['id']) && isset($_SESSION['email'])) echo "style=left:-9rem"?>>
                        <div class="login-form-wrap">
                            <?php if(isset($_SESSION['id']) && isset($_SESSION['email'])) {?>
                                <div class="logged-in-wrap">
                                    <?php if(isset($_GET['success'])){ ?>
                                        <p class="success"><?php echo $_GET['success'];?></p>
                                    <?php } ?>
                                    <?php if(isset($_GET['alert'])){?>
                                        <p class="alert"><?php echo $_GET['alert'];?></p>
                                    <?php }?>
                                    <div class="login-text">Salut, <?php echo $_SESSION['prenume'];?></div>
                                    <div class="logout-link"><a href="Pagini/administrarecont">Administrare cont</a></div>
                                    <div class="logout-link"><a href="Scripturi/Login/logout">Logout</a></div>
                                </div>
                            <?php } else {?>
                            <form class="login-form" action="Scripturi/Login/login" method="post">
                                <div class="login-title">Autentificare</div>
                                <?php if(isset($_GET['error'])){ ?>
                                    <p class="error"><?php echo $_GET['error'];?></p>
                                <?php } ?>
                                <?php if(isset($_GET['success'])){ ?>
                                    <p class="success"><?php echo $_GET['success'];?></p>
                                <?php } ?>
                                <?php if(isset($_GET['alert'])){ ?>
                                    <p class="alert"><?php echo $_GET['alert'];?></p>
                                <?php } ?>
                                <i class="fa-solid fa-envelope"></i><label for="email">Email</label>
                                <input type="email" name="email" id="email">
                                <i class="fa-solid fa-key"></i><label for="password">Parola</label>
                                <input type="password" name="password" id="password">
                                <div class="remember"><input type="checkbox" name="remember" id="remember"><label for="remember">Ține-mă minte</label></div>
                                <button type="submit" class="startexploring">Login</button>
                                <div class="register-link"><a href="Pagini/inregistrare">Înregistrare</a></div>
                            </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php if(isset($_SESSION['id'])) echo "<a href=Pagini/cosdecumparaturi>"?>
                <div class="dropdown" data-dropdown>
                    <button class="link" data-dropdown-button><i style="pointer-events:none" class="fa-solid fa-cart-shopping"></i></button>
                    <div class="dropdown-menu cart">
                        <?php if(!isset($_SESSION['id'])) {?>
                            <div class="shopinfo">
                                <div class="shop-title">Coșul de cumpărături</div>
                                <div class="shoptxt"><p>Nu sunteți logat!</p></div>
                                <button class="startexploring"><a href="index?alert=Introduceți datele">Login</a></button>
                            </div>
                        <?php }else{?>
                            <div class="shoptxt"><p>Către cumpărături...</p></div>
                        <?php }?>
                    </div>
                </div>
                <?php echo "</a>"?>
            </div>
            <div class="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </header>
        <div class="hero">
            <div class="herocanvas">
                <div class="left">
                    <div class="big-title">
                        <h1>Blaze them <div class="selected">good</div></h1>
                    </div>
                    <p class="hero-paragraph">Explorează acum cele mai noi PC-uri de tip Workstation, special gândite pentru task-uri intensive și Gaming.</p>
                    <a href="Pagini/produse"><button class="startexploring">Start exploring now</button></a>
                </div>

                <div class="right">
                    <img src="Imagini/Hero/PC.png" class="heropc">
                </div>
            </div>
        </div>
        <div class="prodexcanvas">
            <div class="prodtext">Categorii:</div>
            <div class="prodex">
                    <div class="prod"
                    style="background-image:url('Imagini/Produse/Prezentare Produse/PC Gaming.jpg');">
                        <div class="prodextext">
                        <a href="Pagini/produse?categorie=PC%20Gaming"><button class="startexploring">PC Gaming</button></a>
                        </div>
                    </div>
                    <div class="prod"
                    style="background-image:url('Imagini/Produse/Prezentare Produse/PC Office.jpg');">
                        <div class="prodextext">
                        <a href="Pagini/produse?categorie=PC%20Office"><button class="startexploring">PC Office</button></a>
                        </div>
                    </div>
                <a href="Pagini/produse?categorie=Periferice">
                    <div class="prod"
                    style="background-image:url('Imagini/Produse/Prezentare Produse/Periferice.jpg');">
                        <div class="prodextext">
                        <a href="Pagini/produse?categorie=Periferice"><button class="startexploring">Periferice</button></a>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="prodcontainercanvas">
            <div class="prodcontainertext">Recomandarile Noastre:</div>
            <div class="prodcontainer">
                <a href="Pagini/produse?search=PC%20HP%20Pavilion">
                    <div class="box">
                        <div class="image">
                            <img src="Imagini/Produse/Prezentare Produse/PC 1.png">
                        </div>
                        <div class="info">
                            <div class="subinfo">
                                <h3 class="title">PC HP Pavilion / Ryzen 7, GTX 1660, 512GB SSD + 1TB HDD</h3>
                                <div class=price><span>4.600 lei</span></div>
                                <div class="price">4.400 lei</div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="Pagini/produse?search=PC%20Serioux%20pwd.">
                    <div class="box">
                        <div class="image">
                            <img src="Imagini/Produse/Prezentare Produse/PC 2.png">
                        </div>
                        <div class="info">
                            <div class="subinfo">
                                <h3 class="title">PC Serioux pwd. by ASUS / i5, GTX 1650, 512GB SSD</h3>
                                <div class=price><span>3.700 lei</span></div>
                                <div class="price">3.400 lei</div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="Pagini/produse?search=Laptop%20ASUS%20/%20Ryzen%205">
                    <div class="box">
                        <div class="image">
                            <img src="Imagini/Produse/Prezentare Produse/PC 3.png">
                        </div>
                        <div class="info">
                            <div class="subinfo">
                                <h3 class="title">Laptop ASUS / Ryzen 5, GTX 1650, 512GB SSD, 144hz</h3>
                                <div class=price><span>4.000 lei</span></div>
                                <div class="price">3.800 lei</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <footer>
            <div class="footer-content">
                <img class="blazedest" src="Imagini/Logo/BLAZED EST 2020 LOGO.svg">
                <p>For Pros by Pros.</p>
                <ul class="socials">
                    <li><a href="https://github.com/alexgerea"><i class="fa-brands fa-github"></i></a></li>
                    <li><a href="https://www.linkedin.com/in/alexandru-gerea-6b179a157/"><i class="fa-brands fa-linkedin"></i></a></li>
                </ul>
                <div class="footer-bottom">
                    <p>Made with <span class="love"><i class="fa-solid fa-heart"></i></span> by <span class="Stinray">Alexandru Gerea</span></p>
                </div>
            </div>
        </footer>
        <script src="Scripturi/hamburgermenu.js"></script>
        <script src="Scripturi/dropdownmenu.js"></script>
    </body>
</html>
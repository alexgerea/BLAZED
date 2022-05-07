<?php session_start();
    require_once('../Scripturi/Produse/createprod.php');
    require_once('../Scripturi/Produse/component.php');
    $tabel = new CreareProduse("BLAZED","produse");

    if(isset($_POST['remove'])){
        if($_GET['action']=='remove'){
            echo "da bossule";
            foreach($_SESSION['cart'] as $key=>$value){
                if($value['idprodus'] == $_GET['id']){
                    unset($_SESSION['cart'][$key]);
                    header("Location: cosdecumparaturi.php?alert=Produsul a fost scos din coș!");
                }
            }
        }
    }

    if(isset($_POST['search']))
    {
        $search=$_POST['search'];
        header("Location: produse.php?search=$search");
    }
?>
<!DOCTYPE html>
<html lang="ro">
    <head>
        <title>BLAZED - Coș de cumpărături</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <meta name="theme-color" content="#282828">
        <link rel="icon" href="../Imagini/Favicon/Blazed Favicon.png">
        <link rel="stylesheet" type="text/css" href="../CSS/header.css">
        <link rel="stylesheet" type="text/css" href="../CSS/shoppingcart.css">
        <link rel="stylesheet" type="text/css" href="../CSS/footer.css">
        <!-- Font Awesome-->
        <script src="https://kit.fontawesome.com/ced6c6f4c0.js" crossorigin="anonymous"></script>
        <!-- Roboto font -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Koulen&family=Roboto:ital,wght@0,400;0,700;1,700&display=swap" rel="stylesheet">
    </head>
    <body>
        <header>
            <a href="../index.php"><img class="logo" src="../Imagini/Logo/BLAZED.svg"></a>
            <ul class="navigation">
                <li><a href="produse.php">Calculatoare</a></li>
                <li><a href="produse.php?categorie=Periferice">Periferice</a></li>
                <li><a href="desprenoi.php">Despre Noi</a></li>
                <li><a href="contact.php">Contact</a></li>
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
                                    <div class="logout-link"><a href="../Pagini/administrarecont.php">Administrare cont</a></div>
                                    <div class="logout-link"><a href="../Scripturi/Login/logout.php">Logout</a></div>
                                </div>
                            <?php } else {?>
                            <form class="login-form" action="../Scripturi/Login/login.php" method="post">
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
                                <div class="register-link"><a href="../Pagini/inregistrare.php">Înregistrare</a></div>
                            </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php if(isset($_SESSION['id'])) echo "<a href=cosdecumparaturi.php>"?>
                <div class="dropdown" data-dropdown>
                    <button class="link" data-dropdown-button><i style="pointer-events:none" class="fa-solid fa-cart-shopping"></i></button>
                    <div class="dropdown-menu cart">
                        <?php if(!isset($_SESSION['id'])) {?>
                            <div class="shopinfo">
                                <div class="shop-title">Coșul de cumpărături</div>
                                <div class="shoptxt"><p>Nu sunteți logat!</p></div>
                                <button class="startexploring"><a href="../index.php?alert=Introduceți datele">Login</a></button>
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
        <div class="shopcartcontainer">
            <h1 class="title">Cos de cumparaturi</h1>
            <div class="cart">
                <div class="products">
                        <?php
                            if(isset($_SESSION['cart']))
                            {
                                if(count($_SESSION['cart'])==0)
                                echo "<div class=\"noitemsincart\">Cosul este gol!<br></div>";
                                $idprodus = array_column($_SESSION['cart'],'idprodus');
                                $result = $tabel->getData();
                                $prettotal=0;
                                while($row = mysqli_fetch_assoc($result)){
                                    foreach($idprodus as $id){
                                        if($row['id'] == $id){
                                            cartElement($row['imagineprodus'],$row['numeprodus'],$row['pretprodus'],$row['id']);
                                            $prettotal = $prettotal + (int)$row['pretprodus'];
                                        }
                                    }
                                }
                            }else{
                                echo "<div class=\"noitemsincart\">Cosul este gol!<br></div>";
                            }
                        ?>
                </div>
                <div class="cart-total">
                    <p>
                        <span>Număr produse:</span>
                        <span><?php if(isset($_SESSION['cart'])){
                                $count = count($_SESSION['cart']);
                                echo $count;
                            }
                            else echo "0";
                        ?></span>
                    </p>
                    <p>
                        <span>Preț total</span>
                        <span><?php if(isset($_SESSION['cart'])){
                                echo $prettotal . " lei";
                            }
                            else echo 0?></span>
                    </p>
                    <a href="#">Continua spre plata</a>
                </div>
            </div>
        </div>
        <footer>
            <div class="footer-content">
                <img class="blazedest" src="../Imagini/Logo/BLAZED EST 2020 LOGO.svg">
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
        <script src="../Scripturi/hamburgermenu.js"></script>
        <script src="../Scripturi/dropdownmenu.js"></script>
    </body>
</html>
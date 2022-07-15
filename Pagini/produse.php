<?php session_start();
    require_once('../Scripturi/Produse/createprod.php');
    require_once('../Scripturi/Produse/component.php');
    // Cream o instanta a clasei CreareDb
    $tabel = new CreareProduse("blazed","produse");

    if(isset($_POST['add'])){
        if(!isset($_SESSION['id']))
        {
            header("Location: produse.php?alert=Trebuie sa fiti logat pentru a adauga la cos!");
            exit();
        }
        // print_r($_POST['idprodus']);
        if(isset($_SESSION['cart'])){
            $id_item_lista = array_column($_SESSION['cart'],'idprodus');
            //echo "aici";
            // print_r($id_item_lista);

            if(in_array($_POST['idprodus'],$id_item_lista)){
               header("Location: produse.php?alert=Produsul este deja in cos!");
            }
            else{
                $count = count($_SESSION['cart']);
                $item_array = array(
                    'idprodus' => $_POST['idprodus']
                );

                $_SESSION['cart'][$count] = $item_array;
                // print_r($_SESSION['cart']);
                header("Location: produse.php?success=Produsul a fost adaugat!");
            }
        }else{
            $item_array = array(
                'idprodus' => $_POST['idprodus']
            );

            // Crearea unei noi sesiuni
            $_SESSION['cart'][0] = $item_array;
            //print_r($_SESSION['cart']);
            header("Location: produse.php?success=Produsul a fost adaugat!");
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
        <title>BLAZED -  <?php if(isset($_GET['categorie'])) echo $_GET['categorie'];
         else if(isset($_GET['search'])) echo $_GET['search'];else echo "Produse"?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <meta name="theme-color" content="#282828">
        <link rel="icon" href="../Imagini/Favicon/Blazed Favicon.png">
        <link rel="stylesheet" type="text/css" href="../CSS/header.css">
        <link rel="stylesheet" type="text/css" href="../CSS/shop.css">
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
                <div class="dropdown<?php if(isset($_GET['error']) || isset($_GET['alert']) || isset($_GET['success'])) echo " active"?>" data-dropdown>
                    <button class="link" data-dropdown-button><i style="pointer-events:none" class="fa-solid fa-user"></i></button>
                    <div class="dropdown-menu user" <?php if(isset($_SESSION['id']) && isset($_SESSION['email'])) echo "style=left:-9rem"?>>
                        <div class="login-form-wrap">
                            <?php if(isset($_SESSION['id']) && isset($_SESSION['email'])) {?>
                                <div class="logged-in-wrap">
                                    <?php if(isset($_GET['error'])){ ?>
                                        <p class="error"><?php echo $_GET['error'];?></p>
                                    <?php } ?>
                                    <?php if(isset($_GET['success'])){ ?>
                                        <p class="success"><?php echo $_GET['success'];?></p>
                                    <?php } ?>
                                    <?php if(isset($_GET['alert'])){ ?>
                                        <p class="alert"><?php echo $_GET['alert'];?></p>
                                    <?php } ?>
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
                <?php if(isset($_SESSION['id'])) echo "<a href=../Pagini/cosdecumparaturi.php>"?>
                <div class="dropdown" data-dropdown>
                    <button class="link" data-dropdown-button><i style="pointer-events:none" class="fa-solid fa-cart-shopping"></i></button>
                    <div class="dropdown-menu cart">
                        <?php if(!isset($_SESSION['id'])) {?>
                            <div class="shopinfo">
                                <div class="shop-title">Coșul de cumpărături</div>
                                <div class="shoptxt"><p>Nu sunteți logat!</p></div>
                                <button class="startexploring"><a href="../Pagini/produse.php?alert=Introduceți datele">Login</a></button>
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
        <div class="prodcontainercanvas">
            <?php 
                                if(isset($_GET['categorie'])) 
                                {
                                    $categorie=$_GET['categorie'];
                                    echo "<div class=\"prodcontainertext\">Categoria $categorie:</div>";
                                }else if(isset($_GET['search']))
                                {
                                    $search = $_GET['search'];
                                    echo "<div class=\"prodcontainertext\">Rezultatele cautarii '$search':</div>";
                                }
                                else{
                                    echo "<div class=\"prodcontainertext\">Calculatoare:</div>";
                                }
            ?>
            <div class="prodcontainer">
                <?php
                    /*$result = $tabel->getData();
                    while($row = mysqli_fetch_assoc($result)){
                        component($row['numeprodus'],$row['pretprodus'],$row['imagineprodus'],$row['id']);
                    }*/
                    if(isset($_GET['categorie'])) 
                    {
                        $result = $tabel->getDataByCategory($_GET['categorie']);
                        if($result==null)
                        {
                            $category = $_GET['categorie'];
                            echo "<p class=\"searchnotfound\">Nu exista produse in categoria $category</p>";;
                        }
                        else
                        {
                            while($row = mysqli_fetch_assoc($result)){
                                component($row['numeprodus'],$row['pretprodus'],$row['imagineprodus'],$row['id']);
                            }
                        }

                    }else if(isset($_GET['search']))
                    {
                        $result = $tabel->getDataByKeyword($_GET['search']);
                        $search = $_GET['search'];
                        if($result == null)
                        {
                            echo "<p class=\"searchnotfound\">Nu exista produse cu numele $search</p>";
                        }
                        else
                        {
                            while($row = mysqli_fetch_assoc($result)){
                                component($row['numeprodus'],$row['pretprodus'],$row['imagineprodus'],$row['id']);
                            }
                        }
                    }
                    else{
                        $result = $tabel->getData();
                        while($row = mysqli_fetch_assoc($result)){
                        component($row['numeprodus'],$row['pretprodus'],$row['imagineprodus'],$row['id']);
                        }
                    }
                ?>
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
<?php
session_start();
        if(isset($_POST['emailc']) && isset($_POST['categoriec']) && isset($_POST['mesajc']))
        {
            function validate($data){
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            $mail=validate($_POST['emailc']);
            $categorie=validate($_POST['categoriec']);
            $mesaj=validate($_POST['mesajc']);
            $rating=validate($_POST['ratingc']);

            if(empty($mail)){
                header("Location: ../../Pagini/contact.php?errorf=Introduceti emailul...");
                exit();
            }else if(empty($categorie)){
                header("Location: ../../Pagini/contact.php?errorf=Introduceti categoria..");
                exit();
            }else if(empty($mesaj)){
                header("Location: ../../Pagini/contact.php?errorf=Introduceti mesajul..");
                exit();
            }else{
                $mesajfinal="EMAIL: " . $mail . "\nCATEGORIE: ". $categorie . "\nMESAJ: " . $mesaj . "\nRATING: ". $rating . "\n\n";
                echo $mesajfinal;

                $fisier = fopen("../../Alte fisiere/Mesaje contact/mesajecontact.txt","a");
                fwrite($fisier,$mesajfinal);
                fclose($fisier);

                header("Location: ../../index.php?success=Mesajul a fost transmis cu succes!");
                exit();
            }
        }
?>
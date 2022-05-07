<?php 
session_start();
if(isset($_SESSION['id']) && isset($_SESSION['nume'])){
    include "dbconnect.php";
    if(isset($_POST['emailf']) && $_POST['emailfv']){
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $oldmail = $_SESSION['email'];
        $newmail = validate($_POST['emailf']);
        $validatenewmail = validate($_POST['emailfv']);
        $pass = validate($_POST['passwordf']);

        if(empty($newmail)){
            header("Location: ../../Pagini/schimbaemail.php?errorf=Introduceti mailul nou...");
            exit();
        }else if(empty($validatenewmail)){
            header("Location: ../../Pagini/schimbaemail.php?errorf=Introduceti mailul nou...");
            exit();
        }else if($newmail !== $validatenewmail){
            header("Location: ../../Pagini/schimbaemail.php?errorf=Introduceti mailul nou corect in ambele casete");
            exit();
        }else if($oldmail == $newmail){
            header("Location: ../../Pagini/schimbaemail.php?errorf=Mail-ul nou coincide cu cel vechi...");
            exit();
        }
        else
        {
            $id = $_SESSION['id'];
            $pass = md5($pass);
            $passv = "SELECT parola
            FROM utilizatori
            WHERE id='$id' AND
            parola='$pass'";
            $verifypass = mysqli_query($connection,$passv);
            if(mysqli_num_rows($verifypass) === 1){
                $sql = "SELECT email
                FROM utilizatori
                WHERE id='$id' AND
                email='$oldmail'";
                $result = mysqli_query($connection,$sql);
                if(mysqli_num_rows($result) === 1){
                    $sql2 = "UPDATE utilizatori
                    SET email='$newmail'
                    WHERE id='$id'";
                    $result2 = mysqli_query($connection,$sql2);
                    session_unset();
                    session_destroy();
                    header("Location: ../../index.php?success=Mail-ul a fost schimbat cu succes!");
                    exit();
                 }else{
                    header("Location: ../../Pagini/schimbaemail.php?errorf=Eroare la Database...");
                   exit();
              }
            }
            else{
                header("Location: ../../Pagini/schimbaemail.php?errorf=Parola este gresita!");
                exit();
            }
        }
    }
    else{
        header("Location: ../../Pagini/schimbaemail.php?errorf=Introduceti mailul nou...");
        exit();
    }
}
else{
    header("Location: ../../Pagini/schimbaemail.php?errorf=da");
    exit();
}
?>
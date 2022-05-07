<?php
session_start();
include "dbconnect.php";

    if(isset($_POST['email']) && isset($_POST['password'])){
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $email = validate($_POST['email']);
        $pass = validate($_POST['password']);

        if(empty($email)){
            header("Location: ../../index.php?error=Emailul este necesar");
            exit();
        }else if(empty($pass)){
            header("Location: ../../index.php?error=Parola este necesara");
            exit();
        }else{
            $pass=md5($pass);
            $sql = "SELECT * FROM utilizatori WHERE email='$email' AND parola='$pass'";
            $result = mysqli_query($connection, $sql);
            
            if(mysqli_num_rows($result) === 1){
                $row = mysqli_fetch_assoc($result);
                if($row['email'] === $email && $row['parola'] === $pass){
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['prenume'] = $row['prenume'];
                    $_SESSION['nume'] = $row['nume'];
                    $_SESSION['id'] = $row['id'];
                    if(isset($_POST['remember'])){
                        setcookie("emb",$row['email'],time()+60*60*24*6004,'/','localhost');
                        setcookie("prenb",$row['prenume'],time()+60*60*24*6004,'/','localhost');
                        setcookie("numeb",$row['nume'],time()+60*60*24*6004,'/','localhost');
                        setcookie("idb",$row['id'],time()+60*60*24*6004,'/','localhost');
                    }
                    header("Location: ../../index.php?success=Logat cu succes!");
                    exit();
                }
                    else{
                        header("Location: ../../index.php?error=Email sau parolă incorecte");
                        exit();
                    }
            }
            else{
                header("Location: ../../index.php?error=Email sau parolă incorecte");
                exit();
            }
        }
    }
    else{
        header("Location: ../../index.php?error=da");
        exit();
    }
?>
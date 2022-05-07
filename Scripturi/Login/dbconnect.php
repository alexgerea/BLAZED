<?php

$sname = "localhost";
$uname = "root";
$password = "";

$dbname = "BLAZED";
$connection = mysqli_connect($sname,$uname,$password,$dbname);

if(!$connection){
    $crearedatabase = "CREATE DATABASE IF NOT EXISTS BLAZED";
    if(!mysqli_query($this->connection,$crearedatabase)){
        echo "Nu se poate crea baza de date BLAZED!";
            exit();
        }

        $sql="CREATE TABLE IF NOT EXISTS utilizatori
        (id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(255),
        parola VARCHAR(255),
        nume VARCHAR(255),
        prenume VARCHAR(255));";
        $this->connection = mysqli_connect($sname,$uname,$password,$dbname);

        if(!mysqli_query($this->connection,$sql)){
            echo "Nu se poate crea tabelul pentru utilizatori!";
                exit();
        }else{
            header("Location: ../../index.php?success=A fost creata baza de date BLAZED, incercati din nou login/register");
        }
}

if(isset($_COOKIE['idb']) && isset($_COOKIE['emb']) && !isset($_SESSION['id']))
{
    $_SESSION['email'] = $_COOKIE['emb'];
    $_SESSION['prenume'] = $_COOKIE['prenb'];
    $_SESSION['nume'] = $_COOKIE['numeb'];
    $_SESSION['id'] = $_COOKIE['idb'];
}
?>
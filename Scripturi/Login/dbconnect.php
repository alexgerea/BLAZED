<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$sname = "localhost";
$uname = "root";
$password = "";

$dbname = "blazed";
$connection = mysqli_connect($sname,$uname,$password) or die ('Nu a putut fi realizata conexiunea la MySQL. Eroarea este: ' . mysqli_connect_error($connection));

try{
    $dbselected = mysqli_select_db($connection,'blazed');
}
catch(mysqli_sql_exception $e){
    echo $e->getMessage();
    $createdb = "CREATE DATABASE IF NOT EXISTS blazed";
    if(!mysqli_query($connection,$createdb))
    {
        echo "Nu se poate crea baza de date blazed!";
        exit();
    }
    $sql="CREATE TABLE IF NOT EXISTS utilizatori
    (id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255),
    parola VARCHAR(255),
    nume VARCHAR(255),
    prenume VARCHAR(255));";
    $connection = mysqli_connect($sname,$uname,$password,$dbname);

    if(!mysqli_query($connection,$sql)){
        echo "Nu se poate crea tabelul pentru utilizatori!";
            exit();
    }else{
        header("Location: index.php?success=A fost creata baza de date BLAZED");
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
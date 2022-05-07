<?php
    session_start();
    session_unset();
    session_destroy();
    unset($_COOKIE["emb"]);
    unset($_COOKIE["prenb"]);
    unset($_COOKIE["numeb"]);
    unset($_COOKIE["idb"]);
    setcookie("emb",null,-1,'/','localhost');
    setcookie("prenb",null,-1,'/','localhost');
    setcookie("numeb",null,-1,'/','localhost');
    setcookie("idb",null,-1,'/','localhost');
    header("Location: ../../index.php?alert=Delogat cu succes");
?>
<?php 
session_start();
if(isset($_SESSION['id']) && isset($_SESSION['nume'])){
    include "dbconnect.php";
    if(isset($_POST['oldpasswordf']) && $_POST['passwordf'] &&  $_POST['passwordfv']){
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $oldpassword = validate($_POST['oldpasswordf']);
        $newpassword = validate($_POST['passwordf']);
        $validatenewpassword = validate($_POST['passwordfv']);

        if(empty($oldpassword)){
            header("Location: ../../Pagini/schimbaparola?errorf=Introduceti parola veche...");
            exit();
        }else if(empty($newpassword)){
            header("Location: ../../Pagini/schimbaparola?errorf=Introduceti parola noua");
            exit();
        }else if($newpassword !== $validatenewpassword){
            header("Location: ../../Pagini/schimbaparola?errorf=Introduceti parola noua corect in ambele casete");
            exit();
        }
        else
        {
            if($oldpassword === $newpassword)
            {
                header("Location: ../../Pagini/schimbaparola?errorf=Parola veche si cea noua coincid!");
                exit();
            }
            $oldpassword = md5($oldpassword);
            $newpassword = md5($newpassword);
            $id = $_SESSION['id'];
            $sql = "SELECT parola
                    FROM utilizatori
                    WHERE id='$id' AND
                    parola = '$oldpassword'";
            $result = mysqli_query($connection,$sql);
            if(mysqli_num_rows($result) === 1){
                $sql2 = "UPDATE utilizatori
                        SET parola='$newpassword'
                        WHERE id='$id'";
                $result2 = mysqli_query($connection,$sql2);
                session_unset();
                session_destroy();
                header("Location: ../../?success=Parola a fost schimbata cu succes!");
                exit();
            }else{
                header("Location: ../../Pagini/schimbaparola?errorf=Parola veche este incorecta");
                exit();
            }
        }
    }
    else{
        header("Location: ../../Pagini/schimbaparola?errorf=Introduceti parola veche si cea noua!");
        exit();
    }
}
else{
    header("Location: ../../Pagini/schimbaparola?errorf=da");
    exit();
}
?>
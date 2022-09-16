<?php 
session_start();
if(isset($_SESSION['id']) && isset($_SESSION['nume'])){
    include "dbconnect.php";
    if(isset($_POST['passwordf'])){
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $pass = $_POST['passwordf'];

        if(empty($pass)){
            header("Location: ../../Pagini/stergecont?errorf=Introduceți parola...");
            exit();
        }
        else
        {
            $id = $_SESSION['id'];
            $mail = $_SESSION['mail'];
            $pass = md5($pass);
            $sql = "SELECT parola
                    FROM utilizatori
                    WHERE id='$id' AND
                    parola='$pass'";
            $result = mysqli_query($connection,$sql);
            if(mysqli_num_rows($result) === 1){
                $sql2 = "DELETE FROM utilizatori
                        where id='$id'";
                $result2 = mysqli_query($connection,$sql2);
                session_unset();
                session_destroy();
                header("Location: ../../?alert=Contul a fost sters!");
                exit();
            }else{
                header("Location: ../../Pagini/stergecont?errorf=Parola nu este corecta...");
                exit();
            }
        }
    }
    else{
        header("Location: ../../Pagini/stergecont?errorf=Introduceti parola...");
        exit();
    }
}
else{
    header("Location: ../../Pagini/stergecont?errorf=da");
    exit();
}
?>
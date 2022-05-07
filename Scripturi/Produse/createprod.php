<?php
include (dirname(dirname(__FILE__)) . '\Login\dbconnect.php');
    class CreareProduse
    {
        public $connection;
        public $dbname;
        public $tablename;

        public function __construct(
            $dbname="nouabazadedate",
            $tablename="noultabel",

            $sname="localhost",
            $uname="root",
            $password = ""
        )
        {
            $sql="CREATE TABLE IF NOT EXISTS $tablename
            (id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            numeprodus VARCHAR(100) NOT NULL,
            pretprodus FLOAT,
            imagineprodus VARCHAR(100));";
            $this->connection = mysqli_connect($sname,$uname,$password,$dbname);

            if(!mysqli_query($this->connection,$sql)){
                echo "Nu se poate crea tabelul pentru produse!";
            }
        }

        public function getData(){
            $sql = "SELECT * FROM produse";

            $result = mysqli_query($this->connection,$sql);

            if(mysqli_num_rows($result)>0){
                return $result;
            }
        }

        public function getDataByCategory($category){
            $sql = "SELECT * FROM produse WHERE categorie='$category'";

            $result = mysqli_query($this->connection,$sql);

            if(mysqli_num_rows($result)>0){
                return $result;
            }
        }

        public function getDataByKeyword($keyword){
            $sql = "SELECT * FROM produse WHERE numeprodus LIKE '%$keyword%'";

            $result = mysqli_query($this->connection,$sql);

            if(mysqli_num_rows($result)>0){
                return $result;
            }
        }
    }
?>
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

            $sql2="SELECT EXISTS (SELECT * from produse WHERE id=1);";

            if(!mysqli_query($this->connection,$sql2)){
                $sql3="INSERT INTO $tablename
                VALUES (NULL,'PC HP Pavilion / Ryzen 7, GTX 1660, 512GB SSD + 1TB HDD',4400,'../Imagini/Produse/Prezentare Produse/PC 1.png'),
                (NULL,'PC Serioux pwd. by ASUS / i5, GTX 1650, 512GB SSD',3400,'../Imagini/Produse/Prezentare Produse/PC 2.png','PC Gaming'),
                (NULL,'Laptop ASUS / Ryzen 5, GTX 1650, 512GB SSD, 144hz ',3800,'../Imagini/Produse/Prezentare Produse/PC 3.png','PC Gaming'),
                (NULL,'Mouse Logitech G102 Lightsync / 8000 dpi / RGB / Negru',120,'../Imagini/Produse/Periferice/g102.webp','Periferice'),
                (NULL,'PC Serioux pwd. by ASUS i5 / UHD 630 / 8GB RAM / 512GB SSD',2000,'../Imagini/Produse/PC Office/ASUS i5 8gb 500 ssd.png','PC Office'),
                (NULL,'Dell Inspiron / i5 / UHD 630 / 8 GB RAM / 512GB SSD + 1TB HDD',3100,'../Imagini/Produse/PC Office/Dell Inspiron i5 uhd 630.png','Periferice'),
                (NULL,'Tastatura SteelSeries Apex 100',252,'../Imagini/Produse/Periferice/steelseries apex 100.png','Periferice'),
                (NULL,'Tastatura Redgrahon Shiva',120,'../Imagini/Produse/Periferice/Redragon shiva.png','Periferice');";
                if(!mysqli_query($this->connection,$sql3)){
                    echo "Nu se poate popula baza de date!";
                }
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
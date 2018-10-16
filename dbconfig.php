<?php
  
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "task";
            $dsn = "mysql:host=$servername;dbname=$dbname";
            try{
                $con=new PDO("mysql:host=$servername;dbname=$dbname","root","");
                $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
               
               } 
            catch(PDOException $e){
            echo "Exception: "+$e->getMessage();
          
            }
       
?>
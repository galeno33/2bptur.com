<?php

            header("Access-Control-Allow-Origin: *");
            header('Content-Type: text/html; charset=utf-8');
            //$host = "mysql:host=localhost;dbname=sistem_loja";
            $host = "localhost";//no lugar de localhost colar == mysql380.umbler.com(é o host do servidor online)
            /*$username = "id18282510_root";//usuario do banco de dados
            $password = "Bptu2022^2022"; //senha do banco de dados
            $dbname = "id18282510_2bptur_data";*/
            $username = "root";//usuario do banco de dados
            $password = ""; //senha do banco de dados
            $dbname = "bptur_data";

            $conn = mysqli_connect($host, $username, $password, $dbname);
            //$dbname = mysql_select_db("sistem_loja");
           // $connect = new PDO($host, $username, $password, $dbname);
            if($conn === false){
                die("Erro na conexão." . mysqli_connect_error());
            }

?>
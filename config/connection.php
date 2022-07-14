<?php 

    $host = 'localhost';
    $user = 'davi';
    $pass = 'davi1234';
    $db = 'agenda';

    try{
        $conn = new PDO("mysql:host=$host; dbname=$db", $user, $pass);

        $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        $error = $e->getMessage();
        echo "Erro: $error";
    }

?>
<?php

session_start();

if (isset($_SESSION['User']) && $_SESSION['User']['First_name'] == "Esther") {

    try {
        $dbh = new PDO("mysql:host=localhost;dbname=eam_consultores", "root", "");
        $ID = $_SESSION['User']['ID'];
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stat = $dbh->prepare(
                "SELECT c.* 
                FROM content c WHERE u.ID = ?
                INNER JOIN users u"
            );
        $stat->bindParam(1, $ID);
        $stat->execute();
        $row = $stat->fetch();
        
    } catch (PDOException $e) {
        echo "Error!: " . $e->getMessage() . "<br>";
        die();
    }

}
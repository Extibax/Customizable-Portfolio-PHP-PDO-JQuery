<?php

session_start();

if (isset($_POST['Email']) && isset($_POST['Password']) && !isset($_SESSION['User'])) {

    require 'connection.php';

    $Email = !empty($_POST['Email']) && !is_numeric($_POST['Email']) ? $_POST['Email'] : false;
    $Password = !empty($_POST['Password']) ? $_POST['Password'] : false;


    if ($Email && $Password) {
        $stmt = $dbh->prepare("SELECT * FROM users WHERE ID = 1 AND Email = '$Email'");
        $stmt->execute();
        $User = $stmt->fetch();

        if (password_verify($Password, $User['Password'])) {
            $_SESSION['User'] = $User;
            echo "1";
        } else {
            echo "0";
        }
    }

} else if (isset($_SESSION['User'])) {
    echo "1";
} else {
    echo "0";
}
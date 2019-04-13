<?php

/* In this file the data is load and is used for the Load_index.js file */

session_start();

require 'connection.php';

try {
    $stmt = $dbh->prepare("SELECT * FROM content");
    $stmt->bindValue(1, $ID);
    echo $stmt->execute() ? "" : "Error: " . $stmt->infoError();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $result['about_image_file_1'] = base64_encode($result['about_image_file_1']);
    $result['portfolio_image_file_1'] = base64_encode($result['portfolio_image_file_1']);
    $result['portfolio_image_file_2'] = base64_encode($result['portfolio_image_file_2']);
    $result['portfolio_image_file_3'] = base64_encode($result['portfolio_image_file_3']);

    $json_content = json_encode($result, 512);

    echo $json_content ? $json_content : json_last_error_msg();
} catch (PDOException $e) {
    echo "Error!: " . $e->getMessage() . "<br>";
    die();
}

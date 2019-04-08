<?php

session_start();

if (isset($_SESSION['User']) && $_SESSION['User']['First_name'] == "Esther") {

    require 'connection.php';

    try {
        $ID = $_SESSION['User']['ID'];
        $stmt = $dbh->prepare(
            "SELECT c.*, u.First_name FROM content c
                INNER JOIN users u ON u.ID = c.User_id
                    WHERE c.User_id = ?"
        );
        $stmt->bindValue(1, $ID);
        echo $stmt->execute() ? "" : "Error: " . $stmt->infoError();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $result['about_img'] = base64_encode($result['about_img']);
        $result['portfolio_image_1'] = base64_encode($result['portfolio_image_1']);
        $result['portfolio_image_2'] = base64_encode($result['portfolio_image_2']);
        $result['portfolio_image_3'] = base64_encode($result['portfolio_image_3']);
        /* $json_content = json_encode($result, 512); */
        $json_content = json_encode(array_values($result), 512);

        if ($json_content) {
            echo $json_content;
        } else {
            echo json_last_error_msg();
        }

    } catch (PDOException $e) {
        echo "Error!: " . $e->getMessage() . "<br>";
        die();
    }
} else {
    echo $_SESSION['User'] ? "Session user exists" : "403";
}

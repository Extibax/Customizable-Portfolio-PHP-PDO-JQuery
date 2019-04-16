<?php

/* In this file the data is load and is used for the Load.js file */
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['User']) && $_SESSION['User']['First_name'] == "Juan") {

    require('connection.php');

    try {
        $ID = $_SESSION['User']['ID'];
        $stmt = $dbh->prepare(
            "SELECT c.*, u.First_name AS 'Admin_name' FROM content c
                INNER JOIN users u ON u.ID = c.User_id
                    WHERE c.User_id = ?"
        );
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
} else {
    echo $_SESSION['User'] ? "" : "403";
}

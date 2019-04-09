<?php

session_start();

require 'connection.php';

switch ($_GET['section']) {
    case 'landing':
        if (isset($_POST['landing_subtitle'])) {
            $landing_subtitle = !empty($_POST['landing_subtitle']) ? $_POST['landing_subtitle'] : false;
            if ($landing_subtitle) {
                $stmt = $dbh->prepare("UPDATE content SET landing_subtitle = ? WHERE ID = ?");
                $stmt->bindValue(1, $landing_subtitle);
                $stmt->bindValue(2, $_SESSION['User']['ID']);
                echo $stmt->execute() ? "1" : $stmt->errorInfo();
            } else {
                echo "0";
            }
        }
        break;

    case 'about':
        if (isset($_POST['about_description'])) {

            $image_file = !empty($_FILES['about_img']) ? $_FILES['about_img'] : false;
            $about_description = $_POST['about_description'];
            $social_media_links = json_encode(array(
                "Facebook" => $_POST['facebook'],
                "Instagram" => $_POST['instagram'],
                "Whatsapp" => $_POST['whatsapp']
            ));


            if ($image_file) {
                $about_img = file_get_contents($image_file['tmp_name']);
                $about_img_name_type = json_encode(array(
                    "About_img" => array(
                        "Name" => $image_file['name'],
                        "Type" => $image_file['size']
                    )
                ));

                $query =
                    "UPDATE content SET about_img_name_type = ?, about_description = ?, social_media_links = ?, about_img = ? WHERE ID = ?";

                $stmt = $dbh->prepare($query);
                $stmt->bindValue(1, $about_img_name_type);
                $stmt->bindValue(2, $about_description);
                $stmt->bindValue(3, $social_media_links);
                $stmt->bindValue(4, $about_img);
                $stmt->bindValue(5, $_SESSION['User']['ID']);
                echo $stmt->execute() ? "01" : $stmt->errorInfo();
            } else {
                $query =
                    "UPDATE content SET about_description = ?, social_media_links = ? WHERE ID = ?";

                $stmt = $dbh->prepare($query);
                $stmt->bindValue(1, $about_description);
                $stmt->bindValue(2, $social_media_links);
                $stmt->bindValue(3, $_SESSION['User']['ID']);
                echo $stmt->execute() ? "1" : $stmt->errorInfo();
            }
        }
        break;

    case 'services':
        if (isset($_POST['services'])) {
            $services = json_encode($_POST['services']);

            $stmt = $dbh->prepare("UPDATE content SET services_description = ?");
            $stmt->bindValue(1, $services);
            echo $stmt->execute() ? "1" : $stmt->errorInfo();
        }
        break;
        /* Porfolio Section */
    case 'portfolio':
        if (isset($_POST)) {

            $first_port_title = !empty($_POST['first_port_title']) ? $_POST['first_port_title'] : false;
            $second_port_title = !empty($_POST['second_port_title']) ? $_POST['second_port_title'] : false;
            $third_port_title = !empty($_POST['third_port_title']) ? $_POST['third_port_title'] : false;

            /* Return */
            /* Packed titles */
            $portfolio_titles = json_encode(array(
                "F_title" => $first_port_title,
                "S_title" => $second_port_title,
                "T_title" => $third_port_title
            ));

            $first_port_subtitle = !empty($_POST['first_port_subtitle']) ? $_POST['first_port_subtitle'] : false;
            $sec_port_subtitle = !empty($_POST['sec_port_subtitle']) ? $_POST['sec_port_subtitle'] : false;
            $third_port_subtitle = !empty($_POST['third_port_subtitle']) ? $_POST['third_port_subtitle'] : false;

            /* Return */
            /* Packed subtitles */
            $portfolio_subtitles = json_encode(array(
                "F_sub" => $first_port_subtitle,
                "S_sub" => $sec_port_subtitle,
                "T_sub" => $third_port_subtitle,
            ));

            $first_port_description = !empty($_POST['first_port_description']) ? $_POST['first_port_description'] : false;
            $sec_port_description = !empty($_POST['sec_port_description']) ? $_POST['sec_port_description'] : false;
            $third_port_description = !empty($_POST['third_port_description']) ? $_POST['third_port_description'] : false;


            /* Packed descriptions */
            $portfolio_descriptions = json_encode(array(
                "F_des" => $first_port_description,
                "S_des" => $sec_port_description,
                "T_des" => $third_port_description,
            ));

            $first_port_link = !empty($_POST['first_port_link']) ? $_POST['first_port_link'] : false;
            $sec_port_link = !empty($_POST['sec_port_link']) ? $_POST['sec_port_link'] : false;
            $third_port_link = !empty($_POST['third_port_link']) ? $_POST['third_port_link'] : false;

            /* Packed links */
            $portfolio_links = json_encode(array(
                "F_link" => $first_port_link,
                "S_link" => $sec_port_link,
                "T_link" => $third_port_link,
            ));

            /* $portfolio_file_image_1 = !empty($_FILES['portfolio_image_1']) ? $_FILES['portfolio_image_1'] : false;
            $portfolio_file_image_2 = !empty($_FILES['portfolio_image_2']) ? $_FILES['portfolio_image_2'] : false;
            $portfolio_file_image_3 = !empty($_FILES['portfolio_image_3']) ? $_FILES['portfolio_image_3'] : false; */

            /* if ($portfolio_file_image_1) {
                echo "True";
            } else {
                echo "False";
            } */

            /* $portfolio_file_image_1 ? $portfolio_image_1 = file_get_contents($portfolio_file_image_1['tmp_name']) : false;
            $portfolio_file_image_2 ? $portfolio_image_2 = file_get_contents($portfolio_file_image_2['tmp_name']) : false;
            $portfolio_file_image_3 ? $portfolio_image_3 = file_get_contents($portfolio_file_image_3['tmp_name']) : false; */

            $query = "UPDATE content SET portfolio_titles = ?, portfolio_subtitles = ?, portfolio_descriptions = ?, portfolio_links = ?  ";

            /* $query .= $portfolio_image_1 ? ",portfolio_image_1 = :img_1 " : "";
            $query .= $portfolio_image_2 ? ",portfolio_image_2 = :img_2 " : "";
            $query .= $portfolio_image_3 ? ",portfolio_image_3 = :img_3 " : "";

            $query .= $portfolio_image_1 ? ",portfolio_image_type_1 = :img_type_1 " : "";
            $query .= $portfolio_image_2 ? ",portfolio_image_type_2 = :img_type_2 " : "";
            $query .= $portfolio_image_3 ? ",portfolio_image_type_3 = :img_type_3 " : "";
 */
            $query .= "WHERE ID = 1;";
            echo $query;
            $stmt = $dbh->prepare($query);

            $stmt->bindValue(1, $portfolio_titles);
            $stmt->bindValue(2, $portfolio_subtitles);
            $stmt->bindValue(3, $portfolio_descriptions);
            $stmt->bindValue(4, $portfolio_links);

            /* strpos($query, "portfolio_image_1") ? $stmt->bindValue(":img_1", $portfolio_image_1) : "";

            strpos($query, "portfolio_image_2") ? $stmt->bindValue(":img_2", $portfolio_image_2) : "";

            strpos($query, "portfolio_image_3") ? $stmt->bindValue(":img_3", $portfolio_image_3) : ""; */

            /* if (strpos($query, "portfolio_image_1")) {
                echo "Strpos return true";
            } else {
                echo "Strpos return false";
            } */
            /* if (strpos($query, "portfolio_image_type_1")) {
                $portfolio_image_type_1 = json_encode(array(
                    "Name" => $portfolio_file_image_1['name'],
                    "Type" => $portfolio_file_image_1['type']
                ));

                $stmt->bindValue(":img_type_1", $portfolio_image_type_1);
            } else {
                echo "Return false 1";
            } */
            /* if (strpos($query, "portfolio_image_type_2")) {
                $portfolio_image_type_2 = json_encode(array(
                    "Name" => $portfolio_file_image_2['name'],
                    "Type" => $portfolio_file_image_2['type']
                ));

                $stmt->bindValue(":img_type_2", $portfolio_image_type_2);
            } else {
                echo "Return false 2";
            } */
            /* if (strpos($query, "portfolio_image_type_3")) {
                $portfolio_image_type_3 = json_encode(array(
                    "Name" => $portfolio_file_image_3['name'],
                    "Type" => $portfolio_file_image_3['type']
                ));

                $stmt->bindValue(":img_type_3", $portfolio_image_type_3);
            } else {
                echo "Return false 3";
            } */

            echo $stmt->execute() ? "Success" : "Error: " . $stmt->errorInfo();

            /* echo $stmt->execute() ? (strpos($query, 'portfolio_image') ? "01" : "1") : "0"; */
        }
        break;
    default:
        echo "Default option";
        break;
}

<?php

/* In this file the data that will be updated in the Data Base is received */

/* Hize uso del condicional switch, Para que dependiendo de lo que llegue mediante 
    el metodo GET y se actualize solo por la seccion modificada */

session_start();

require 'connection.php';

if (isset($_SESSION['User'])) {

    switch ($_GET['section']) {

            /* Landing Section */
        case 'landing':

            if (isset($_POST['landing_section']) && $_POST['landing_section']) {

                $array_errors_landing = array();

                $landing_subtitle = !empty($_POST['landing_section']['landing_subtitle']) ? $_POST['landing_section']['landing_subtitle'] : $array_errors_landing['landing_subtitle'] = false;

                if (!in_array(false, $array_errors_landing)) {

                    $stmt = $dbh->prepare("UPDATE content SET landing_subtitle = ? WHERE ID = ?");

                    $stmt->bindValue(1, $landing_subtitle);
                    $stmt->bindValue(2, $_SESSION['User']['ID']);

                    echo $stmt->execute()
                        ? json_encode(array(

                            "Status" => true,
                            "Message" => "¡La seccion 'Inicio' fue actualizada con exito!"

                        ))
                        : $stmt->errorInfo();
                } else {

                    echo json_encode(array(

                        "Status" => false,
                        "Message" => "La seccion 'Inicio' no puede contener casillas vacias"

                    ));
                }
            }

            break;

            /* About Section */
        case 'about':

            if (isset($_POST['about_submit']) && $_POST['about_submit']) {

                $array_errors_about = array();

                $about_image_content_1 = !empty($_FILES['about_image_content_1']) ? $_FILES['about_image_content_1'] : $array_errors_about['about_image_content_1'] = false;

                $about_description = !empty($_POST['about_description']) ? $_POST['about_description'] : $array_errors_about['about_description'] = false;

                if ($_POST['facebook'] && $_POST['instagram'] && $_POST['whatsapp']) {

                    $social_media_links = json_encode(array(
                        "Facebook" => $_POST['facebook'],
                        "Instagram" => $_POST['instagram'],
                        "Whatsapp" => $_POST['whatsapp']
                    ));
                } else {

                    $array_errors_about['social_media_links'] = false;
                }

                if ($about_image_content_1) {

                    if (!in_array(false, $array_errors_about)) {

                        $about_image_file_1 = file_get_contents($about_image_content_1['tmp_name']);

                        $about_image_type_1 = json_encode(array(
                            "Name" => $about_image_content_1['name'],
                            "Type" => $about_image_content_1['size']
                        ));

                        $query =
                            "UPDATE content SET about_description = ?, social_media_links = ?, about_image_type_1 = ?, about_image_file_1 = ? WHERE ID = ?";

                        $stmt = $dbh->prepare($query);

                        $stmt->bindValue(1, $about_description);
                        $stmt->bindValue(2, $social_media_links);
                        $stmt->bindValue(3, $about_image_type_1);
                        $stmt->bindValue(4, $about_image_file_1);
                        $stmt->bindValue(5, $_SESSION['User']['ID']);

                        echo $stmt->execute()
                            ? json_encode(array(

                                "Status" => true,
                                "Message" => "¡La seccion 'Acerca de' fue actualizada con exito!"

                            ))
                            : json_encode(array(


                                "Status" => false,
                                "Message" => "La seccion 'Acerca de' no puede contener casillas vacias."

                            ));
                    }
                } else if ($about_description && $social_media_links) {

                    $query =
                        "UPDATE content SET about_description = ?, social_media_links = ? WHERE ID = ?";

                    $stmt = $dbh->prepare($query);

                    $stmt->bindValue(1, $about_description);
                    $stmt->bindValue(2, $social_media_links);
                    $stmt->bindValue(3, $_SESSION['User']['ID']);

                    echo $stmt->execute()
                        ? json_encode(array(

                            "Status" => true,
                            "Message" => "¡La seccion 'Acerca de' fue actualizada con exito!"

                        ))
                        : json_encode(array(


                            "Status" => false,
                            "Message" => "La seccion 'Acerca de' no puede contener casillas vacias."

                        ));
                }
            }

            break;

            /* Service Section */
        case 'services':

            if (isset($_POST['services_submit']) && $_POST['services_submit']) {

                $array_errors_services = array();

                $_POST['services'] ? $services = $_POST['services'] : $array_errors_services['services'] = false;

                $services_json = json_encode(array(
                    "F_description" => $services['Contabilidad'],
                    "S_description" => $services['Administracion'],
                    "T_description" => $services['Reclutamiento']
                ));

                if (!in_array(false, $array_errors_services)) {

                    $stmt = $dbh->prepare("UPDATE content SET services_description = ?");
                    $stmt->bindValue(1, $services_json);

                    echo $stmt->execute()
                        ? json_encode(array(

                            "Status" => true,
                            "Message" => "¡La seccion 'Servicios' fue actualizada con exito!"

                        ))
                        : son_encode(array(


                            "Status" => false,
                            "Message" => "La seccion 'Servicios' no puede contener casillas vacias."

                        ));
                }
            }

            break;

            /* Porfolio Section */
        case 'portfolio':
            if (isset($_POST['portfolio_submit']) && $_POST['portfolio_submit']) {

                $array_errors_portfolio = array();

                $first_portfolio_title = !empty($_POST['first_portfolio_title']) ? $_POST['first_portfolio_title'] : $array_errors_portfolio['first_portfolio_title'] = false;
                $second_portfolio_title = !empty($_POST['second_portfolio_title']) ? $_POST['second_portfolio_title'] : $array_errors_portfolio['second_portfolio_title'] = false;
                $third_portfolio_title = !empty($_POST['third_portfolio_title']) ? $_POST['third_portfolio_title'] : $array_errors_portfolio['third_portfolio_title'] = false;

                if ($first_portfolio_title && $second_portfolio_title && $third_portfolio_title) {

                    /* Packed titles */
                    $portfolio_titles = json_encode(array(
                        "F_title" => $first_portfolio_title,
                        "S_title" => $second_portfolio_title,
                        "T_title" => $third_portfolio_title
                    ));
                }

                $first_portfolio_subtitle = !empty($_POST['first_portfolio_subtitle']) ? $_POST['first_portfolio_subtitle'] : false;
                $second_portfolio_subtitle = !empty($_POST['second_portfolio_subtitle']) ? $_POST['second_portfolio_subtitle'] : false;
                $third_portfolio_subtitle = !empty($_POST['third_portfolio_subtitle']) ? $_POST['third_portfolio_subtitle'] : false;

                if ($first_portfolio_subtitle && $second_portfolio_subtitle && $third_portfolio_subtitle) {

                    /* Packed subtitles */
                    $portfolio_subtitles = json_encode(array(
                        "F_subtitle" => $first_portfolio_subtitle,
                        "S_subtitle" => $second_portfolio_subtitle,
                        "T_subtitle" => $third_portfolio_subtitle
                    ));
                }

                $first_portfolio_description = !empty($_POST['first_portfolio_description']) ? $_POST['first_portfolio_description'] : false;
                $second_portfolio_description = !empty($_POST['second_portfolio_description']) ? $_POST['second_portfolio_description'] : false;
                $third_portfolio_description = !empty($_POST['third_portfolio_description']) ? $_POST['third_portfolio_description'] : false;

                if ($first_portfolio_description && $second_portfolio_description && $third_portfolio_description) {

                    /* Packed descriptions */
                    $portfolio_descriptions = json_encode(array(
                        "F_description" => $first_portfolio_description,
                        "S_description" => $second_portfolio_description,
                        "T_description" => $third_portfolio_description,
                    ));
                }

                $first_portfolio_link = !empty($_POST['first_portfolio_link']) ? $_POST['first_portfolio_link'] : false;
                $second_portfolio_link = !empty($_POST['second_portfolio_link']) ? $_POST['second_portfolio_link'] : false;
                $third_portfolio_link = !empty($_POST['third_portfolio_link']) ? $_POST['third_portfolio_link'] : false;

                if ($first_portfolio_link && $second_portfolio_link && $third_portfolio_link) {

                    /* Packed links */
                    $portfolio_links = json_encode(array(
                        "F_link" => $first_portfolio_link,
                        "S_link" => $second_portfolio_link,
                        "T_link" => $third_portfolio_link,
                    ));
                }

                $portfolio_image_content_1 = !empty($_FILES['portfolio_image_content_1']) ? $_FILES['portfolio_image_content_1'] : false;
                $portfolio_image_content_2 = !empty($_FILES['portfolio_image_content_2']) ? $_FILES['portfolio_image_content_2'] : false;
                $portfolio_image_content_3 = !empty($_FILES['portfolio_image_content_3']) ? $_FILES['portfolio_image_content_3'] : false;

                $query = "UPDATE content SET `portfolio_titles` = :portfolio_titles, `portfolio_subtitles` = :portfolio_subtitles, `portfolio_descriptions` = :portfolio_descriptions, `portfolio_links` = :portfolio_links";

                $portfolio_image_content_1 ? $portfolio_image_file_1 = file_get_contents($portfolio_image_content_1['tmp_name']) : false;
                $portfolio_image_content_2 ? $portfolio_image_file_2 = file_get_contents($portfolio_image_content_2['tmp_name']) : false;
                $portfolio_image_content_3 ? $portfolio_image_file_3 = file_get_contents($portfolio_image_content_3['tmp_name']) : false;

                $query .= $portfolio_image_content_1 ? ", `portfolio_image_type_1` = :portfolio_image_type_1 " : "";
                $query .= $portfolio_image_content_2 ? ", `portfolio_image_type_2` = :portfolio_image_type_2 " : "";
                $query .= $portfolio_image_content_3 ? ", `portfolio_image_type_3` = :portfolio_image_type_3 " : "";

                $query .= $portfolio_image_content_1 ? ", `portfolio_image_file_1` = :portfolio_image_file_1 " : "";
                $query .= $portfolio_image_content_2 ? ", `portfolio_image_file_2` = :portfolio_image_file_2 " : "";
                $query .= $portfolio_image_content_3 ? ", `portfolio_image_file_3` = :portfolio_image_file_3 " : "";


                $query .= " WHERE ID = 1;";

                /* echo $query;
                die(); */

                $stmt = $dbh->prepare($query);

                $stmt->bindValue(":portfolio_titles", $portfolio_titles);
                $stmt->bindValue(":portfolio_subtitles", $portfolio_subtitles);
                $stmt->bindValue(":portfolio_descriptions", $portfolio_descriptions);
                $stmt->bindValue(":portfolio_links", $portfolio_links);

                strpos($query, "portfolio_image_file_1") ? $stmt->bindValue(":portfolio_image_file_1", $portfolio_image_file_1) : "";

                strpos($query, "portfolio_image_file_2") ? $stmt->bindValue(":portfolio_image_file_2", $portfolio_image_file_2) : "";

                strpos($query, "portfolio_image_file_3") ? $stmt->bindValue(":portfolio_image_file_3", $portfolio_image_file_3) : "";

                if (strpos($query, "portfolio_image_type_1")) {

                    $portfolio_image_type_1 = json_encode(array(
                        "Name" => $portfolio_file_image_1['name'],
                        "Type" => $portfolio_file_image_1['type']
                    ));

                    $stmt->bindValue(":portfolio_image_type_1", $portfolio_image_type_1);
                }

                if (strpos($query, "portfolio_image_type_2")) {

                    $portfolio_image_type_2 = json_encode(array(
                        "Name" => $portfolio_file_image_2['name'],
                        "Type" => $portfolio_file_image_2['type']
                    ));

                    $stmt->bindValue(":portfolio_image_type_2", $portfolio_image_type_2);
                }

                if (strpos($query, "portfolio_image_type_3")) {

                    $portfolio_image_type_3 = json_encode(array(
                        "Name" => $portfolio_file_image_3['name'],
                        "Type" => $portfolio_file_image_3['type']
                    ));

                    $stmt->bindValue(":portfolio_image_type_3", $portfolio_image_type_3);
                }

                echo $stmt->execute()
                    ? json_encode(array(

                        "Status" => true,
                        "Message" => "¡La seccion 'Portafolio' fue actualizada con exito!"

                    ))
                    : json_encode(array(


                        "Status" => false,
                        "Message" => "La seccion 'Portafolio' no puede contener casillas vacias."

                    ));
            }

            break;
    }
}

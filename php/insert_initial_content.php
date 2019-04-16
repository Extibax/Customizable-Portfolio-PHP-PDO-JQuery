<?php

/* Con este archivo se inserta el contenido inicial para que la pagina no este vacia en sus inicios */

session_start();

require 'connection.php';

if (isset($_SESSION['User'])) {

    if (isset($_POST['submit'])) {

        $about_image_1 = $_FILES['about_image_1'];

        $portfolio_image_1 = $_FILES['portfolio_image_1'];

        $portfolio_image_2 = $_FILES['portfolio_image_2'];

        $portfolio_image_3 = $_FILES['portfolio_image_3'];

        $user_id = $_SESSION['User']['ID'];

        $content = array(
            $landing_subtitle = "Contabilidad | Administracion | Reclutamiento",

            $about_description = '<p>Somos un equipo de profesionales, nuestro objetivo primordial es brindar "una solucion integral" de calidad que optimice la eficiencia y productividad de tu negocio, ofreciendo servicios en manejo de Talento Humano, Outsourcing de planilla, Contabilidad administrativa, Contabilidad Financiera, Contabilidad Tributariaentre otros que nos convierten en un verdadero centro de operaciones empresariales.&nbsp;</p><p><br></p><p>Ponemos a disposicion todos estos servicios, producto de nuestro compromiso, seriedad, confidencialidad, creatividad y trabajo en equipo&nbsp;</p><p><br></p><p><strong>Horario de atencion:</strong> De Lunes a Sabado: 8:00 AM hasta 5:00 PM</p>',

            $social_media_links = json_encode(array(
                "Facebook" => "https://www.facebook.com/",
                "Instagram" => "https://www.instagram.com/",
                "Whatsapp" => "https://www.whatsapp.com/"
            )),

            $services_description = json_encode(array(
                "F_description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum dolor sit amet consectetur adipisicing elit.",
                "S_description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum dolor sit amet consectetur adipisicing elit.",
                "T_description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum dolor sit amet consectetur adipisicing elit."
            )),

            $portfolio_titles = json_encode(array(
                "F_title" => "Contabilidad",
                "S_title" => "Administracion",
                "T_title" => "Reclutamiento"
            )),

            $portfolio_subtitles = json_encode(array(
                "F_subtitle" => "Smartmatic",
                "S_subtitle" => "OMNI.PRO",
                "T_subtitle" => "Rootstack"
            )),

            $portfolio_descriptions = json_encode(array(
                "F_description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit.",
                "S_description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit.",
                "T_description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit."
            )),

            $portfolio_links = json_encode(array(
                "F_link" => "https://www.smartmatic.com/",
                "S_link" => "https://omni.pro/",
                "T_link" => "https://www.rootstack.com/es"
            )),

            $about_image_type_1 = json_encode(array(
                "Name" => $about_image_1['name'],
                "Type" => $about_image_1['type']
            )),

            $portfolio_image_type_1 = json_encode(array(
                "Name" => $portfolio_image_1['name'],
                "Type" => $portfolio_image_1['type']
            )),

            $portfolio_image_type_2 = json_encode(array(
                "Name" => $portfolio_image_2['name'],
                "Type" => $portfolio_image_2['type']
            )),

            $portfolio_image_type_3 = json_encode(array(
                "Name" => $portfolio_image_3['name'],
                "Type" => $portfolio_image_3['type']
            )),

            $about_image_file_1 = file_get_contents($about_image_1['tmp_name']),

            $portoflio_image_file_1 = file_get_contents($portfolio_image_1['tmp_name']),

            $portoflio_image_file_2 = file_get_contents($portfolio_image_2['tmp_name']),

            $portoflio_image_file_3 = file_get_contents($portfolio_image_3['tmp_name'])
        );

        /* Return question marks equivalent to length of array data */
        $question_marks = array_map(function () {
            return ", ?";
        }, $content);

        /* Return the question marks reduced to a single string line */
        $question_marks_reduced = ltrim(array_reduce($question_marks, function ($a, $b) {
            return $a . " " . $b;
        }), " ,");

        /* Here the single string line is added to the prepared statement */
        $stmt = $dbh->prepare("INSERT INTO content VALUES ( null, $user_id, $question_marks_reduced )");

        /* And here the array values is bind to the columns */
        array_map(function ($cont, $index) use ($stmt) {
            $stmt->bindValue($index + 1, $cont);
        }, $content, array_keys($content));

        /* After, All this is executed */
        echo $stmt->execute() ? 'Success' : 'Error: ' . $stmt->errorInfo();
    }
} else {
    header("Location: ../views/login.html");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Insert Content</title>
</head>

<body>
    <form method="POST" enctype="multipart/form-data">
        <p>
            <label>About image 1</label>
            <input type="file" name="about_image_1">
        </p>
        <p>
            <label>Portfolio image 1</label>
            <input type="file" name="portfolio_image_1">
        </p>
        <p>
            <label>Portfolio image 2</label>
            <input type="file" name="portfolio_image_2">
        </p>
        <p>
            <label>Portfolio image 3</label>
            <input type="file" name="portfolio_image_3">
        </p>

        <input type="submit" name="submit" value="Upload">
    </form>
</body>

</html>
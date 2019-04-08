<?php

if (isset($_POST['submit'])) {

    try {
        $img_1 = $_FILES['img_1'];
        $img_2 = $_FILES['img_2'];
        $img_3 = $_FILES['img_3'];

        $variables = array(
            $landing_subtitle = "Contabilidad | Administracion | Reclutamiento",
            $about_description = "Somos un equipo de profesionales, nuestro objetivo primordial es brindar \"una solucion integral\" de calidad que optimice la eficiencia y productividad de tu negocio, freciendo servicios en manejo de talento Humano, Outsourcing de planilla, Contabilidad administrativa, Contabilidad Financiera, Contabilidad Tributaria entre otros que nos convierten en un verdadero centro de operaciones empresariales.<br><br>Ponemos a disposicion todos estos servicios, producto de nuestro compromiso, seriedad, confidencialidad, creatividad y trabajo en equipo",
            $social_media_links = json_encode(array(
                "Facebook" => "facebook.com",
                "Instagram" => "instagram.com",
                "Whatsapp" => "whatsapp.com"
            )),
            $services_description = json_encode(array(
                "Contabilidad" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit.",
                "Administracion" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit.",
                "Reclutamiento" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit."
            )),
            $portfolio_titles = json_encode(array(
                "F_title" => "Contabilidad",
                "S_title" => "Outsourcing",
                "T_title" => "Manejo de talento Humano"
            )),
            $portfolio_subtitles = json_encode(array(
                "F_sub" => "Smartmatic",
                "S_sub" => "OMNI PRO",
                "T_sub" => "Rootstack"
            )),
            $portfolio_descriptions = json_encode(array(
                "F_desc" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit.",
                "S_desc" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit.",
                "T_desc" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit."
            )),
            $portfolio_links = json_encode(array(
                "F_link" => "extibax.com",
                "S_link" => "extibax.com",
                "T_link" => "extibax.com"
            )),
            $portfolio_img_name_type = json_encode(array(
                "F_img" => array(
                    "Name" => $img_1['name'],
                    "Type" => $img_1['type']
                ),
                "S_img" => array(
                    "Name" => $img_2['name'],
                    "Type" => $img_2['type']
                ),
                "T_img" => array(
                    "Name" => $img_3['name'],
                    "Type" => $img_3['type']
                )
            )),
            $portfolio_image_1 = file_get_contents($img_1['tmp_name']),
            $portfolio_image_2 = file_get_contents($img_2['tmp_name']),
            $portfolio_image_3 = file_get_contents($img_3['tmp_name'])
        );

        $dbh = new PDO("mysql:host=localhost;dbname=eam_consultores", "root", "");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $stmt = $dbh->prepare("INSERT INTO content VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) WHERE ID = 1");
        $index = 1;
        foreach ($variables as $variable) {
            $stmt->bindValue($index, $variable);
            $index++;
        }
        echo $stmt->execute() ? "Succes" : "Error: " . $stmt->errorInfo();
    } catch (PDOException $e) {
        print "Error: " . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Select the imgs</title>
</head>

<body>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="img_1">
        <!-- <input type="file" name="img_2">
        <input type="file" name="img_3"> -->
        <input type="submit" name="submit" value="Send">
    </form>
    <br><br>
    <?php
    /* $dbh = new PDO("mysql:host=localhost;dbname=eam_consultores", "root", "");
    $stat = $dbh->prepare("SELECT * FROM content");
    $stat->execute();
    while ($result = $stat->fetch()) {
        $image_1 = $result['portfolio_image_1'];
        $image_2 = $result['portfolio_image_2'];
        $image_3 = $result['portfolio_image_3'];
        echo base64_encode($image_1);
        echo '<img src="data:image/png;base64,'.base64_encode($image_1).'">';
        echo '<img src="data:image/png;base64,'.base64_encode($image_2).'">';
        echo '<img src="data:image/png;base64,'.base64_encode($image_3).'">';
    } */
    ?>
</body>

</html>
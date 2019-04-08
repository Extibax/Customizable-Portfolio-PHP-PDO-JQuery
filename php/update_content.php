<?php

/* Update Portfolio Section */
if (isset($_POST['submit']) && isset($_POST['name']) && isset($_POST['type']) && isset($_POST['data'])) {
    
    try {
        $dbh = new PDO("mysql:host=localhost;dbname=ema_consultores", "root", "");
        $name = !empty($_POST['name']) ? $_FILES['file']['name'] : false;
        $type = !empty($_POST['type']) ? $_FILES['file']['type'] : false;
        $data = !empty($_POST['data']) ? file_get_contents($_FILES['file']['tmp_name']) : false;
        
        if ($name && $type && $data) {
            $json_file = array(
                $first_portfolio_img = array(
                    'Name' => $name,
                    'Type' => $type,
                    'Data' => $data
                )
            );
        }

    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br>";
        die();
    }
    
}

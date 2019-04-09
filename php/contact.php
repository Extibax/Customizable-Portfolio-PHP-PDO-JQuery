<?php

if ($_GET['send'] == 'true') {

    echo '<br>Im preparing to save data<br>';

    $dbh = new PDO('mysql:host=localhost;dbname=eam_consultores', 'root', '', [
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ERRMODE_WARNING
    ]);

    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

    
    $data = array(
        "Name" => "Juan Bedoya",
        "Age" => "18",
        "IQ" => "1.000.000"
    );
    
    empty($data) ? function() {
        echo "Empty";
    } : array_walk($data, function($key) {
        echo "<br>$key<br>";
    });


    /* $stmt = $dbh->prepare("INSERT INTO content VALUES ()");
    $stmt->execute() ? 'Success' : 'Error: ' . $stmt->errorInfo(); */
}

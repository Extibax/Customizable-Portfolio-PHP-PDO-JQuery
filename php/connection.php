<?php

if (!isset($_SESSION)) {
  session_start();
}

require dirname(__DIR__) . '/vendor/autoload.php';
$main_path = dirname(__DIR__);

$dotenv = Dotenv\Dotenv::create($main_path);
$dotenv->load();

$HOST = $_ENV['HOST'];
$USER = $_ENV['USER'];
$PASS = $_ENV['PASS'];
$DB = $_ENV['DB'];

try {
  $dbh = new PDO("mysql:host=$HOST;dbname=$DB;charset=utf8", $USER, $PASS, [
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
  ]);

  /* if ($dbh) {
    echo "<br>Connection is OK<br>";
  } else {
    echo "<br>Connection is wrong</br>";
  } */
  
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage() . "<br>";
}

/* $ID = 1;
$landing_subtitle = "Contabilidad | Administracion | Reclutamiento";
$about_description = "Descriptions here";

$query = 'UPDATE content SET `ID` = ?';
$query .= ', `landing_subtitle` = :landing_subtitle';
$query .= ', `about_description` = :about_description';
$query .= ' WHERE ID = 1';
$stmt = $dbh->prepare("UPDATE content SET `ID` = :ID, `landing_subtitle` = :landing_subtitle");
$stmt = $dbh->prepare($query);

$stmt->bindValue(1, $ID);
$stmt->bindValue(':landing_subtitle', $landing_subtitle);
$stmt->bindValue(':about_description', $about_description);

echo $stmt->execute() ? "Success" : $stmt->errorInfo(); */
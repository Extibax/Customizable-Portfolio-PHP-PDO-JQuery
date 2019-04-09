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

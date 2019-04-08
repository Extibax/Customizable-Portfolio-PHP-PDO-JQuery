<?php 

$dbh = new PDO("mysql:host=localhost;dbname=eam_consultores", "root", "");
$stat = $dbh->prepare("SELECT * FROM content");
$stat->execute();
$row = $stat->fetch();
header('Content-Type:image/jpeg');
echo $row['image_1'];
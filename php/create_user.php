<?php

/* Con este archivo se puede crear usuarios, Pero no lo agregue a la vista 
    ya que esta pagina no trata de multiples usuarios */

/* La contraseña al ser ingresada, Sera encriptada con PASSWORD_BCRYPT y con un costo de 8 */

require 'connection.php';

if ($_POST['Email'] && $_POST['Password']) {

    $stmt = $dbh->prepare("INSERT INTO users VALUES (null, ?, ?, ?, ?, null)");

    $stmt->bindValue(1, $_POST['First_name']);
    $stmt->bindValue(2, $_POST['Last_name']);
    $stmt->bindValue(3, $_POST['Email']);
    $secure_password = password_hash($_POST['Password'], PASSWORD_BCRYPT, ['cost' => 8]);
    $stmt->bindValue(4, $secure_password);

    echo $stmt->execute() ? 'Create success' : 'Create error';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create user</title>
</head>
<body>
    
    <form method="POST">
        <input type="text" name="First_name">
        <input type="text" name="Last_name">

        <input type="email" name="Email">
        <input type="text" name="Password">

        <input type="submit" value="Register">
    </form>

</body>
</html>
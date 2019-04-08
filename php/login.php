<?php
/* require_once 'connection.php';
$password = password_hash('sebas20', PASSWORD_BCRYPT, ['cost'=>4]);
$query = "INSERT INTO users VALUES (null, 'Esther', 'Avila', 'esther@gmail.com', '$password', null)";
$result = mysqli_query($connection, $query);
echo $result ? 'Success' : 'Failed'; */

if (isset($_POST['Email']) && isset($_POST['Password'])) {
    require_once 'connection.php';

    $Email = !empty($_POST['Email']) && !is_numeric($_POST['Password']) ? mysqli_real_escape_string($connection, $_POST['Email']) : false;
    $Password = !empty($_POST['Password']) ? mysqli_real_escape_string($connection, $_POST['Password']) : false;

    $query = "SELECT * FROM users WHERE ID = 1 AND Email = '$Email'";
    $result = mysqli_query($connection, $query);

    $User = mysqli_fetch_assoc($result);

    if (password_verify($Password, $User['Password'])) {
        echo '1';
    } else {
        echo '0';
    }

}
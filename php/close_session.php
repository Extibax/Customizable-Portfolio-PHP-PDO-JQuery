<?php

/* En este archivo se verifica si la Sesion usuario esta activa para despues unsetearla */

session_start();

if (isset($_SESSION['User'])) {
    unset($_SESSION['User']);
    echo '1';
    session_destroy();
} else {
    echo '0';
}

?>
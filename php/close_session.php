<?php

/* En este archivo se verifica si la Sesion usuario esta activa para despues unsetearla */

session_start();

if (isset($_SESSION['User'])) {
    unset($_SESSION['User']);
    session_destroy();
    echo '1';
} else {
    echo '0';
}

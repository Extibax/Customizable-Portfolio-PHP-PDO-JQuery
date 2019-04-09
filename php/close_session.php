<?php

session_start();

if (isset($_SESSION['User'])) {
    unset($_SESSION['User']);
    echo '1';
    session_destroy();
} else {
    echo '0';
}

?>
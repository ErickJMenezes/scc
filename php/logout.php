<?php
session_start();
session_destroy();

header('Location: ../paginas/index.php');
?>

<?php
session_start();

$_SESSION['auth'] = 'false';
$_SESSION['id'] = '';

header('Location: ../paginas/index.php');

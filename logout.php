<?php
include './includes/auth.php';
session_destroy();
unset($_SESSION['user']);
header("location: ./index.php");

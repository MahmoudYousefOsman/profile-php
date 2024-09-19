<?php

// close browser

// exipration time => 20 - 24 min

// destroy session
// session_destroy();
// unset($_SESSION['number']);
session_start();
unset($_SESSION['user']);
header('location:login.php');
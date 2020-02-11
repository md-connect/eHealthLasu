<?php
session_start();
unset($_SESSION['auth']);
unset($_SESSION['name']);
unset($_SESSION['username']);
unset($_SESSION['passport']);
unset($_SESSION['role']);
session_destroy();
header("Location: index.php");

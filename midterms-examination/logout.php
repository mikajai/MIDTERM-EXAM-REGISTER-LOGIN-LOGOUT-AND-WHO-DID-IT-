<?php

session_start();
session_unset(); #unset session
session_destroy();
header("Location: login.php"); #redirect to login page
exit;

?>

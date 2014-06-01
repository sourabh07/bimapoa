<?php
session_start();

/* echo $_SESSION['user_type'];
exit(); */
session_destroy();
header("Location: index.php");
?>
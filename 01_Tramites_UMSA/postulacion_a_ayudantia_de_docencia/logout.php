<?php
session_start();
session_destroy();
header("Location: iniciologin.php");
exit();
?>

<?php
session_start();
session_unset();
session_destroy(); //destroy all sessions
header("Location: index.php");
?>
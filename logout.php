<?php
session_start();
unset($_SESSION["user_name"]);
unset($_SESSION["id"]);
header("Location:login");
?>
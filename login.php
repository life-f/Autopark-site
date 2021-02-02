<?php
session_start();
unset($_SESSION["user"]);
include("login.html");
?>
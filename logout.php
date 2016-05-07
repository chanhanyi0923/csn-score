<?php
require_once("model.php");
require_once("log_func.php");

session_start();

clean_session();
unset_cookie("userid");
unset_cookie("passwd");

header("Location: "."login.php");
?>
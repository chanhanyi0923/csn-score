<?php
require_once("model.php");
require_once("log_func.php");
require_once("config.php");

session_start();

$PAGE_NAME = "login.php";

if(isset($_GET["err"])) {
    $err_info = $_GET["err"];
} else if($_SESSION["login"] && isset($_COOKIE["userid"]) && isset($_COOKIE["passwd"])) {
    header("Location: "."index.php");
} else if(isset($_POST["userid"]) && isset($_POST["passwd"])) {
    
    $fh = new fetch_html($GRADE_WEB_URL);
    if($fh -> login("Reg_Stu.ASP", $_POST["userid"], $_POST["passwd"]) ) {

        $_SESSION["login"] = "true";
        
        setcookie("userid", $_POST["userid"], time() + $LOG_COOKIE_TIME);
        setcookie("passwd", $_POST["passwd"], time() + $LOG_COOKIE_TIME);
        
        $fh -> logout();
        unset($fh);
        
        header("Location: "."index.php");
    } else {
        $err_info = $ERR_INFO_LOG_FAIL;
    }
}

require_once("views/login.php");
?>
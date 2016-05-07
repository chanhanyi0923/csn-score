<?php
require_once("model.php");
require_once("simple_html_dom.php");
require_once("config.php");

session_start();

$PAGE_NAME = "index.php";

if( !($_SESSION["login"] && isset($_COOKIE["userid"]) && isset($_COOKIE["passwd"])) ) {
    header("Location: "."login.php?err=0");
}

$fh = new fetch_html($GRADE_WEB_URL);
$fh -> login("Reg_Stu.ASP", $_COOKIE["userid"], $_COOKIE["passwd"]);


if(isset($_GET["mod"])) {
    $main_info = str_get_html($fh -> get_info($_GET["mod"])) -> find("body", 0) -> innertext;

    $main_info = preg_replace_callback("/<([^\/]*?)\s([^<]*?)>/",
        function ($match) {
            $remain_tag = array("colspan", "rowspan", "href");
            $tag = "";
            foreach($remain_tag as $elem)
                if(preg_match('/'.$elem.'=([^\s]*)/', $match[2], $arg))
                    $tag .= " ".$elem." = ".$arg[1];

            if(preg_match("/table/", $match[1]))
                $tag .= " class = 'table table-bordered'";
            return "<".$match[1].$tag.">";
        }, $main_info);
} else {
    $main_info = $MSG_REMIND;
}

//beginning of sidebar
$stu_info_text = str_get_html($fh -> get_info("stu_0.ASP")) -> find("body", 0) -> innertext;
$stu_info_text = strip_tags(substr($stu_info_text, 0, strpos($stu_info_text, "<p")), "<br>");
$stu_info_text .= "<br>";

preg_match_all("/(.*?)：(.*?)<br>/", $stu_info_text, $buf_arr);

$stu_info = NULL;
for($i = 0; $i < count($buf_arr[0]); $i ++) {
    $stu_info[$i][0] = $buf_arr[1][$i];
    $stu_info[$i][1] = $buf_arr[2][$i];
}

/*
 *
 */
$link_str = $fh -> get_info("func/stu_0.js");

preg_match_all("/gLnk\(0, '(.*?)', '(.*?)'\)/", $link_str, $glink);
$sidebar_info = NULL;

$i = 0;
foreach($glink[1] as $elem)
    $sidebar_info[$i ++]["label"] = $elem;
$i = 0;
foreach($glink[2] as $elem)
    $sidebar_info[$i ++]["url"] = $elem;
//ending of sidebar
$fh -> logout();
unset($fh);

require_once("views/index.php");
?>
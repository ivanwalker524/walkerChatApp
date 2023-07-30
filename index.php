<?php
session_start();
error_reporting(E_ALL);
// chdir("files");
$svg = array();
foreach(glob("./files/svgs/*.svg") as $icons){
    $ph=pathinfo($icons);
    $svg[$ph['filename']] = file_get_contents($icons);
}
// if(isset($_GET['logout'])) $signout=$_GET['logout'];
if(isset($_SESSION['user'])){
$myId = $_SESSION['user'] ? $_SESSION['user']['id'] : 0;
//store chat-id in $chatId;
if(isset($_GET['chat-id'])) $chatId = $_GET['chat-id'] ;
}
//store open_nav in $nav;
if(isset($_GET['open_nav'])) $nav = $_GET['open_nav'];
$home = isset($_GET['ref']) ? $_GET['ref'] : "login";
require "./files/header.php";
require "./files/$home.php";
require "./files/footer.php";
?>
    

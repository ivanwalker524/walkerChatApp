<?php

$con = mysqli_connect("localhost", "root", "", "simplechat");
if(!$con){
    echo "Successfully" . mysqli_connect_error();
}
?>
<?php
include "./files/db.php";
if(isset($_POST['login'])){
    $userName = $_POST['uname'];
    $password = $_POST['pswd'];
    $stmt = $con->prepare("SELECT count(*) FROM chat WHERE userName = ?");
    $stmt->bind_param('s',$userName);
    $stmt->execute();
    $stmt->bind_result($userName);
    $dt = $stmt->fetch();
    $stmt->close();
    if(!$dt){
        echo '<script>alert("Invalid Deatails. Please try again."</script>';
    }
    else {
        $_SESSION['user']=$dt;
        header('loction: ?ref=chat');
    }
}
?>
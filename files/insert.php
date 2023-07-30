<?php include "./db.php" ?>
<?php
if (isset($_POST['create'])) {
    $firstName = $_POST['fname'];
    $lastName = $_POST['lname'];
    $userName = $_POST['uname'];
    $password = $_POST['pswd'];
    $hashed = password_hash($password, PASSWORD_DEFAULT);

    $check = "SELECT count(*) FROM chat WHERE userName=?";
    $stmt = $con->prepare($check);
    $stmt->bind_param('s', $userName);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    //if email already exist
    if ($count > 0) {
        echo '<script>alert("user name already associated with another account. Please try with different username.")</script>';
    }

    //if email not exist
    else {
        $random_id = rand(time(),10000000);
        $sql = "INSERT INTO chat(unique_id,firstName,lastName,userName,password) VALUES(??,?,?,?)";
        $stmti = $con->prepare($sql);
        $stmti->bind_param('ssss', $firstName, $lastName, $userName, $hashed);
        $stmti->execute();
        $stmti->close();
        echo '<script> alert("User registration successful")</script>';
        // header('location: ?ref=login');
    }
}
?>
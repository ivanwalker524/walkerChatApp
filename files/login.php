<?php
include "./files/db.php";
if (isset($_POST['login'])) {
    if (isset($_POST['luname']) < 1) echo "UserName is required";
    else if (isset($_POST['lpswd']) < 1) echo "Password is required";
    else {
        $luserName = $_POST['luname'];
        $lpassword = $_POST['lpswd'];
        $check = "SELECT * FROM chat WHERE userName = '$luserName'";
        $query = mysqli_query($con, $check) or die($con->error);
        if ($query->num_rows == 0) {
            echo '<script>alert("username not exist")</script>';
        } else {
            $verify = $query->fetch_assoc();
            if (password_verify($lpassword, $verify['password'])) {
                $status = "Active now";
                $statusCheck = $con->query("UPDATE chat SET status = '{$status}' WHERE id = {$verify['id']}") or die($con->error);
                if ($statusCheck) {
                    $_SESSION['user'] = $verify; 
                    ?>
                    <script>
                        window.location.href = '?ref=chat';
                    </script>
                    <?php
                }
            } else {
                echo '<script>alert("Wrong password")</script>';
            }
        }
    }
}
?>
<div class="mx-wd auto">
    <div class="container">
        <form method="post" class="form_handle">
            <div class="header">
                <h1>Chat App</h1>
                <h2>User LogIn</h2>
            </div>
            <div class="input-control">
                <label for="">User name</label>
                <input type="text" placeholder="Enter user name" name="luname">
                <div class="error"></div>
            </div>
            <div class="input-control">
                <label for="password">Password</label>
                <input type="password" placeholder="Enter password" name="lpswd">
                <div class="error"></div>
            </div>
            <div class="btn">
                <input type="submit" value="Login to continue" name="login">
                <p>Dont have an account? <a href="?ref=create">Create</a></p>
            </div>
        </form>
    </div>
</div>
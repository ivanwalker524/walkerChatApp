<?php
include "./files/db.php";
if (isset($_SESSION['user'])) {
    $logout_id = mysqli_real_escape_string($con, $_GET['logout_id']);
    // print_r($logout_id);
    if (isset($_GET[$logout_id])) {
        $status = "Offline now";
        $statusLogout = $con->query("UPDATE chat set status = '{$status}' WHERE id = {$logout_id}") or die($con->error);
        if ($statusLogout) {
            session_unset();
            session_destroy();
?>
            <script>
                window.location.href = "?ref=login";
            </script>
        <?php
        } else {
        ?>
            <script>
                window.location.href = "?ref=chat";
            </script>
    <?php
        }
    }
} else {
    ?>
    <script>
        window.location.href = "?ref=create";
    </script>
<?php
}

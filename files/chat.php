<?php
require "./files/db.php";
$fname = $_SESSION['user']['firstName'];
$lname = $_SESSION['user']['lastName'];
$user_id = $_SESSION['user']['id'];
$image = $_SESSION['user']['image'];
// print_r($_SESSION);
?>
<?php
if (isset($_POST['update'])) {
    $upfName = $_POST['upfName'];
    $uplName = $_POST['uplName'];
    unset($fname);
    unset($lname);
    $fname = $upfName;
    $lname = $uplName;
    $upId = $_POST['upId'];

    if (isset($_FILES['file'])) {
        $file = $_FILES['file'];
        $file_tmp = $file['tmp_name'];
        $file_name = $file['name'];
        move_uploaded_file($file_tmp, "./files/uploads/$file_name");
        $imageUpdate = $con->query("UPDATE chat SET image= '$file_name' WHERE id = '$upId'") or die($con->error);
    }

    // print_r($_FILES);

    $updateSql = $con->query("UPDATE chat SET firstName = '$upfName',lastName = '$uplName' WHERE id = '$upId'") or die($con->error);
}
?>
<div class="mx-wd auto">
    <div class="container">
        <div class="user-box">
            <div class="u-profile">
                <div class="left">
                    <div class="img">
                        <img src="./files/uploads/<?= $_SESSION['user']['image'] ?>" alt="">
                    </div>
                    <div class="status">
                        <p style="font-size: 18px;"><?= $fname . " " . $lname ?></p>
                        <div>
                            <p>Active</p>
                        </div>
                    </div>
                </div>
                <div class="flex-cl">
                    <div class="ic-flex">
                        <a class="ic-flex" href="?nav=nav" id="nav_btn">
                            <span class="icons"><?= $svg['ellipsis'] ?></span>
                        </a>
                    </div>
                    <div class="absolute" id="nav_show">
                        <div class="profile_update">
                            <div class="ic-flex p-10">
                                <a href="" class="ic-flex">
                                    <span class="ic-user"><?= $svg['user'] ?></span>
                                </a>
                                <a href="" id="p_btn">Profile</a>
                            </div>
                            <div class="update_profile" id="p_show">
                                <form method="post" action="" enctype="multipart/form-data">
                                    <div class="up_img">
                                        <a href="" class="ic-flex">
                                            <span class="up-icons"><?= $svg['file'] ?></span>
                                            <span style="padding: 0 2px;">select file</span>
                                        </a>
                                        <input type="file" name="file">
                                    </div>
                                    <div class="up-names">
                                        <input type="text" name="upfName" value="<?= $fname ?>">
                                        <input type="text" name="uplName" value="<?= $lname ?>">
                                        <input type="hidden" name="upId" value="<?= $user_id ?>">
                                    </div>
                                    <div class="update">
                                        <input type="submit" name="update" value="Update">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php
                        $lgt = $con->query("SELECT * FROM chat where id= '$user_id'") or die($con->error);
                        $l_row = $lgt->fetch_assoc();
                        ?>
                        <div class="logout">
                            <a href="?ref=logout" class="ic-flex">
                                <span class="icons ic-md"><?= $svg['right-from-bracket'] ?></span>
                            </a>
                            <p><a href="?ref=logout&logout_id=<?=$l_row['id']?>">Logout</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="all-users scroll-y">
                <?php
                $select = $con->query("SELECT id,firstName,lastName,image FROM chat WHERE id !='$myId'") or die($con->error);
                if ($select) {
                    while ($row = $select->fetch_assoc()) { ?>
                        <a href="?ref=startchatting&chat-id=<?= $row['id'] ?>">
                            <div class="c-flex">
                                <div class="flex-grow-1">
                                    <div class="img">
                                        <img src="./files/uploads/<?=$row['image'] ?>" alt="">
                                    </div>
                                    <div class="last-chat">
                                        <p><?= $row['firstName'] . " " . $row['lastName'] ?></p>
                                        <span></span>
                                        <span style="display:none;">No message</span>
                                    </div>
                                </div>
                                <div class="active-offline">
                                    Active
                                </div>
                            </div>
                        </a>


                <?php }
                }
                ?>
            </div>
        </div>

    </div>
</div>
<script>
    function $(el) {
        return document.querySelector(el);
    }
    var nav_btn = $('#nav_btn'),
        nav_show = $('#nav_show');
    nav_btn.addEventListener('click', function(e) {
        e.preventDefault();
        if (nav_show.classList.contains('show')) {
            nav_show.classList.remove('show');
        } else {
            nav_show.classList.add('show')

        }
    });
    var pBtn = $('#p_btn'),
        pShow = $('#p_show');
    pBtn.addEventListener('click', function(e) {
        e.preventDefault();

        if (pShow.classList.contains('show')) {
            pShow.classList.remove('show');
        } else {
            pShow.classList.add('show');
        }

    });
</script>
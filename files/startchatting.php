<?php
include "./files/db.php";
$getChat = $con->query("SELECT id,firstName,lastName,image FROM chat WHERE id = '$chatId'") or die($con->error);
$rowC = $getChat->fetch_assoc();
$fname = $rowC['firstName'];
$lname = $rowC['lastName'];
?>
<div class="mx-wd auto">
    <div class="container">
        <div class="user-box">
            <div class="chat-header">
                <div class="ic-flex">
                    <a class="ic-flex" href="?ref=chat">
                        <span class="icons arrow"><?= $svg['arrow-left'] ?></span>
                    </a>
                </div>

                <div class="chat-user">
                    <div class="left">
                        <div class="img">
                            <img src="./files/uploads/<?=$rowC['image']?>" alt="">
                        </div>
                        <div class="status">
                            <p style="font-size: 18px;"><?= $fname . " " . $lname ?></p>
                            <div>
                                <p></p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="chat-body">
                <?php
                $u_id = $_SESSION['user']['id'];
                $sender = $chatId;
                $output = "";
                $sql = $con->query("SELECT * FROM messages WHERE sender = '$sender' or sender = '$u_id' AND receiver = '$u_id' or receiver = '$sender'") or die($con->error);
                if($sql->num_rows > 0){
                    while ($m_row = $sql->fetch_assoc()) {
                       if($m_row['receiver'] === $sender){
                        $output .='<div class="chat outgoing">
                                        <div class="details">
                                            <p>'.$m_row['message'].'</p>
                                        </div>
                                    </div>';
                       }else{
                        $output.= '<div class="chat incoming">
                                        <div>
                                            <img src="./files/uploads/" alt="">
                                        </div>
                                        <div class="details">
                                            <p>'.$m_row['message'] . '</p>
                                        </div>
                                    </div>';
                       }
                    }
                    echo $output;
                }
                ?>
            </div>
            <div class="chat_inputs">
                <?php
                $sender = $_SESSION['user']['id'];
                if(isset($_POST['send'])){
                    $message = $_POST['message'];
                    $receiver = $_POST['receiver'];
                    $msg = $con->query("INSERT INTO messages(sender,message,receiver) VALUES('$sender','$message','$receiver')") or die($con->error);
                }
                ?>
                <form action="" method="post">
                    <div class="chat_input_control">
                        <input name="message" type="text" placeholder="start chatting.....">
                        <input type="hidden" name="receiver" value="<?= $chatId ?>">
                    </div>
                    <div style="width: 10%;">
                        <div class="send-btn">
                            <input name="send" type="submit" value="">
                            <a href="" class="ic-flex">
                                <span class="btn-ic"><?= $svg['telegram-plane'] ?></span>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
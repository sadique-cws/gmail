<a href="#insert" data-bs-toggle="modal" class="btn btn-outline-danger btn-lg px-5 ms-3 py-2">Compose</a>

<div class="modal fade" id="insert">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">Send Mail</div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <input type="text" name="to" class="form-control" placeholder="To.">
                    </div>
                    <div class="mb-3">
                        <input type="text" name="subject" class="form-control" placeholder="Subject">
                    </div>
                    <div class="mb-3">
                        <input type="file" name="attachment" class="form-control">
                    </div>
                    <div class="mb-3">
                        <textarea name="content" rows="5" class="form-control" placeholder="Write your Mail"></textarea>
                    </div>
                    <div class="mb-3">
                        <input type="submit" name="save" value="Save" class="btn btn-info">
                        <input type="submit" name="send" value="Send" class="btn btn-success float-end">
                    </div>
                </form>

                <?php 
                    if(isset($_POST['send']) || isset($_POST['save'])){
                        $sender_id = $user['id'];
                        //finding reciever id
                        $to = $_POST['to'];
                        $query = mysqli_query($connect,"select * from accounts where email='$to'");
                        $recieve = mysqli_fetch_array($query);
                        
                        $reciever_id  = $recieve['id'];
                        $subject = $_POST['subject'];
                        $content = $_POST['content'];

                        //file work
                        $file = $_FILES['attachment']['name'];
                        $tmp_file = $_FILES['attachment']['tmp_name'];

                        move_uploaded_file($tmp_file,"attachment/$file");
                        
                        $status = 0;

                        if(isset($_POST['save'])){
                            $status = 1;
                        }
                        
                        

                        $sendMail = mysqli_query($connect,"insert into mails (sender_id, title, receiver_id, content,status,attachment) value ('$sender_id','$subject','$reciever_id','$content','$status','$file')");

                        if($sendMail){
                            header("location: index.php");
                            die();
                        }
                    }
                ?>
            </div>

        </div>
    </div>
</div>

<div class="list-group list-group-flush">
    <a href="index.php" class="list-group-item list-group-item-action">Inbox 
        <sup class="badge bg-danger rounded-circle text-white" style="font-size:10px">
            <?php 
            $log = $user['id'];
            $callingInbox = mysqli_query($connect,"select * from mails where receiver_id = '$log' AND status='0'");
            echo $count = mysqli_num_rows($callingInbox);
            ?>
        </sup>
    </a>
    <a href="sent.php" class="list-group-item list-group-item-action">Sent Mail
        <sup class="badge bg-danger rounded-circle text-white" style="font-size:10px">
            <?php 
            $log = $user['id'];
            $callingInbox = mysqli_query($connect,"select * from mails where sender_id = '$log' AND status='0'");
            echo $count = mysqli_num_rows($callingInbox);
            ?>
        </sup>
    </a>
    <a href="draft.php" class="list-group-item list-group-item-action">Draft

    <sup class="badge bg-danger rounded-circle text-white" style="font-size:10px">
            <?php 
            $log = $user['id'];
            $callingInbox = mysqli_query($connect,"select * from mails where sender_id = '$log' AND status='1'");
            echo $count = mysqli_num_rows($callingInbox);
            ?>
        </sup>
    </a>
    <a href="bin.php" class="list-group-item list-group-item-action">Trash 
    <sup class="badge bg-danger rounded-circle text-white" style="font-size:10px">
            <?php 
            $log = $user['id'];
            $callingInbox = mysqli_query($connect,"select * from mails where status='-1'");
            echo $count = mysqli_num_rows($callingInbox);
            ?>
        </sup>
    </a>
    <a href="" class="list-group-item list-group-item-action">Setting</a>
    <a href="logout.php" class="list-group-item list-group-item-action bg-danger text-white">Logout</a>
</div>
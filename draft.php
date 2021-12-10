<?php 
include "dbconnect.php";

if(!isset($_SESSION['user'])){
    header("location: login.php");
    die();
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gmail - Faster, Reliable and Easy</title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <?php include "header.php";?>

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-2 border border-muted border-left-0 border-top-0 border-bottom-0">
                <?php include "side.php";?>
            </div>
            <div class="col-lg-10">
                <h6 class="lead">Draft Mail</h6>
                <table class="table">
                    <?php 
                        $id = $user['id'];
                        $callingMail = mysqli_query($connect,"select * from mails JOIN accounts ON mails.receiver_id = accounts.id where sender_id='$id' AND status='1' ORDER BY mails.m_id DESC");
                        while($row = mysqli_fetch_array($callingMail)){
                    ?>
                   <tr>
                        <td class="text-capitalize"><?= $row['name'];?></td>
                        <td><p class="m-0"><b><a class='text-decoration-none text-primary ' href="view_mail.php?id=<?= $row['m_id'];?>"><?= $row['title'];?></a></b> <?= substr($row['content'],0,80);?>...</p></td> 
                        <td>
                            <span class="small fw-bold"><?= date("D d M Y",strtotime($row['date']));?></span>
                            <span class="small text-muted"><?= date("h:i A",strtotime($row['date']));?></span>

                            <span class="float-end">

                                <?php 
                                if($row['attachment'] != ""){
                                    echo "<i class='bi bi-paperclip'></i>";
                                }
                                ?>
                                <a href="index.php?del_id=<?= $row['m_id'];?>" class=" btn btn-outline-danger btn-sm"><i class='bi bi-trash'></i></a>

                            </span>
                        </td>
                    </tr>
                      <?php } ?>
                </table>
            </div>
        </div>
    </div>
    
    



<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
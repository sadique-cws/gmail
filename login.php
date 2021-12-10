<?php include "dbconnect.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Gmail - Faster, Reliable and Easy</title>
    <!-- CSS only -->
<link   href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body class="bg-success">
    <?php include "header.php";?>
    
    <div class="container mt-5">
        <div class="row">
            <div class="col-4 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h2 class="h4">Login Here</h2>
                        <form action="" method="post">
                            
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            
                            <div class="mb-3">
                                <input type="submit" name="login" class="btn btn-warning w-100">
                            </div>
                            
                            <a href="" class="text-muted small float-start">Forget Password?</a>
                            <a href="create.php" class="text-muted small float-end">SignUp</a>
                        </form>

                        <?php 
                        if(isset($_POST['login'])){
                            $email = $_POST['email'];
                            $password = md5($_POST['password']);

                            $check = mysqli_query($connect, "select * from accounts where email='$email' AND password='$password'");
                            $count = mysqli_num_rows($check);

                            if($count > 0){
                                $_SESSION['user'] = $email;
                                header("location: index.php");
                                die();
                            }
                            else{
                                echo "<script>alert('email and password in incorrect ' ) </script>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>    



<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
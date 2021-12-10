<?php include "dbconnect.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Mail - Gmail - Faster, Reliable and Easy</title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body class="bg-success">
    <?php include "header.php";?>
    
    <div class="container mt-4">
        <div class="row">
            <div class="col-8"></div>
            <div class="col-4">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h2 class="h5">Create an account</h2>
                        <form action="" method="post">
                            <div class="mb-3">
                                <label>Fullname</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>contact</label>
                                <input type="text" name="contact" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Date of Birth</label>
                                <input type="date" name="dob" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Gender</label>
                                <select  name="gender" class="form-select">
                                    <option value="m">Male</option>
                                    <option value="f">Female</option>
                                    <option value="o">Other</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="mb-4">
                                <input type="submit" name="create" class="btn btn-success w-100">
                            </div>
                        </form>    

                        <?php 
                        if(isset($_POST['create'])){
                            $name = $_POST['name'];
                            $contact = $_POST['contact'];
                            $gender = $_POST['gender'];
                            $email = $_POST['email'];
                            $password = md5($_POST['password']);
                            $dob = $_POST['dob'];

                            $query = mysqli_query($connect,"insert into accounts (name,contact,gender,email,password,dob) value ('$name','$contact','$gender','$email','$password','$dob')");

                            if($query){
                                $_SESSION['user'] = $email;
                                echo "<script>window.open('index.php','_self')</script>";
                            }
                            else{
                                echo "<script>alert('failed')</script>";
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
<?php
include "connect.php";
?>
<!doctype html>
<html lang="en">

<head>
    <title>Login 05</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">

            </div>
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">
                    <div class="wrap">
                        <div class="img" style="background-image: url(images/bg-1.jpg);"></div>
                        <div class="login-wrap p-4 p-md-5">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4">Sign Up</h3>
                                </div>

                            </div>
                            <form action="#" method="POST" class="signin-form" enctype="multipart/form-data">
                                <div class="form-group mt-3">
                                    <input type="text" class="form-control" name="name" required>
                                    <label class="form-control-placeholder" for="username">Name</label>
                                </div>
                                <div class="form-group mt-3">
                                    <input type="text" class="form-control" name="address" required>
                                    <label class="form-control-placeholder" for="username">Address</label>
                                </div>

                                <div class="form-group mt-3">
                                    <label for="validationCustom04" class="form-label">District</label>
                                    <select class="form-control" id="dis" onchange="change_panchayath();" name="dis" required>
                                        <option selected disabled value="">Choose...</option>
                                        <?php
                                        $qr =  mysqli_query($con, "select *from district");
                                        while ($r =  mysqli_fetch_array($qr)) {
                                        ?>
                                            <option value=" <?php echo $r['dis_id']; ?>"><?php echo $r['district']; ?></option>
                                        <?php

                                        }
                                        ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid district.
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

                                    <script>
                                        function change_panchayath() {
                                            var district = $("#dis").val();

                                            $.ajax({
                                                type: "POST",
                                                url: "pan.php",
                                                data: "district=" + district,
                                                cache: false,
                                                success: function(response) {
                                                    //alert(response);return false;
                                                    $("#pan").html(response);
                                                }
                                            });

                                        }
                                    </script>
                                    <label for="validationCustom04" class="form-label">Panchayath</label>
                                    <select class="form-control" id="pan" name="pan" required>
                                        <option selected disabled value="">Choose...</option>

                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid panchayath.
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <input type="text" class="form-control" name="phone" required>
                                    <label class="form-control-placeholder" for="username">phone</label>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="formFile" class="form-label">profile pic</label>
                                    <input class="form-control" type="file" name="pics">
                                </div>
                                <div class="form-group mt-3">
                                    <input type="text" class="form-control" name="uname" required>
                                    <label class="form-control-placeholder" for="username">Username</label>
                                </div>
                                <div class="form-group">
                                    <input id="password-field" type="password" class="form-control" name="password" required />
                                    <label class="form-control-placeholder" for="password">Password</label>
                                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>
                                <div class="form-group">
                                    <input id="password-field" type="password" class="form-control" name="password1" required>
                                    <label class="form-control-placeholder" for="password">Confirm Password</label>
                                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="submit" class="form-control btn btn-primary rounded submit px-3">Sign
                                        In</button>
                                </div>
                                <div class="form-group d-md-flex">
                                    <div class="w-50 text-left">
                                        <label class="checkbox-wrap checkbox-primary mb-0">Remember Me
                                            <input type="checkbox" checked>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="w-50 text-md-right">
                                        <a href="#">Forgot Password</a>
                                    </div>
                                </div>
                            </form>
                            <p class="text-center">Not a member? <a href="login.php">Sign In</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>

<?php



if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $dis = $_POST['dis'];
    $pan = $_POST['pan'];
    $phone = $_POST['phone'];
    $uname = $_POST['uname'];
    $pass = $_POST['password'];
    $filename1 = $_FILES["pics"]["name"];
    $tempname1 = $_FILES["pics"]["tmp_name"];
    $folder1 = "./uploadedimg/" . $filename1;

    $sql2 = "select * from login where Username='$uname' ";
    $result = mysqli_query($con, $sql2);
    $count = mysqli_num_rows($result);

    if ($count > 0) {

?>
        <script>
            alert("username alredy in use");
        </script>
        <?php
    } else {
        $sql3 = "select * from usertype where usertype='user' ";
        $result3 = mysqli_query($con, $sql3);
        $row3 = mysqli_fetch_assoc($result3);

        $sql = "insert into login(username,password,Utype_id,status)values('$uname',$pass','$row3[Utype_id]',true)";
        if (mysqli_query($con, $sql)) {

            $result1 = mysqli_query($con, "select * from login where Username='$uname'");
            $row = mysqli_fetch_assoc($result1);
            $sql1 = "INSERT INTO user (log_id,name,address,district,panchayath,phone,pics) VALUES ('$row[log_id]','$name','$address','$dis','$pan','$phone','$filename1')";
            if (mysqli_query($con, $sql1)) {
                move_uploaded_file($tempname1, $folder1);

                if (headers_sent()) {
                    die('<script type="text/javascript">window.location.href="manage.php?e=1"</script>');
                } else {
                    header("location:login.php?e=1");
                    die();
                }
            }
        } else {
        ?>

            <script>
                alert("error");
            </script>
<?php
        }
    }
}
mysqli_close($con);

?>
<?php
include_once 'header.php';
include_once 'sessionHeaderPart2.php';
if (isset($_POST['submit'])) {
    include_once '__db.php';


    $name = $_POST['name'];
    $username = $_POST['username'];
    $emailid = $_POST['emailid'];
    $password = $_POST['password'];


    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "SELECT * FROM user where username='$username'";
    $query = mysqli_query($con, $sql);

    if (mysqli_num_rows($query) == 0) {

        $sql = "INSERT INTO user VALUES (NULL,'$username','$name','$emailid','$hashed_password', 0)";
        $query = mysqli_query($con, $sql);
        if ($query) {
            header('location:signup.php?status=success&message=' . urlencode('Account Created successfully'));
        } else {
            header('location:signup.php?status=danger&message=' . urlencode('Database Problem'));
        }
    } else {
        header('location:signup.php?status=danger&message=' . urlencode('Username Already Exist in Database'));
    }
}
?>



<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>SIGN UP PAGE</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-content-right">
                    <div class="woocommerce">
                        <form onsubmit="return onsubmitFunction();" enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                            <div id="customer_details" class="col2-set">
                                <div class="col-4">
                                    <div class="woocommerce-billing-fields">
                                        <?php include_once 'message.php'; ?>
                                        <h3>Register Account</h3>
                                        <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                            <label class="" for="name">Name * </label>
                                            <input type="text" placeholder="Enter Name" id="name" name="name" class="input-text ">
                                        </p>

                                        <p id="billing_last_name_field" class="form-row form-row-last validate-required">
                                            <label class="" for="username">User Name * </label>
                                            <input type="text" placeholder="Enter User Name" id="username" name="username" class="input-text ">
                                        </p>


                                        <p id="billing_company_field" class="form-row form-row-wide">
                                            <label class="" for="emailid">Email Id * </label>
                                            <input type="text" placeholder="Enter Email Id" id="emailid" name="emailid" class="input-text">
                                        </p>

                                        <p id="billing_company_field" class="form-row form-row-wide">
                                            <label class="" for="password">Password * </label>
                                            <input type="password" placeholder="Enter Email Id" id="password" name="password" class="input-text" style="width: 100%;">
                                        </p>

                                        <p id="billing_company_field" class="form-row form-row-wide">
                                            <label class="" for="confirmPassword">Confirm Password * </label>
                                            <input type="password" placeholder="Enter Email Id" id="confirmPassword" class="input-text" style="width: 100%;">
                                        </p>
                                        <p><button type="submit" name="submit" class="btn-sm btn btn-success"> Register</button></p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End footer top area -->

<?php include_once 'footer.php'; ?>
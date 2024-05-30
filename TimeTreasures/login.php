<?php
include_once 'header.php';
include_once 'sessionHeaderPart2.php';
if (isset($_POST['submit'])) {
    include_once '__db.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user where username='$username'";
    $query = mysqli_query($con, $sql);

    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);

        if (password_verify($password, $row['password'])) {
            $_SESSION = array(
                'id' => $row['id'],
                'username' => $row['username'],
                'name' => $row['name'],
                'email' => $row['email'],
                'userType' => $row['user_type']
            );

            header('location:dashboard.php');
        } else {
            header('location:login.php?status=danger&message=' . urlencode('Invalid Password'));
        }
    } else {
        header('location:login.php?status=danger&message=' . urlencode('Invalid Username'));
    }
}

?>



<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>LOGIN PAGE</h2>
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
                        <form onsubmit="return loginFunction();" enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                            <div id="customer_details" class="col2-set">
                                <div class="col-4">
                                    <div class="woocommerce-billing-fields">
                                        <?php include_once 'message.php'; ?>
                                        <h3>Login</h3>

                                        <p id="billing_last_name_field" class="form-row form-row-last validate-required">
                                            <label class="" for="username">User Name * </label>
                                            <input type="text" value="" placeholder="Enter User Name" id="username" name="username" class="input-text ">
                                        </p>


                                        <p id="billing_company_field" class="form-row form-row-wide">
                                            <label class="" for="password">Password * </label>
                                            <input type="password" value="" placeholder="Enter Email Id" id="password" name="password" class="input-text" style="width: 100%;">
                                        </p>

                                        <p><button type="submit" name="submit" class="btn-sm btn btn-success">lOGIN</button></p>
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
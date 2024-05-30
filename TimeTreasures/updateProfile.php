<?php
include_once 'header.php';
include_once 'sessionHeader.php';
$id = $_SESSION['id'];
if (isset($_POST['submit'])) {
    include_once '__db.php';

    $name = $_POST['name'];
    $email = $_POST['email'];

    $sql = "UPDATE user SET name='$name', email='$email' where id=$id";
    $query = mysqli_query($con, $sql);
    if ($query) {
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;

        header('location:updateProfile.php?status=success&message=' . urlencode('Profile Updated Successfully'));
    } else {
        header('location:updateProfile.php?status=danger&message=' . urlencode('Database Problem'));
    }
}



?>

<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>UPDATE PROFILE</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <?php include_once('sidemenu.php'); ?>
            <div class="col-md-8">
                <div class="woocommerce">
                    <form onsubmit="return updateFunction()" enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                        <div id="customer_details" class="col2-set">
                            <div class="col-4">
                                <div class="woocommerce-billing-fields">
                                    <?php include_once 'message.php'; ?>
                                    <p id="billing_company_field" class="form-row form-row-wide">
                                        <label class="" for="name">Name * </label>
                                        <input type="text" placeholder="Enter Name" id="name" name="name" class="input-text" style="width: 100%;" required="" value="<?= $_SESSION['name'] ?>">
                                    </p>
                                    <p id="billing_company_field" class="form-row form-row-wide">
                                        <label class="" for="emailid">Email * </label>
                                        <input type="email" placeholder="Enter Email" id="emailid" name="email" class="input-text" style="width: 100%;" required="" value="<?= $_SESSION['email'] ?>">
                                    </p>
                                    <p><button type="submit" name="submit" class="btn-sm btn btn-success">Update Profile</button></p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once 'footer.php'; ?>
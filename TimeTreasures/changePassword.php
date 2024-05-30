<?php 
include_once'header.php';
include_once'sessionHeader.php';
$id = $_SESSION['id'];
if(isset($_POST['submit']))
{
    include_once'__db.php';
    
    $oldpassword = $_POST['oldpassword'];
    $newPassword = $_POST['newPassword'];

    $sql = "SELECT * FROM  user where id=$id";
    $query = mysqli_query($con,$sql);

    $row = mysqli_fetch_assoc($query);

    if(password_verify($oldpassword,$row['password'])){
        
        $hashed_password = password_hash($newPassword, PASSWORD_DEFAULT);

        $sql = "UPDATE user SET password='$hashed_password' where id=$id";
        $query = mysqli_query($con,$sql);

        if($query){
             header('location:changePassword.php?status=success&message='.urlencode('Password Changed Successfully'));
         }else{
              header('location:changePassword.php?status=danger&message='.urlencode('Database Problem'));    
         }

    }else{
         header('location:changePassword.php?status=danger&message='.urlencode('Old Password Do not Match'));
    }
    
}



?>
    
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Change Password</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
              <?php include_once('sidemenu.php');?>
                <div class="col-md-8">
                     <div class="woocommerce">
                           <form onsubmit="return changePasswordFunction();" enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'];?>" method="post">
                                <div id="customer_details" class="col2-set">
                                    <div class="col-4">
                                        <div class="woocommerce-billing-fields">
                                        <?php include_once'message.php';?>
                                            <p id="billing_company_field" class="form-row form-row-wide">
                                                <label class="" for="oldPassword">Old Password * </label>
                                                 <input type="password" placeholder="Enter Old Password" id="oldPassword" name="oldpassword" class="input-text" style="width: 100%;" required="">
                                            </p>
                                             <p id="billing_company_field" class="form-row form-row-wide">
                                                <label class="" for="newPassword">New Password * </label>
                                                 <input type="password" placeholder="Enter New Password" id="newPassword" name="newPassword" class="input-text" style="width: 100%;" required="">
                                            </p>
                                            <p id="billing_company_field" class="form-row form-row-wide">
                                                <label class="" for="confirmPassword">Confirm Password * </label>
                                                 <input type="password" placeholder="Enter Confirm Password" id="confirmPassword" name="confirmPassword" class="input-text" style="width: 100%;" required="">
                                            </p>
                                            <p><button type="submit" name="submit" class="btn-sm btn btn-success">Change Password</button></p>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>                    
                </div>
            </div>
        </div>
    </div>
<?php include_once'footer.php';?>
<?php include_once 'header.php';
include_once 'sessionHeader.php';
?>

<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>DASHBOARD</h2>
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
                <div class="product-content-right">
                    <div class="woocommerce">
                        <h2 class="text-warning">Welcome of Dashboard of Time Treasures</h2>
                        <div id="customer_details" class="col2-set">
                            <div class="col-2">
                                <div class="woocommerce-shipping-fields">
                                    <div class="shipping_address" style="display: block;">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td>User Name :</td>
                                                <td> <strong><?= $_SESSION['username'] ?></strong></td>
                                            </tr>

                                            <tr>
                                                <td>Name </td>
                                                <td><strong><?= $_SESSION['name'] ?></strong></td>
                                            </tr>
                                            <tr>
                                                <td>Email </td>
                                                <td> <strong><?= $_SESSION['email'] ?></strong></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once 'footer.php'; ?>
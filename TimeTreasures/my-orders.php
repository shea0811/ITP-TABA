<?php
include_once '__db.php';
include_once 'header.php';
include_once 'sessionHeader.php';

$_SESSION['addToCart'] = [];

?>

<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>MY ORDERS</h2>
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
                    <div id="customer_details" class="col2-set">
                        <div class="col-6">
                            <div class="woocommerce-billing-fields">
                                <?php if (isset($_GET['id'])) : ?>
                                    <div id="show-message-id" class="alert alert-message">
                                        <h3>Thank you for Order</h3>
                                        <h4>Order placed successfully and your <strong>Order number is #<?= $_GET['id'] ?></strong></h4>
                                    </div>
                                <?php endif; ?>


                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sri</th>
                                            <th>Order Id</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Total Amount</th>
                                            <th>Delivery Status</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $id = $_SESSION['id'];
                                        $sql = "SELECT * FROM order_table where user_id=$id ORDER BY created_at DESC";
                                        $query = mysqli_query($con, $sql);
                                        if (mysqli_num_rows($query) > 0) {
                                            $c = 0;
                                            while ($row = mysqli_fetch_assoc($query)) {
                                        ?>
                                                <tr>
                                                    <td><?= ++$c ?></td>
                                                    <td>#<?= $row['id'] ?></td>
                                                    <td><?= $row['name'] ?></td>
                                                    <td><?= $row['email'] ?></td>
                                                    <td><?= $row['address'] ?></td>
                                                    <td><?= $row['total_amount'] ?>$</td>
                                                    <td><?= $row['status'] ? 'Delivered' : 'Pending'; ?></td>
                                                    <td><?= $row['created_at'] ?></td>
                                                    <td><a class="add_to_cart_button" href="show-order-details.php?id=<?= $row['id'] ?>">Show Details</a></td>
                                                </tr>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="9">No Record Found....</td>
                                            </tr>
                                        <?php
                                        }

                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once 'footer.php'; ?>
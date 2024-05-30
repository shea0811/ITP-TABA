<?php
include_once '__db.php';
include_once 'header.php';
include_once 'sessionHeader.php';
$id = $_GET['id'];
?>

<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>ORDER DETAILS OF #<?= $_GET['id'] ?></h2>
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
                        <div class="col-4">
                            <div class="woocommerce-billing-fields">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sri</th>
                                            <th>Category</th>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM watches as w LEFT JOIN order_details as o  ON o.watch_id = w.id where o.order_id=$id ORDER BY o.id ASC";
                                        $query = mysqli_query($con, $sql);
                                        if (mysqli_num_rows($query) > 0) {
                                            $c = 0;
                                            while ($row = mysqli_fetch_assoc($query)) {
                                        ?>
                                                <tr>
                                                    <td><?= ++$c ?></td>
                                                    <td><?= ucwords($row['category']) ?></td>
                                                    <td><?= ucwords($row['name']) ?></td>
                                                    <td><img src="img/uploaded/<?= $row['image'] ?>" class="img-responsive img-thumbnail" width="100"></td>
                                                    <td><?= $row['description'] ?></td>
                                                    <td> € <?= $row['price'] ?></td>
                                                    <td><?= $row['quantity'] ?></td>
                                                    <td><?= $row['price'] * $row['quantity'] ?></td>
                                                </tr>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="6">No Record Found....</td>
                                            </tr>
                                        <?php
                                        }

                                        ?>
                                    </tbody>
                                </table>
                                <a class="add_to_cart_button" href="all-order-details.php?>">Back</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once 'footer.php'; ?>
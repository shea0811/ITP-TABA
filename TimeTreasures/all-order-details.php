<?php
include_once '__db.php';
include_once 'header.php';
include_once 'sessionHeader.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    mysqli_query($con, "UPDATE order_table set status=1 where id=$id");
}



$totalUsers = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(id) as totalUsers from user"))['totalUsers'];
$totalOrders = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(id) as totalOrders from order_table"))['totalOrders'];
$totalIncome = mysqli_fetch_assoc(mysqli_query($con, "SELECT SUM(total_amount) as totalIncome from order_table"))['totalIncome'];
$totalPendingOrders = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(id) as totalPendingOrders from order_table WHERE status=0"))['totalPendingOrders'];
$totalDeliveredOrders = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(id) as totalDeliveredOrders from order_table WHERE status=1"))['totalDeliveredOrders'];

?>

<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>ALL ORDER DETAILS</h2>
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
                                <?php include_once 'message.php'; ?>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <th>Total Users</th>
                                        <th>Total Orders</th>
                                        <th>Total Income</th>
                                        <th>Total Pending Orders</th>
                                        <th>Total Delivered Orders</th>
                                    </thead>
                                    <tr>
                                        <td><?= $totalUsers ?></td>
                                        <td><?= $totalOrders ?></td>
                                        <td><?= $totalIncome ?></td>
                                        <td><?= $totalPendingOrders ?></td>
                                        <td><?= $totalDeliveredOrders ?></td>
                                    </tr>
                                    <tbody>

                                    </tbody>
                                </table>
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
                                        $sql = "SELECT * FROM order_table ORDER BY created_at DESC";
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
                                                    <td>
                                                        <a style="padding:3px;" class="add_to_cart_button" href="show-order-details.php?id=<?= $row['id'] ?>">Show Details</a>

                                                        <?php if ($row['status'] == 0) : ?>

                                                            <a onclick="return confirm('Are you sure you want to update delivery status ?')" href="<?= $_SERVER['PHP_SELF'] . "?status=success&message=" . urlencode('Delivery status updated successfully') ?>&id=<?= $row['id'] ?>" style="background : green ;margin-top: 10px; padding:3px;" class="add_to_cart_button">Delivered</a>
                                                        <?php endif ?>

                                                    </td>

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
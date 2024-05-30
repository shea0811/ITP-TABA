<?php
include_once 'header.php';
include_once '__db.php';

$watchIds = [];

if (isset($_POST['update'])) {
    if (!isset($_POST['quantity'])) {
        $_SESSION['addToCart'] = [];
    } else {
        foreach ($_SESSION['addToCart'] as $key => $value) {
            if (isset($_POST['quantity'][$key])) {
                $_SESSION['addToCart'][$key]['quantity'] = $_POST['quantity'][$key];
            } else {
                array_splice($_SESSION['addToCart'], $key, 1);
            }
        }
    }

    header('location:my-cart.php?status=success&message=' . urlencode('Cart updated successfully'));
} else if (isset($_POST['proceed'])) {
    header("location:fill-address.php");
}

if (isset($_SESSION['addToCart'])) {
    $watchIds = array_column($_SESSION['addToCart'], 'watch_id');
    $quantities = array_column($_SESSION['addToCart'], 'quantity');
}
?>

<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>My Cart</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <?php include_once 'message.php'; ?>
            <?php
            if (!empty($watchIds)) :
            ?>
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $c = 1;
                            $quantity = 0;
                            $sum = 0;

                            foreach ($watchIds as $value) :
                                $sql = "SELECT * FROM watches WHERE id=$value";
                                $query = mysqli_query($con, $sql);
                                while ($row = mysqli_fetch_assoc($query)) :
                            ?>
                                    <tr id="watch-row-<?= $c; ?>">
                                        <td><a href="singleproduct.php?id=<?= $row['id']; ?>"><?= ucwords($row['name']) ?></a></td>
                                        <td><img src="img/uploaded/<?= $row['image'] ?>" class="img-responsive img-thumbnail" width="100"></td>
                                        <td>€ <?= $row['price'] ?></td>
                                        <td>
                                            <button type="button" onclick="addUpdateQuantity('quantity-index-<?= $quantity ?>')">+</button>
                                            <input type="text" name="quantity[]" id="quantity-index-<?= $quantity ?>" readonly value="<?= $quantities[$quantity] ?>" style="width:50px">
                                            <button type="button" onclick="removeUpdateQuantity('quantity-index-<?= $quantity ?>')">-</button>

                                            <button style="margin-left: 20px;" type="button" onclick="deleteWatchRow('watch-row-<?= $c; ?>')">Delete</button>
                                        </td>
                                        <td><?php
                                            $sum = $sum + ($row['price'] * $quantities[$quantity]);
                                            echo "€ " . $row['price'] * $quantities[$quantity];
                                            ++$quantity;
                                            ++$c;
                                            $_SESSION['cartAmount'] = $sum;
                                            ?></td>
                                    </tr>
                            <?php
                                endwhile;
                            endforeach;
                            ?>
                            <tr>
                                <td colspan="4" style="text-align: right;">Grand Total</td>
                                <td>€ <?= $sum ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <div>
                        <button type="submit" name="proceed" class="pull-right" style="margin-left: 20px;">Checkout </button>
                        <button type="submit" name="update" class="pull-right">Update </button>
                    </div>
                </form>
            <?php else : ?>
                <h1>
                    Your Cart is empty.
                    <br />
                    <a href="watches.php" class="btn btn-success">Click for shopping<a>

                </h1>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include_once 'footer.php'; ?>
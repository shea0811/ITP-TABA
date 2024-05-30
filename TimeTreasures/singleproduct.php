<?php
include_once 'header.php';
include_once '__db.php';

if (isset($_POST['submit'])) {
    $user_id = $_POST['user_id'];
    $watch_id = $_POST['watch_id'];
    $quantity = $_POST['quantity'];

    if (!isset($_SESSION['addToCart'])) {
        $_SESSION['addToCart'] = [];
    }

    if (!in_array($_POST['watch_id'], array_column($_SESSION['addToCart'], 'watch_id'))) {
        $_SESSION['addToCart'][] = [
            'user_id' => $_POST['user_id'],
            'watch_id' => $_POST['watch_id'],
            'quantity' => $_POST['quantity']
        ];

        header('location:singleproduct.php?id=' . $watch_id . '&status=success&message=' . urlencode('Watch added successfully. To check cart Click on link  <a href="my-cart.php" class="btn btn-success">Click here<a>'));
    } else {
        header('location:singleproduct.php?id=' . $watch_id . '&status=danger&message=' . urlencode('Watch has already been added to the cart.'));
    }
    exit;
}

if (isset($hammer_id)) {
    $productId = $hammer_id;
} else {
    $productId = $_GET['id'];
}

if (empty($productId)) {
    header('location:index.php');
}

$sql = "SELECT * FROM watches where id= $productId";
$row = mysqli_fetch_assoc(mysqli_query($con, $sql));

$viewCount = $row['viewCount'] + 1;

$sql = "UPDATE watches set viewCount=$viewCount where id=$productId";
mysqli_query($con, $sql);

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];

    $sql = "DELETE FROM recentlyview where hammer_id=$productId and user_id=$id";
    mysqli_query($con, $sql);

    $sql = "INSERT INTO recentlyview values(null,$id,$productId,CURRENT_TIMESTAMP())";
    mysqli_query($con, $sql);
}
?>

<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>WATCH DESCRIPTION</h2>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">


            <div class="col-md-12   ">
                <?php include_once 'message.php'; ?>
                <div class="product-content-right">
                    <div class="product-breadcroumb">
                        <a href="index.php">Home</a>
                        <a href="#">WATCH</a>
                        <a href=""><?= ucwords($row['name']); ?></a>
                    </div>

                    <div class="row">
                        <div class="col-sm-5">
                            <div class="product-images">
                                <div class="product-main-img">
                                    <img src="img/uploaded/<?= $row['image'] ?>" class="img-responsive img-thumbnail" alt="" width="300">
                                </div>

                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="product-inner">

                                <h2 class="product-name">
                                    <?= ucwords($row['name']); ?>
                                </h2>

                                <p><strong>Category</strong> : <?= $row['category'] ?></p>


                                <?php
                                $user_id = $row['user_id'];
                                $newsql = "SELECT * from user Where id=$user_id";
                                $userRow = mysqli_fetch_assoc(mysqli_query($con, $newsql));
                                echo '<p><strong>Watch added By</strong> : ' . $userRow['name'] . '</p>';
                                echo '<p><strong>Added on</strong> : ' . $row['submitted'] . '</p>';

                                ?>
                                <div class="product-inner-price">
                                    <strong>Price</strong> : <ins>€ <?= ucwords($row['price']); ?></ins>
                                </div>

                                <h3>Description</h3>
                                <p><?= $row['description']; ?></p>

                                <br />

                                <?php
                                if (!isset($_SESSION['id'])) : ?>
                                    <strong>Please must login first to buy this product</strong>

                                <?php elseif (isset($_SESSION['userType']) && $_SESSION['userType'] == 1) : ?>
                                    <strong>You cannot place an order because you logged as Admin</strong>
                                <?php else : ?>

                                    <section>
                                        <hr>
                                        <h2>Place an order</h2>
                                        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                                            <input type="hidden" name="user_id" value="<?= $id ?>">
                                            <input type="hidden" name="watch_id" value="<?= $productId ?>">

                                            <div class="form-group">
                                                <label for="">Select Quantity</label>
                                                <button id="add-to-cart" type="button" onclick="addQuantity()">+</button>
                                                <input type="text" name="quantity" id="quantityValue" readonly value="1" style="width:50px">
                                                <button id="remove-to-cart" type="button" onclick="removeQuantity()">-</button>
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" name="submit">Add To Cart</button>
                                            </div>
                                        </form>
                                    </section>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once 'footer.php'; ?>
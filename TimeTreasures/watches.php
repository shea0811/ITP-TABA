<?php
include_once 'header.php';
include_once '__db.php';

$category = 'all';
$watchQuery = "SELECT * FROM watches order by submitted DESC";

if (isset($_POST['search']) && $_POST['category'] !== 'all') {
    $category = $_POST['category'];
    $watchQuery = "SELECT * FROM watches where category = '$category' order by submitted DESC";
}



?>

<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Watches</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                <p id="billing_company_field" class="form-row form-row-wide">
                    <label class="" for="name">Select Category * </label>
                    <select name="category" required class="input-text" style="padding:12px">
                        <option value="all">All</option>
                        <?php
                        $sql = "SELECT category FROM watch_type";
                        $query = mysqli_query($con, $sql);
                        while ($row = mysqli_fetch_assoc($query)) :
                        ?>
                            <option value="<?= $row['category'] ?>" <?= $category == $row['category'] ? "SELECTED" : null; ?>> <?= $row['category'] ?></option>
                        <?php endwhile; ?>
                    </select>
                    <button name="search" type="submit">Search</button>
                </p>
            </form>

            <br />

            <?php
            $query = mysqli_query($con, $watchQuery);
            if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_assoc($query)) {
            ?>

                    <div class="col-md-3 col-sm-6">
                        <div class="single-shop-product">
                            <div class="product-upper">
                                <img src="img/uploaded/<?= $row['image'] ?>" class="img-responsive img-thumbnail" alt="">
                            </div>
                            <h2>
                                <a href="singleproduct.php?id=<?= $row['id'] ?>"><?= $row['name'] ?> </a>
                            </h2>
                            <div class="product-carousel-price">
                                <ins>€ <?= $row['price'] ?> (<?= $row['category'] ?>)</ins>
                            </div>

                            <div class="product-option-shop">
                                <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="singleproduct.php?id=<?= $row['id'] ?>">SEE DETAILS</a>
                            </div>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <h1>No watch found....</h1>
            <?php } ?>
        </div>
    </div>
</div>

<?php include_once 'footer.php'; ?>
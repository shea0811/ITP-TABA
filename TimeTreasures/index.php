<?php include_once 'header.php';
include_once '__db.php';

$sql = "SELECT COUNT(*) as total_count FROM watches ";
$total_count = mysqli_fetch_assoc(mysqli_query($con, $sql))['total_count'];

$sql = "SELECT COUNT(*) as total_user FROM user ";
$total_user = mysqli_fetch_assoc(mysqli_query($con, $sql))['total_user'];
?>
<div class="slider-area">
    <?php include_once 'message.php'; ?>
    <!-- Slider -->
    <div class="block-slider block-slider4">
        <ul class="" id="bxslider-home4">
            <li>
                <img src="img/hd-slide1.jpg" alt="Slide">
            </li>
            <li>
                <img src="img/hd-slide2.jpg" alt="Slide">
            </li>
            <li>
                <img src="img/hd-slide3.jpg" alt="Slide">
            </li>
            <li>
                <img src="img/hd-slide4.jpg" alt="Slide">
            </li>
            <li>
                <img src="img/hd-slide5.jpg" alt="Slide">
            </li>
        </ul>
    </div>
    <!-- ./Slider -->
</div> <!-- End slider area -->

<div class="promo-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">

            <div class="col-md-6 col-sm-6">
                <div class="single-promo promo2">
                    <i class="fa fa-dashboard"></i>
                    <p>Total Watches <?= $total_count ?></p>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="single-promo promo1">
                    <i class="fa fa-users"></i>
                    <p>Total Users <?= $total_user ?></p>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End promo area -->

<div class="maincontent-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="latest-product">
                    <h2 class="section-title">Latest Watches</h2>


                    <?php
                    $sql = "SELECT * FROM watches order by submitted DESC";
                    $query = mysqli_query($con, $sql);

                    if (mysqli_num_rows($query) > 0) {
                        echo '<div class="product-carousel">';
                        while ($row = mysqli_fetch_assoc($query)) {

                    ?>
                            <div class="single-product">
                                <div class="product-f-image">
                                    <img src="img/uploaded/<?= $row['image'] ?>" alt="">
                                    <div class="product-hover">

                                        <a href="singleproduct.php?id=<?= $row['id'] ?>" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                    </div>
                                </div>
                                <h2><a href="singleproduct.php?<? $row['id'] ?>"><?= $row['name'] ?>, € <?= $row['price'] ?></a></h2>
                            </div>
                        <?php
                        }
                        echo '</div>';
                    } else {
                        ?>
                        <h1>No Record Found....</h1>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div> <!-- End main content area -->

<div class="maincontent-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="latest-product">
                    <h2 class="section-title">Most Viewed Watches</h2>


                    <?php
                    $sql = "SELECT * FROM watches order by viewCount DESC Limit 6";
                    $query = mysqli_query($con, $sql);

                    if (mysqli_num_rows($query) > 0) {
                        echo '<div class="product-carousel">';
                        while ($row = mysqli_fetch_assoc($query)) {

                    ?>
                            <div class="single-product">
                                <div class="product-f-image">
                                    <img src="img/uploaded/<?= $row['image'] ?>" alt="">
                                    <div class="product-hover">

                                        <a href="singleproduct.php?id=<?= $row['id'] ?>" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                    </div>
                                </div>
                                <h2><a href="singleproduct.php?<? $row['id'] ?>"><?= $row['name'] ?>, €<?= $row['price'] ?></a></h2>
                            </div>
                        <?php
                        }
                        echo '</div>';
                    } else {
                        ?>
                        <h1>No Record Found....</h1>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div> <!-- End main content area -->


<?php if (isset($_SESSION['id'])) { ?>
    <div class="maincontent-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-product">
                        <h2 class="section-title">Recent Visited Watches</h2>
                        <?php
                        $id = $_SESSION['id'];
                        $sql = "SELECT h.* FROM watches as h INNER JOIN recentlyview as r ON r.hammer_id=h.id and r.user_id=$id ORDER BY r.created_dt DESC LIMIT 6";
                        $query = mysqli_query($con, $sql);

                        if (mysqli_num_rows($query) > 0) {
                            echo '<div class="product-carousel">';
                            while ($row = mysqli_fetch_assoc($query)) {

                        ?>
                                <div class="single-product">
                                    <div class="product-f-image">
                                        <img src="img/uploaded/<?= $row['image'] ?>" alt="">
                                        <div class="product-hover">

                                            <a href="singleproduct.php?id=<?= $row['id'] ?>" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                        </div>
                                    </div>
                                    <h2><a href="singleproduct.php?<? $row['id'] ?>"><?= $row['name'] ?>, € <?= $row['price'] ?>$</a></h2>
                                </div>
                            <?php
                            }
                            echo '</div>';
                        } else {
                            ?>
                            <h1>No Record Found....</h1>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
</div> <!-- End main content area -->



<div class="footer-bottom-area">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="copyright">
                    <p>&copy; <?= date('Y'); ?> Hammer Boomerang. All Rights Reserved. </p>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End footer bottom area -->

<!-- Latest jQuery form server -->
<script src="https://code.jquery.com/jquery.min.js"></script>

<!-- Bootstrap JS form CDN -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<!-- jQuery sticky menu -->
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.sticky.js"></script>

<!-- jQuery easing -->
<script src="js/jquery.easing.1.3.min.js"></script>

<!-- Main Script -->
<script src="js/main.js"></script>

<!-- Slider -->
<script type="text/javascript" src="js/bxslider.min.js"></script>
<script type="text/javascript" src="js/script.slider.js"></script>
</body>

</html>
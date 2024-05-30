<?php
//external  PHP files that contain funtionality and database connection code.
include_once 'header.php';
include_once '__db.php';
// gets user ID from the session
$user_id = $_SESSION['id'];
//retrieves all information about the logged-in user the user table. Result is fetched and stored in $result.
$query = "SELECT * FROM user where id=$user_id";
$result  = mysqli_fetch_assoc(mysqli_query($con, $query));

//code checks if a 'addToCart' variable is set. If not the user is redirected to the my cart php file. Indicating the user must 
// have items in their cart before proceeding
if (!isset($_SESSION['addToCart'])) {
    header("location:my-cart.php");
    exit;
}

//if the person checks out the below information is collected and stored.
if (isset($_POST['placeOrder'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $name = $_POST['name'];
    $total_amount = $_SESSION['cartAmount'];

    //the information is stored in the database to the 'order_table' table in the database.
    $insertOrderQuery = "INSERT into order_table values(null,$user_id ,'$name', '$email', '$address',$total_amount, 0, CURRENT_TIMESTAMP())";
    $check = mysqli_query($con, $insertOrderQuery);

    // $_Session['addToCart'] constructs multiple 'insert' statements to store each cart items details into the oder_details table
    if ($check) {
        $orderId = mysqli_insert_id($con);
        $insertOrderDetailedQuery = '';
        foreach ($_SESSION['addToCart'] as $key => $value) {
            $watch_id = $value['watch_id'];
            $quantity = $value['quantity'];
            $insertOrderDetailedQuery .= "INSERT INTO order_details values(null, $orderId ,$watch_id, $quantity);";
        }
        // this is used to execute multiple SQL commands in one go.If successful the user is redirected to the my-orders php file
        // otherwise the user is redirected to the fill-address php file 
        if (mysqli_multi_query($con, $insertOrderDetailedQuery)) {
            header('location:my-orders.php?id=' . $orderId);
            exit;
        }
    }
    header('location:fill-address.php?status=success&message=' . urlencode('Database Problem'));
}
// the HTML structure creates a checkout form. Name and Email field is pre-filled with the values fetched from the database.
?>

<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>CHECKOUT</h2>
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
            <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                <div id="customer_details" class="col2-set">
                    <div class="col-4">
                        <div class="woocommerce-billing-fields">
                            <div class="col-xs-12 col-md-6 col-md-offset-3">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <h3 class="text-center">Payment Details</h3>
                                            <img class="img-responsive cc-img" src="https://www.prepbootstrap.com/Content/images/shared/misc/creditcardicons.png">
                                        </div>
                                    </div>
                                    <div class="panel-body">

                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" name="name" class="form-control" readonly value="<?= $result['name']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="form-group">
                                                    <label>Email Id</label>
                                                    <input type="text" name="email" class="form-control" readonly value="<?= $result['email']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="form-group">
                                                    <label>Phone Number</label>
                                                    <input type="text" name="phoneNumber" required class="form-control" placeholder="Enter Phone Number" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="form-group">
                                                    <label>Delivery Address</label>
                                                    <textarea placeholder="Enter Delivery Address" id="address" name="address" class="input-text" cols="5" rows="5"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="form-group">
                                                    <label>CARD NUMBER</label>
                                                    <div class="input-group">
                                                        <input type="number" name="cardNumber" class="form-control" placeholder="Valid Card Number" required />
                                                        <span class="input-group-addon"><span class="fa fa-credit-card"></span></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-7 col-md-7">
                                                <div class="form-group">
                                                    <label><span class="hidden-xs">EXPIRATION</span><span class="visible-xs-inline">EXP</span> DATE</label>
                                                    <input type="text" name="expiryDate" class="form-control" placeholder="MM / YY" required />
                                                </div>
                                            </div>
                                            <div class="col-xs-5 col-md-5 pull-right">
                                                <div class="form-group">
                                                    <label>CV CODE</label>
                                                    <input type="number" name="cvCode" class="form-control" placeholder="CVC" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="form-group">
                                                    <label>CARD OWNER</label>
                                                    <input type="text" name="cardOwner" class="form-control" placeholder="Card Owner Names" required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <button type="submit" name="placeOrder" class="btn btn-warning btn-lg btn-block">Process payment</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <style>
                            .cc-img {
                                margin: 0 auto;
                            }
                        </style>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once 'footer.php'; ?> 
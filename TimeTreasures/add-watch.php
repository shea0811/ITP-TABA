<?php
include_once 'header.php';
include_once 'sessionHeader.php';
include_once '__db.php';
$id = $_SESSION['id'];
if (isset($_POST['submit'])) {

    $name = addslashes($_POST['name']);
    $description = addslashes($_POST['description']);
    $price = $_POST['price'];
    $category = $_POST['category'];


    $file_name = $_FILES['hammerImage']['name'];
    $file_size = $_FILES['hammerImage']['size'];                 // upload in kb always 
    $file_temp = $_FILES['hammerImage']['tmp_name'];
    $file_type = $_FILES['hammerImage']['type'];

    $file_name = time() . '-' . $file_name . '.jpg';

    move_uploaded_file($file_temp, 'img/uploaded/' . $file_name);

    $sql = "INSERT INTO watches VALUES (NULL,$id,'$category','$name','$description','$file_name','$price',CURRENT_TIMESTAMP(),0)";
    $query = mysqli_query($con, $sql);

    if ($query) {
        header('location:add-watch.php?status=success&message=' . urlencode('Watch added successfully'));
    } else {
        header('location:add-watch.php?status=danger&message=' . urlencode('Database problem'));
    }
}
?>

<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>ADD WATCH PAGE</h2>
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
                    <form onsubmit="return addhammerFunction();" enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                        <div id="customer_details" class="col2-set">
                            <div class="col-4">
                                <div class="woocommerce-billing-fields">
                                    <?php include_once 'message.php'; ?>

                                    <p id="billing_company_field" class="form-row form-row-wide">
                                        <label class="" for="name">Select Category * </label>
                                        <select name="category" required class="input-text">
                                            <option value="">Select Category</option>
                                            <?php
                                            $sql = "SELECT category FROM watch_type";
                                            $query = mysqli_query($con, $sql);
                                            while ($row = mysqli_fetch_assoc($query)) :
                                            ?>
                                                <option value="<?= $row['category'] ?>"><?= $row['category'] ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </p>


                                    <p id="billing_company_field" class="form-row form-row-wide">
                                        <label class="" for="hammerImage">Select Image * </label>
                                        <input type="file" id="hammerImage" name="hammerImage" class="input-text" style="width: 100%;" required="" accept="image/x-png,image/gif,image/jpeg" />
                                    </p>
                                    <p id="billing_company_field" class="form-row form-row-wide">
                                        <label class="" for="name">Name * </label>
                                        <input type="text" value="" placeholder="Enter Name" id="name" name="name" class="input-text" style="width: 100%;" required="">
                                    </p>

                                    <p id="billing_company_field" class="form-row form-row-wide">
                                        <label class="" for="description">Description * </label>
                                        <textarea cols="4" rows="4" value="" placeholder="Enter Description" id="description" name="description" class="input-text" style="width: 100%;" required=""></textarea>
                                    </p>

                                    <p id="billing_company_field" class="form-row form-row-wide">
                                        <label class="" for="price">Price * </label>
                                        <input type="text" value="" placeholder="Enter Price" id="price" name="price" class="input-text" style="width: 100%;" required="">
                                    </p>
                                    <p><button type="submit" name="submit" class="btn-sm btn btn-success">Add Watch</button></p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once 'footer.php'; ?>
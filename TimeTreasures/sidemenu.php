  <div class="col-md-4">
      <div class="single-sidebar">
          <h2 class="sidebar-title">Side Meinu</h2>
          <ul>
              <li>Hello <strong><?= $_SESSION['username']; ?></strong></li>
              <li><a href="dashboard.php">Home</a></li>

              <?php if ($_SESSION['userType'] == 1) : ?>
                  <li><a href="add-watch.php">Add Watch</a></li>
                  <li><a href="all-watches.php">All Watches</a></li>
                  <li><a href="all-order-details.php">All Order Details</a></li>
              <?php endif; ?>
              <?php if ($_SESSION['userType'] == 0) : ?>
                  <li><a href="my-orders.php">My Orders</a></li>
              <?php endif; ?>

              <li><a href="updateProfile.php">Update Profile</a></li>
              <li><a href="changePassword.php">Change Password</a></li>
              <li><a href="logout.php">logout</a></li>
          </ul>
      </div>
  </div>
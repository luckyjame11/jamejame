<?php 
session_start();

// Check if the user is logged in
if(empty($_SESSION['loggedUser'])) {
    header('Location: Log-in-Form.php');
    exit;
}

// Include the database connection file
require 'db_connection.php';

// Get the user ID from the session
$userID = $_SESSION['userID'];

// Fetch the user's billing addresses
$query = "SELECT * FROM users_delivery_address WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $userID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Initialize an empty array to store address data
$addressData = [];

// Check if there's any billing address for the user
if($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $addressData[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sign-Up/Login Form</title>
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="index.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-rfhP/KuX8Vvp3sEVSJrF2T4taK3jnuHBeq5KoxRYhAaQb5vohK6c9m3KBcAG2wn7g73Em1zR/ubqyLkHXvHgCA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <link rel="stylesheet" type="text/css" href="product-card.css">
<script src="product-card.js"></script>
</head>
<style type="text/css">
  @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css");
           i {
    color: white;
  }
  span {
    color: white;
  }
  i:hover {
    color: #443f38;
  }
  span:hover {
    color: #443f38;
  }
  a {
    color: white;
    text-decoration: none;
  }
  .nav-pills .nav-link {
    width: 200px;
  }
  .nav-pills .nav-link:hover {
    width: 200px;
    background-color: #6c757d;
    transition: background-color 0.3s ease, padding 0.3s ease;
  }
  .nav-link.active {
    background-color: #6c757d;
  }
  .carousel-control-prev,
  .carousel-control-next {
    border-radius: 50%;
    background-color: #6c757d;
    opacity: 0.8;
  }
  .carousel-control-prev-icon,
  .carousel-control-next-icon {
    background-color: white;
  }
  .close-btn-container {
    display: block;
    margin-bottom: 20px;
  }
  .topnav2 {
    position: sticky;
    top: 0;
    z-index: 1000;
    background-color: #333;
    padding: 10px 0;
  }
  .blur-background {
    background-image: url('img/bg.jpeg');
    background-size: cover;
    backdrop-filter: blur(5px);
  }
  .col-md-4 {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  .col-md-4:hover {
    transform: scale(1.05);
  }
  @import url('https://fonts.googleapis.com/css?family=Roboto:400,500,700');
  * {
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    margin: 0;
    padding: 0;
  }
  body {
    font-family: 'Roboto', sans-serif;
  }
  a {
    text-decoration: none;
  }
  .product-card {
    width: 320px;
    position: relative;
    box-shadow: 0 2px 7px #dfdfdf;
    margin: 20px;
    background: #fafafa;
  }
  .badge {
    position: absolute;
    left: 0;
    top: 20px;
    text-transform: uppercase;
    font-size: 13px;
    font-weight: 700;
    background: red;
    color: #fff;
    padding: 3px 10px;
  }
  .product-tumb {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 300px;
    padding: 0;
    background: #f0f0f0;
  }
  .product-tumb img {
    max-width: 100%;
    max-height: 100%;
    width: auto;
    height: auto;
  }
  .product-details {
    padding: 30px;
  }
  .product-catagory {
    display: block;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    color: #ccc;
    margin-bottom: 18px;
  }
  .product-details h4 a {
    font-weight: 500;
    display: block;
    margin-bottom: 18px;
    text-transform: uppercase;
    color: #363636;
    text-decoration: none;
    transition: 0.3s;
  }
  .product-details h4 a:hover {
    color: #fbb72c;
  }
  .product-details p {
    font-size: 15px;
    line-height: 22px;
    margin-bottom: 18px;
    color: #999;
  }
  .product-bottom-details {
    overflow: hidden;
    border-top: 1px solid #eee;
    padding-top: 20px;
  }
  .product-bottom-details div {
    float: left;
    width: 50%;
  }
  .product-price {
    font-size: 18px;
    color: #fbb72c;
    font-weight: 600;
  }
  .product-price small {
    font-size: 80%;
    font-weight: 400;
    text-decoration: line-through;
    display: inline-block;
    margin-right: 5px;
  }
  .product-links {
    text-align: right;
  }
  .product-links a {
    display: inline-block;
    margin-left: 5px;
    color: #e1e1e1;
    transition: 0.3s;
    font-size: 17px;
  }
  .product-links a:hover {
    color: #fbb72c;
  }
  h4 {
    font-size: 14px;
  }
  .products {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    margin: 50px 0;
  }
  .footer {
    background-color: gray;
    position: static;
    bottom: 0;
    left: 0;
    width: 100%;
  }
  .footer p {
    padding: 10px;
    margin: 0;
    text-align: center;
  }
   .custom-sidebar {
            background-color: #f8f9fa;
            padding: 20px;
            height: 100vh;
        }
        .custom-sidebar a {
            display: block;
            color: #333;
            padding: 10px 15px;
            text-decoration: none;
            font-weight: bold;
        }
        .custom-sidebar a:hover {
            background-color: #e9ecef;
        }
        .custom-sidebar a.active {
            background-color: #fd7e14;
            color: white;
        }
        .custom-content {
            padding: 20px;
        }
        .address-box {
            border: 1px dotted #dee2e6;
            padding: 20px;
            margin-bottom: 20px;
        }
        .address-box h4 {
            font-weight: bold;
        }
        .address-box a {
            color: #fd7e14;
        }
        .hidden {
            display: none;
        }
</style>
<body class="blur-background">
<div style="position: sticky; top: 0px; left: 0px; overflow: ; background-color: red;">

</div>
<div class="topnav2" style="padding-bottom: 0px;padding-top: 0px;">
  <a href="index.php" style="text-decoration:none;">
    <p class="dimelogo2" name="dimelogo" style="font-family: arial black;padding-bottom: 0px;padding-top: 0px;">DIME FOOTWEAR</p>
  </a>
  <a href="#home" style="text-decoration:none;">NEW ARRIVALS</a>
  <a href="lifestyle-classification.php" style="text-decoration:none;">LIFESTYLE</a>
  <a href="sports-classification.php" style="text-decoration:none;">SPORTS</a>
  <a href="about-us.php" style="text-decoration:none;">CONTACT US</a>

  <div class="search-container">
    <form action="search-product.php">
      <input type="text" placeholder="Search.." name="search">
      <button type="submit">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
          <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
        </svg>
      </button>
    </form>
     <button class="btn cart" type="button" onclick="redirectToCart()">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
      </svg>
    </button>
    <button class="dropdown-btn hamburger" onclick="toggleSidebar()">
     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
</svg>
    </button>
  </div>
</div>

<!-- Sidebar -->
<div id="sidebar" class="sidebar" >
    
    <!-- "X" button container -->
    <div class="close-btn-container" style="">
        <button class="close-btn" onclick="closeSidebar()">
            <span aria-hidden="true" style="color: black;">&times;</span>
        </button>
    </div>
    <!-- Sidebar content -->
    <div class="sidebar-content" >
        <a href="myAccount.php">
            <i class="fas fa-user"></i> <!-- User icon -->
            My Account
        </a>
        <a data-toggle="modal" data-target="#registrationSuccessModal" href="">
            <i class="fas fa-sign-out-alt"></i> <!-- Sign-out icon -->
            Log Out
        </a>
    </div>
</div>
<div id="brandCarousel" class="carousel slide" data-bs-ride="carousel" style="background-color: lightgray; padding: 20px;">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <div class="row">
        <div class="col-md-4">
          <div class="card mb-3">
            <a href="nike-index.php">
              <img src="img/nike.png" class="card-img-top" alt="Brand 1" style="object-fit: contain; height: 150px;">
            </a>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card mb-3">
            <a href="under-armour-index.php">
              <img src="img/Under_armour_logo.svg.png" class="card-img-top" alt="Brand 2" style="object-fit: contain; height: 150px;">
            </a>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card mb-3">
            <a href="adidas-index.php">
              <img src="img/Adidas_logo.png" class="card-img-top" alt="Brand 3" style="object-fit: contain; height: 150px;">
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="carousel-item">
      <div class="row">
        <div class="col-md-4">
          <div class="card mb-3">
            <a href="anta-index.php">
              <img src="img/Anta_logo.svg.png" class="card-img-top" alt="Brand 4" style="object-fit: contain; height: 150px;">
            </a>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card mb-3">
            <a href="puma-index.php">
              <img src="img/Puma-logo.png" class="card-img-top" alt="Brand 5" style="object-fit: contain; height: 150px;">
            </a>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card mb-3">
            <a href="jordan-index.php">
              <img src="img/98e5a4811e32177795897d60231a016f.jpg" class="card-img-top" alt="Brand 6" style="object-fit: contain; height: 150px;">
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

 <a class="carousel-control-prev" href="#brandCarousel" role="button" data-slide="prev" onclick="prevCarousel()" style="width: 50px;height: 50px; margin-top: 75px;">
   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
  <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
</svg>
    <span class="sr-only">Previous</span>
</a>
<a class="carousel-control-next" href="#brandCarousel" role="button" data-slide="next" onclick="nextCarousel()" style="width: 50px;height: 50px; margin-top: 75px;">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
  <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
</svg>
    <span class="sr-only">Next</span>
</a>

</div>
</center>
<main style="background-color: ghostwhite; padding-bottom: 50px; margin-right: 20px; margin-left: 20px; margin-top: 30px;">
  <br>
  <div style="background-color:darkgrey; margin-top: 0px; margin-right: 35px; margin-left: 35px; padding-bottom: 5px; padding-top: 5px; ">
  <h2 align="center" style=" margin-bottom: 0px; font-family: arial;font-weight: bold;">MY ACCOUNT</h2>
  </div>
  <div class="products" style="margin: 50px;" >
          <div class="container-fluid">
    <div class="row">
        <div class="col-md-2 custom-sidebar">
            <a href="#" class="active" data-target="orders">Orders</a>
            <a href="#" data-target="addresses">Addresses</a>
          
            
        </div>
        <div class="col-md-10 custom-content">
            
            <div id="orders" class="content-section">
                <h2>Orders</h2>
                <?php 

               $query = "SELECT * FROM orders WHERE user_id = ? AND status IN ( 'Delivered', 'Canceled', 'Returned') ORDER BY order_date ASC";
                $stmt = mysqli_prepare($conn, $query);
                mysqli_stmt_bind_param($stmt, "i", $userID);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                // Initialize an empty array to store order data
                $orderData = [];

                // Check if there are any orders for the user
                if($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $orderData[] = $row;
                    }
                }

                ?>
                <!-- <p>Your orders will be displayed here.</p> -->
                <?php if (!empty($orderData)): ?>
                <?php foreach ($orderData as $order): ?>
                    <div class="address-box">
                        <h4>Order #<?= $order['order_id']; ?></h4>
                        <p><strong>Order Date:</strong><?= date('F j, Y', strtotime($order['order_date'])); ?></p>
                        <p><strong>Total Amount:</strong><?= '$' . number_format($order['total_amount'], 2); ?></p>
                        <p><strong>Payment Type:</strong> <?= htmlspecialchars($order['mode_payment']); ?></p>
                        <p><strong>Status:</strong> <?= htmlspecialchars($order['status']); ?></p>
                        <a href="order-details.php?order_id=<?= $order['order_id']; ?>">View Details</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No orders found.</p>
            <?php endif; ?>
            </div>
            <div id="addresses" class="content-section hidden">
                <h2>Addresses</h2>
                <p>The following addresses will be used on the checkout page by default.</p>
                                <?php if (!empty($addressData)): ?>
                        <div class="row">
                            <?php foreach ($addressData as $address): ?>
                                <div class="col-md-6">
                                    <div class="address-box">
                                        <h4>Billing Address <a href="delete-address.php?id=<?php echo $address['address_id']; ?>" style="color:red">Delete</a></h4>
                                        <p>Name: <?php echo $address['first_name'] . ' ' . $address['last_name']; ?></p>
                                        <p>Address: <?php echo $address['address']; ?></p>
                                        <p>City/Municipality: <?php echo $address['city_municipality']; ?></p>
                                        <p>Province: <?php echo $address['province']; ?></p>
                                        <p>ZIP Code: <?php echo $address['zip_code']; ?></p>
                                        <p>Contact Number: <?php echo $address['contact_number']; ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p>No billing addresses found.</p>
                    <?php endif; ?>
                   
                </div>
            </div>
         
        </div>
    </div>
</div>
</main>
<?php

// Check if delete was successful
if(isset($_SESSION['deleteSuccess'])) {
    if($_SESSION['deleteSuccess']) {
        // Success modal
        echo '
        <div class="modal" tabindex="-1" role="dialog" id="successModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Success</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Address Successfully Deleted
                    </div>
                </div>
            </div>
        </div>
        <script>
            // Show the success modal
            $("#successModal").modal("show");
        </script>';
    } else {
        // Error modal
        echo '
        <div class="modal" tabindex="-1" role="dialog" id="errorModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Error</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Error occurred while deleting address: ' . $_SESSION['deleteError'] . '
                    </div>
                </div>
            </div>
        </div>
        <script>
            // Show the error modal
            $("#errorModal").modal("show");
        </script>';
    }
    // Unset session variables
    unset($_SESSION['deleteSuccess']);
    unset($_SESSION['deleteError']);
}
?>

<div class="modal fade" id="registrationSuccessModal" tabindex="-1" role="dialog" aria-labelledby="registrationSuccessModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="registrationSuccessModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Do you want to Log Out?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="redirectToLogin()">YES</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Success!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Your address has been successfully added.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Include Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Script to show the modal -->
    <script>
        $(document).ready(function(){
            $('#successModal').modal('show');
        });
    </script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="index.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="index.js"></script>
<script>
    function redirectToCart() {
    window.location.href = 'myCart.php';
  }
function redirectToLogin() {
  window.location.href = 'log_out.php';
}
function toggleSidebar() {
  var sidebar = document.getElementById('sidebar');
  sidebar.classList.toggle('active');
}

function closeSidebar() {
  var sidebar = document.getElementById('sidebar');
  sidebar.classList.remove('active');
}
function handleCarouselControls(direction) {
  var carousel = document.getElementById('brandCarousel');
  var carouselInstance = bootstrap.Carousel.getInstance(carousel);

  if (direction === 'prev') {
    carouselInstance.prev();
  } else if (direction === 'next') {
    carouselInstance.next();
  }
}

document.querySelectorAll('.custom-sidebar a').forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            document.querySelectorAll('.custom-sidebar a').forEach(function(link) {
                link.classList.remove('active');
            });
            link.classList.add('active');
            
            var target = link.getAttribute('data-target');
            document.querySelectorAll('.content-section').forEach(function(section) {
                section.classList.add('hidden');
            });
            document.getElementById(target).classList.remove('hidden');
        });
    });
</script>
<div class="footer" style="background-color: gray; position: ; bottom: 0px; left: 0px; width: 100%;">
<footer align="center">
    <p style="padding-top:10px;padding-left:10px; margin: 0px ; padding-bottom: 15px; padding-top: 15px; margin-top:10px;"> &#169 Disclaimer for School Purposes</p>
</footer>
</div>
</body>
</html>
<?php
// Close the database connection
mysqli_close($conn);
?>
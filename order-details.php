
<?php 

session_start();
$_SESSION['userID'];
$_SESSION['loggedUser'];

if(empty($_SESSION['loggedUser'])){
    header('Location: Log-in-Form.php');
    exit;
}
// Include the database connection file
require 'db_connection.php';

// Get the order ID from the URL
$orderID = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;

if ($orderID <= 0) {
    die('Invalid order ID');
}

// Fetch the order details
$orderQuery = "
    SELECT 
        o.*, 
        a.first_name, 
        a.last_name, 
        a.address, 
        a.zip_code, 
        a.region, 
        a.city_municipality, 
        a.province, 
        a.contact_number 
    FROM orders o 
    JOIN users_delivery_address a ON o.address_id = a.address_id 
    WHERE o.order_id = ?";
$orderStmt = mysqli_prepare($conn, $orderQuery);
mysqli_stmt_bind_param($orderStmt, "i", $orderID);
mysqli_stmt_execute($orderStmt);
$orderResult = mysqli_stmt_get_result($orderStmt);
$order = mysqli_fetch_assoc($orderResult);

if (!$order) {
    die('Order not found');
}

// Fetch the order items and related product details
$itemsQuery = "
    SELECT 
        oi.*, 
        p.name AS product_name, 
        p.product_details, 
        p.serial_id, 
        p.main_image, 
        p.sub_image2, 
        p.sub_image3, 
        p.sub_image4, 
        p.sub_image5 
    FROM order_items oi 
    JOIN product p ON oi.serial_id = p.serial_id 
    WHERE oi.order_id = ?";
$itemsStmt = mysqli_prepare($conn, $itemsQuery);
mysqli_stmt_bind_param($itemsStmt, "i", $orderID);
mysqli_stmt_execute($itemsStmt);
$itemsResult = mysqli_stmt_get_result($itemsStmt);

// Initialize an empty array to store order item data
$orderItems = [];
while ($item = mysqli_fetch_assoc($itemsResult)) {
    $orderItems[] = $item;
}
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>About us | Dime Footwear</title>
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="index.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-rfhP/KuX8Vvp3sEVSJrF2T4taK3jnuHBeq5KoxRYhAaQb5vohK6c9m3KBcAG2wn7g73Em1zR/ubqyLkHXvHgCA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

  <link rel="stylesheet" type="text/css" href="product-card.css">
<script src="product-card.js"></script>
</head>
<style type="text/css">
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
  about-section {
      padding: 60px 20px;
      text-align: center;
      background-color: #f9f9f9;
    }

    .about-section h1 {
      font-size: 2.5em;
      margin-bottom: 20px;
      color: #333;
    }

    .about-section p {
      font-size: 1.1em;
      margin-bottom: 20px;
      color: #555;
    }

    .mission, .vision, .values {
      margin: 40px 0;
    }

    .mission h2, .vision h2, .values h2 {
      font-size: 2em;
      margin-bottom: 15px;
      color: #333;
    }

    .mission p, .vision p, .values p, .values ul {
      font-size: 1.1em;
      color: #555;
    }

    .values ul {
      list-style: none;
      padding: 0;
    }

    .values ul li {
      margin-bottom: 10px;
    }

    .team {
      margin-top: 40px;
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
    }

    .team-member {
      margin: 20px;
      text-align: center;
    }

    .team-member img {
      border-radius: 50%;
      width: 150px;
      height: 150px;
      object-fit: cover;
    }

    .team-member h3 {
      margin-top: 15px;
      font-size: 1.2em;
      color: #333;
    }

    .team-member p {
      font-size: 1em;
      color: #777;
    }

    footer {
      background-color: #333;
      color: #fff;
      padding: 20px 0;
    }

    footer p {
      margin: 0;
    }
.about-section {
  padding: 60px 20px;
  text-align: center;
  background-color: #f9f9f9;
  border-radius: 10px; /* Add border radius for rounded corners */
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add a subtle shadow for depth */
}

.about-section h2 {
  font-size: 2.5em;
  margin-bottom: 20px;
  color: #333;
}

.about-section p {
  font-size: 1.1em;
  margin-bottom: 20px;
  color: #555;
}

.container {
  margin-right: auto;
  margin-left: auto;
  padding-left: 15px;
  padding-right: 15px;
}

.row {
  margin-right: -15px;
  margin-left: -15px;
}

.col-md-6 {
  position: relative;
  width: 100%;
  min-height: 1px;
  padding-right: 15px;
  padding-left: 15px;
}

/* Add additional styles as needed */


.order-item-box {
  margin-bottom: 20px;
}

.product-image {
  width: 100px; /* Adjust as needed */
  height: 100px; /* Adjust as needed */
  object-fit: cover;
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
  <center>
  <div style="background-color:darkgrey; margin-top: 0px; margin-right: 35px; margin-left: 35px; padding-bottom: 5px; padding-top: 5px; ">
  <h2 align="center" style=" margin-bottom: 0px; font-family: arial;font-weight: bold;">ORDER STATUS</h2>
  </div>
  <div class="products" style="margin: 50px;" >
<main>
  <div class="about-section">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h2>Order Details</h2>
          <div class="address-box" align="left">
            <h4>Order #<?= $order['order_id']; ?></h4>
            <p><strong>Order Date:</strong> <?= date('F j, Y', strtotime($order['order_date'])); ?></p>
            <p><strong>Total Amount:</strong> <?= '$' . number_format($order['total_amount'], 2); ?></p>
            <p><strong>Status:</strong> <?= htmlspecialchars($order['status']); ?></p>
            <p><strong>Delivered Date:</strong> <?= $order['date_delivered'] == '0000-00-00 00:00:00' ? 'Not Yet' : date('F j, Y', strtotime($order['date_delivered'])); ?></p>

            <p><strong>Delivery Address:</strong></p>
            <p><strong>Receivers's Name:</strong><?= htmlspecialchars($order['first_name']) . ' ' . htmlspecialchars($order['last_name']); ?></p>
            <p><strong>Full Address:</strong><?= htmlspecialchars($order['address']); ?></p>
            <p><strong>Municipality:</strong> <?= htmlspecialchars($order['city_municipality']);?></p>
            <p><strong>Full Address:</strong> <?= htmlspecialchars($order['province']); ?></p>
            <p><strong>Zip Code:</strong><?= htmlspecialchars($order['zip_code']) . ', ' . htmlspecialchars($order['region']); ?></p>
            <p><strong>Contact Number:</strong> <?= htmlspecialchars($order['contact_number']); ?></p>
          </div>
        </div>
        <div class="col-md-6" align="left">
          <h3>Ordered Items</h3>
          <?php if (!empty($orderItems)): ?>
            <?php foreach ($orderItems as $item): ?>
              <div class="order-item-box">
                <img src="img/products/<?= htmlspecialchars($item['main_image']); ?>" alt="<?= htmlspecialchars($item['product_name']); ?>" class="product-image">
                <p><strong>Product Name:</strong> <?= htmlspecialchars($item['product_name']); ?></p>
                
                <p><strong>Size:</strong> <?= intval($item['size']); ?></p>
                <p><strong>Quantity:</strong> <?= intval($item['quantity']); ?></p>
                <p><strong>Price:</strong> <?= '$' . number_format($item['price'], 2); ?></p>
                <div class="sub-images">
                </div>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <p>No items found for this order.</p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</main>   

  </div>
</main>

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

 function handleCarouselControls(direction) {
    var carousel = document.getElementById('brandCarousel');
    var carouselInstance = bootstrap.Carousel.getInstance(carousel);

    if (direction === 'prev') {
      carouselInstance.prev();
    } else if (direction === 'next') {
      carouselInstance.next();
    }
  }

  // Event listeners for the carousel controls
  document.querySelector('.carousel-control-prev').addEventListener('click', function() {
    handleCarouselControls('prev');
  });

  document.querySelector('.carousel-control-next').addEventListener('click', function() {
    handleCarouselControls('next');
  });

  // Function to trigger next slide
  function nextCarousel() {
    handleCarouselControls('next');
  }

  // Function to trigger previous slide
  function prevCarousel() {
    handleCarouselControls('prev');
  }
</script>
<div class="footer" style="background-color: gray; position: ; bottom: 0px; left: 0px; width: 100%;">
<footer align="center">
    <p style="padding-top:10px;padding-left:10px; margin: 0px ; padding-bottom: 15px; padding-top: 15px; margin-top:10px;"> &#169 Disclaimer for School Purposes</p>
</footer>
</div>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>

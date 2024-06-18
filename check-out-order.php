<?php
session_start();

if (empty($_SESSION['userID'])) {
    header('Location: Log-in-Form.php');
    exit;
}

$userID = $_SESSION['userID'];

// Connect to your database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dimefootwear";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the checked items and their details from the form submission
// Get the checked items and their details from the form submission
$checkedItems = isset($_POST['checkedItems']) ? $_POST['checkedItems'] : [];
$serial_ids = isset($_POST['serial_id']) ? $_POST['serial_id'] : [];
$cart_ids = isset($_POST['cart_id']) ? $_POST['cart_id'] : [];
$ids = isset($_POST['id']) ? $_POST['id'] : [];
$name = isset($_POST['name']) ? $_POST['name'] : [];
$main_images = isset($_POST['main_image']) ? $_POST['main_image'] : [];
$quantities = isset($_POST['Quantity']) ? $_POST['Quantity'] : [];
$prices = isset($_POST['price']) ? $_POST['price'] : [];
$sizes = isset($_POST['size']) ? $_POST['size'] : [];

// Initialize $items as an empty array
$items = [];

// Process each checked item
foreach ($checkedItems as $key => $cart_id) {
    $serial_id = $serial_ids[$key];
    $id = $ids[$key];
    $main_image = $main_images[$key];
    $quantity = $quantities[$key];
    $price = $prices[$key];
    $size = $sizes[$key];
    
    // Populate $items array
    $items[] = [
        'serial_id' => $serial_id,
        'cart_id' => $cart_id,
        'name' => $name[$key],
        'id' => $id,
        'main_image' => $main_image,
        'quantity' => $quantity,
        'price' => floatval($price),
        'size' => $size
    ];
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
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

  <link rel="stylesheet" type="text/css" href="product-card.css">
  <link rel="stylesheet" type="text/css" href=".css">
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

/*****************globals*************/
body {
  font-family: 'open sans';
  overflow-x: hidden; }

img {
  max-width: 100%; }

.preview {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -webkit-flex-direction: column;
      -ms-flex-direction: column;
          flex-direction: column; }
  @media screen and (max-width: 996px) {
    .preview {
      margin-bottom: 20px; } }

.preview-pic {
  -webkit-box-flex: 1;
  -webkit-flex-grow: 1;
      -ms-flex-positive: 1;
          flex-grow: 1; }

.preview-thumbnail.nav-tabs {
  border: none;
  margin-top: 15px; }
  .preview-thumbnail.nav-tabs li {
    width: 18%;
    margin-right: 2.5%; }
    .preview-thumbnail.nav-tabs li img {
      max-width: 100%;
      display: block; }
    .preview-thumbnail.nav-tabs li a {
      padding: 0;
      margin: 0; }
    .preview-thumbnail.nav-tabs li:last-of-type {
      margin-right: 0; }

.tab-content {
  overflow: hidden; }
  .tab-content img {
    width: 100%;
    -webkit-animation-name: opacity;
            animation-name: opacity;
    -webkit-animation-duration: .3s;
            animation-duration: .3s; }
.product-card {
    width: 320px;
    position: relative;
    box-shadow: 0 2px 7px #dfdfdf;
    margin: 20px;
    background: #fafafa;
  }
.card {
  margin-top: 50px;
  background: #eee;
  padding: 3em;
  line-height: 1.5em; }

@media screen and (min-width: 997px) {
  .wrapper {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex; } }

.details {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -webkit-flex-direction: column;
      -ms-flex-direction: column;
          flex-direction: column; }

.colors {
  -webkit-box-flex: 1;
  -webkit-flex-grow: 1;
      -ms-flex-positive: 1;
          flex-grow: 1; }

.product-title, .price, .sizes, .colors {
  text-transform: UPPERCASE;
  font-weight: bold; }

.checked, .price span {
  color: #ff9f1a; }

.product-title, .rating, .product-description, .price, .vote, .sizes {
  margin-bottom: 15px; }

.product-title {
  margin-top: 0; }

.size {
  margin-right: 10px; }
  .size:first-of-type {
    margin-left: 40px; }

.color {
  display: inline-block;
  vertical-align: middle;
  margin-right: 10px;
  height: 2em;
  width: 2em;
  border-radius: 2px; }
  .color:first-of-type {
    margin-left: 20px; }

.add-to-cart, .like {
  background: #ff9f1a;
  padding: 1.2em 1.5em;
  border: none;
  text-transform: UPPERCASE;
  font-weight: bold;
  color: #fff;
  -webkit-transition: background .3s ease;
          transition: background .3s ease; }
  .add-to-cart:hover, .like:hover {
    background: #b36800;
    color: #fff; }

.not-available {
  text-align: center;
  line-height: 2em; }
  .not-available:before {
    font-family: fontawesome;
    content: "\f00d";
    color: #fff; }

.orange {
  background: #ff9f1a; }

.green {
  background: #85ad00; }

.blue {
  background: #0076ad; }

.tooltip-inner {
  padding: 1.3em; }

@-webkit-keyframes opacity {
  0% {
    opacity: 0;
    -webkit-transform: scale(3);
            transform: scale(3); }
  100% {
    opacity: 1;
    -webkit-transform: scale(1);
            transform: scale(1); } }

@keyframes opacity {
  0% {
    opacity: 0;
    -webkit-transform: scale(3);
            transform: scale(3); }
  100% {
    opacity: 1;
    -webkit-transform: scale(1);
            transform: scale(1); } }

.container {
    max-width: 600px;
    margin: 20px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    color: #333;
}

h2 {
    color: #333;
}

.warning {
    background-color: #f8d7da;
    color: #721c24;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 20px;
}

.warning a {
    color: #721c24;
    text-decoration: underline;
}

.product {
/*    display: flex;*/
    align-items: center;
    margin-bottom: 15px;
}

.product img {
    width: 50px;
    height: 50px;
    margin-right: 10px;
}

.product-info {
    flex: 1;
}

.price {
    color: #333;
    font-weight: bold;
}

.total, .payment-methods {
    margin-top: 20px;
}

.buy {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: #333;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

.buy:hover {
    background-color: red;
}
#product-table {
  width: 100%;
  border-collapse: collapse;
  margin: 20px 0;
  font-size: 18px;
  text-align: left;
}

#product-table th, #product-table td {
  padding: 12px 15px;
}

#product-table th {
  background-color: #333;
  color: #ffffff;
  text-align: center;
}

#product-table tr {
  border-bottom: 1px solid #333;
}

#product-table tr:nth-of-type(even) {
  background-color: #f3f3f3;
}

#product-table tr:last-of-type {
  border-bottom: 2px solid #333;
}

#product-table td img {
  max-width: 50px;
  height: auto;
  display: block;
  margin: auto;
}
 .address {
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        padding: 15px;
        margin-top: 20px;
        border-radius: 5px;
    }

    .address h3 {
        color: #333;
        font-size: 18px;
        margin-bottom: 8px;
    }

    .address fieldset {
    border: 1px solid #ccc;
    padding: 8px;
    margin-bottom: 8px;
    border-radius: 5px;
    display: inline-block; /* Change from block to inline-block */
}

    .address fieldset legend {
        font-size: 14px;
        font-weight: bold;
        margin-bottom: 6px;
    }

    .address p {
        margin-bottom: 4px;
    }
/*# sourceMappingURL=style.css.map */
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
    <button class="btn cart" type="button">
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
      <center>
        <a href="#">
            <i class="fas fa-user"></i> <!-- User icon -->
            My Account
        </a>
        <a href="#">
            <i class="fas fa-cog"></i> <!-- Cog icon -->
            Account Settings
        </a>
        <a data-toggle="modal" data-target="#registrationSuccessModal" href="">
            <i class="fas fa-sign-out-alt"></i> <!-- Sign-out icon -->
            Log Out
        </a>
        </center>
    </div>
</div>

<main style="background-color: ghostwhite; padding-bottom: 50px; margin-right: 20px; margin-left: 20px; margin-top: 30px;">
  <br>
  <div style="background-color:darkgrey; margin-top: 0px; margin-right: 35px; margin-left: 35px; padding-bottom: 5px; padding-top: 5px; ">
  <h2 align="center" style=" margin-bottom: 0px; font-family: arial;font-weight: bold;">Check Out</h2>
  </div>
  <center>
<div class="cart-container" style="width:850px;">
    <form class="purchase-form" action="purchase-items.php" method="POST">
      <hr>
      <div align="left">
      <h3>Billing Address</h3>
      <div align="left">
        <a href="add_address.php" style="color:red">Add Address</a>
      </div>
      <div class="address" align="left">
        <?php
        // Query to fetch the user's address details
        $addressQuery = "SELECT * FROM users_delivery_address WHERE id = $userID";
        $addressResult = $conn->query($addressQuery);

        if ($addressResult->num_rows > 0) {
            while ($address = $addressResult->fetch_assoc()) {
                ?>
                <fieldset>
                    <legend>
                        <input type="radio" name="addressID" value="<?= htmlspecialchars($address['address_id']); ?>" required>
                    </legend>
                    <p>Name: <strong><?= htmlspecialchars($address['first_name'] . ' ' . $address['last_name']); ?></strong></p>
                    <p>Full Address: <strong><?= htmlspecialchars($address['address']); ?></strong></p>
                    <p>Zip Code: <strong><?= htmlspecialchars($address['zip_code']); ?></strong></p>
                    <p>Region: <strong><?= htmlspecialchars($address['region']); ?></strong></p>
                    <p>City/Municipality: <strong><?= htmlspecialchars($address['city_municipality']); ?></strong></p>
                    <p>Province: <strong><?= htmlspecialchars($address['province']); ?></strong></p>
                    <p>Contact Number: <strong><?= htmlspecialchars($address['contact_number']); ?></strong></p>
                </fieldset>
                <?php
            }
        } else {
            echo "<p>No address found.</p>";
        }
        ?>
      </div>
    </div>
      <hr>
      <div align="left">
      <h3>Selected Items</h3>
      <table id="product-table" style="text-align:center;">
        <thead>
          <tr>
            <th>Product Image</th>
            <th>Product Name</th>
            <th>Size</th>
            <th>Price</th>
            <th>Quantity</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $subtotal = 0;
          $totalItems = 0;
          foreach ($items as $index => $item): 
            $price = floatval($item['price']);
            $quantity = intval($item['quantity']);
            $subtotal += $price * $quantity;
            $totalItems += $quantity;
          ?>
            <tr>
              <td><img src="img/products/<?php echo $item['main_image']; ?>" alt="Product Image"></td>
              <td><?php echo $item['name']; ?></td>
              <td><?php echo $item['size']; ?></td>
              <td>$<?php echo number_format($price, 2); ?></td>
              <td><?php echo $quantity; ?></td>
              <input type="hidden" name="items[<?php echo $index; ?>][serial_id]" value="<?php echo $item['serial_id']; ?>">
              <input type="hidden" name="items[<?php echo $index; ?>][quantity]" value="<?php echo $quantity; ?>">
              <input type="hidden" name="items[<?php echo $index; ?>][price]" value="<?php echo number_format($price, 2); ?>">
              <input type="hidden" name="items[<?php echo $index; ?>][size]" value="<?php echo $item['size']; ?>">
              <input type="hidden" name="items[<?php echo $index; ?>][cart_id]" value="<?php echo $item['cart_id']; ?>">
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
      <hr>
      <div align="right">
        <p>Total Items: <span id="totalItems" style="color: green"><?php echo $totalItems; ?></span></p>
        <p>Subtotal: <span id="subTotal" style="color: green">$<?php echo number_format($subtotal, 2); ?></span></p>
        <input type="hidden" name="subTotal" value="<?php echo number_format($subtotal, 2); ?>">
      </div>
      <div class="payment-options" align="left">
        <h3>Payment Options</h3>
            <input type="radio" id="credit-card" name="mode_payment" value="Pick Up on Store" required>
            <label for="credit-card">Pick Up on Store</label><br>

            <input type="radio" id="cash-on-delivery" name="mode_payment" value="Cash on Delivery" required>
            <label for="cash-on-delivery">Cash on Delivery</label><br>
      </div>
         <hr>
      <button type="submit" class="buy">Purchase</button>
    </form>
  </div>
</center>
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
</main>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        // Show the success modal
        $("#successModal").modal("show");
    });
</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="index.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="index.js"></script>
<script>
  function updateAddToCartButton() {
        var selectedSize = document.getElementById('size').value;
        var addToCartButton = document.querySelector('.add-to-cart');

        if (selectedSize === 'none') {
            addToCartButton.disabled = true;
        } else {
            addToCartButton.disabled = false;
        }
    }

    // Add event listener to the size select element
    document.getElementById('size').addEventListener('change', updateAddToCartButton);

    // Call the function initially to set the initial state of the button
    updateAddToCartButton();
    
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
<?php





?>
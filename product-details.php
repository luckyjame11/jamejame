<?php
session_start();

// Check if user is logged in
if(empty($_SESSION['loggedUser'])){
    header('Location: Log-in-Form.php');
    exit;
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dimefootwear";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Check if item is added to cart successfully

// Check if product ID is provided and valid
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $productId = $_GET['id'];

    // Fetch product details
    $sql = "SELECT * FROM product WHERE serial_id = $productId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Prepare image array
        $images = [];
        $images[] = $row["main_image"]; // Add main image first
        if (!empty($row["sub_image2"])) $images[] = $row["sub_image2"];
        if (!empty($row["sub_image3"])) $images[] = $row["sub_image3"];
        if (!empty($row["sub_image4"])) $images[] = $row["sub_image4"];
        if (!empty($row["sub_image5"])) $images[] = $row["sub_image5"];

        // // Fetch stock details
        // $stockSql = "SELECT * FROM stocks WHERE serial_id = $productId";
        // $stockResult = $conn->query($stockSql);
        // $sizesAvailable = false;
        // if ($stockResult->num_rows > 0) {
        //     $stock = $stockResult->fetch_assoc();
        //     foreach ($stock as $key => $value) {
        //         if (strpos($key, 'size_') === 0 && $value > 0) {
        //             $sizesAvailable = true;
        //             break;
        //         }
        //     }
        // }
        $formattedPrice = number_format($row["price"], 2);


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
      <center>
        <a href="myAccount.php">
            <i class="fas fa-user"></i> <!-- User icon -->
            My Account
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
  <h2 align="center" style=" margin-bottom: 0px; font-family: arial;font-weight: bold;">PRODUCT DETAILS</h2>
  </div>
 <div class="container">
   <form action="add-to-cart.php" method="POST">
    <div class="row mt-5">
        <div class="col-md-6">
          <input type="hidden" name="userId" value="<?php echo $_SESSION['userID']; ?>">
    <input type="hidden" name="serial_id" value="<?php echo $row['serial_id']; ?>">
            <!-- Bootstrap Carousel -->
            <div id="productCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <?php foreach ($images as $index => $image): ?>
                    <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                        <img src="img/products/<?php echo $image; ?>" class="d-block w-100" alt="Product Image">
                    </div>
                    <?php endforeach; ?>
                </div>
                <a class="carousel-control-prev" href="#productCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#productCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
      <div class="col-md-6" style="margin-top:60px">
        <h3><?php echo $row["brand"]; ?>- <?php echo $row["classification"]; ?></h3>
        <h3 class="product-title"><?php echo $row["name"]; ?></h3>
        <p class="product-description"><?php echo $row["product_details"]; ?></p>
       
        <h3 class="price">Current price: ₱<?php echo $formattedPrice; ?></h3>
        <h5>Select a Size:</h5>
  <h5 class="sizes">Sizes:
  <?php 
  $sql = "SELECT size, quantity FROM shoe_stocks WHERE serial_id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $productId);
  $stmt->execute();
  $result = $stmt->get_result();

  $sizesAvailable = $result->num_rows > 0;
  $stock = [];
  while ($row = $result->fetch_assoc()) {
      $stock[$row['size']] = $row['quantity'];
  }

  $stmt->close();
  $conn->close();  
  ?>
  <select name="size" id="size" required>
    <option value="" disabled selected>Select a Size:</option>
    <?php if ($sizesAvailable) { ?>
      <?php foreach ($stock as $size => $quantity) { ?>
        <?php if ($quantity > 0) { ?>
          <option value="<?php echo $size; ?>"><?php echo $size; ?> (Stock: <?php echo $quantity; ?>)</option>
        <?php } else { ?>
          <option value="<?php echo $size; ?>" disabled><?php echo $size; ?> (Out of stock)</option>
        <?php } ?>
      <?php } ?>
    <?php } else { ?>
      <option value="none" disabled>Out of stock</option>
    <?php } ?>
  </select>
</h5>

        <div class="action">
        <div class="action">
          <button class="add-to-cart btn btn-default" type="submit" style="text-decoration: none;">Add to cart</button>
        </div>
      </div>
    </div>
  </div>
  </form>
   <div class="" style="margin-top:50px;">
        <?php include 'product-card.php'; ?>
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
</main>
<?php 
 if(isset($_SESSION['cartItemAdded']) && $_SESSION['cartItemAdded']) {
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
                    Item added to cart successfully
                </div>
            </div>
        </div>
    </div>';

    // Reset session variable
    $_SESSION['cartItemAdded'] = false;
}

?>
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
   function redirectToCart() {
    window.location.href = 'myCart.php';
  }
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
    } else {
        echo "Product not found.";
    }
} else {
    echo "Invalid product ID.";
}

$conn->close();


?>
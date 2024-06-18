<?php
session_start();
$_SESSION['userID'];

if (empty($_SESSION['userID'])) {
    header('Location: Log-in-Form.php');
    exit;
}

// Connect to your database (replace with your actual database connection code)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dimefootwear";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



// Fetch products from the cart associated with the user ID
$userID = $_SESSION['userID'];

// Fetch products from the cart associated with the user ID along with product information
$stmt = $conn->prepare("SELECT c.*, p.name, p.price, p.main_image FROM cart c 
                        INNER JOIN product p ON c.serial_id = p.serial_id 
                        WHERE c.id = ?");
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();
$message = "";
$cartItems = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cartItems[] = $row;
    }
    $message = "";
} else {
    $message = "No Items in you Cart";
}
$stmt->close();


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

  <link rel="stylesheet" type="text/css" href="product-card.css">
  <link rel="stylesheet" type="text/css" href="mycart.css">
<script src="product-card.js"></script>
<script>
function updateTotal() {
    var totalItems = 0;
    var subTotal = 0;

    var rows = document.querySelectorAll('.mycart table tr');
    rows.forEach(function(row) {
        var checkbox = row.querySelector('.item_checkbox');
        var quantityInput = row.querySelector('#quantity');
        var priceElement = row.querySelector('#price');

        if (checkbox && checkbox.checked && priceElement && quantityInput) {
            var price = parseFloat(priceElement.textContent.replace('$', '').replace(',', ''));
            var quantity = parseInt(quantityInput.value);
            if (!isNaN(quantity) && quantity > 0) {
                totalItems += quantity;
                subTotal += price * quantity;
            }
        }
    });

    var totalItemsElement = document.getElementById('totalItems');
    var subTotalElement = document.getElementById('subTotal');
    if (totalItemsElement && subTotalElement) {
        totalItemsElement.textContent = totalItems;
        subTotalElement.textContent = '$' + subTotal.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }
}

function attachListeners() {
    var quantityInputs = document.querySelectorAll('#quantity');
    var checkboxes = document.querySelectorAll('.item_checkbox');

    quantityInputs.forEach(function(input) {
        input.addEventListener('input', updateTotal);
    });

    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', updateTotal);
    });
}

document.addEventListener('DOMContentLoaded', function() {
    updateTotal();
    attachListeners();
});
</script>

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
    color: black;
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
       
        <a href="#">
            <i class="fas fa-sign-out-alt"></i> <!-- Sign-out icon -->
            Log Out
        </a>
    </div>
</div>

<main style="background-color: ghostwhite; padding-bottom: 250px; margin-right: 20px; margin-left: 20px; margin-top: 30px;">
  <br>
  <div style="background-color:darkgrey; margin-top: 0px; margin-right: 35px; margin-left: 35px; padding-bottom: 5px; padding-top: 5px; ">
  <h2 align="center" style=" margin-bottom: 0px; font-family: arial;font-weight: bold;">MY CART</h2>
  </div>
  <center>
    <br>
    <div class="mycart">
        <form id="cartForm" action="check-out-order.php" method="post">
            <table style="text-align:center;">
                <tr>
                    <th></th>
                    <th></th>
                    <th>Product Name</th>
                    <th>Size</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
                <?php if (!empty($cartItems)): ?>
                    <?php foreach ($cartItems as $item): ?>
                        <tr>
                            <td><input type="checkbox" class="item_checkbox" name="checkedItems[]" value="<?= htmlspecialchars($item["cart_id"]); ?>"></td>
                            <input type="hidden" name="serial_id[]" value="<?= htmlspecialchars($item["serial_id"]); ?>">
                            <input type="hidden" name="cart_id[]" value="<?= htmlspecialchars($item["cart_id"]); ?>">
                            <input type="hidden" name="id[]" value="<?= htmlspecialchars($item["id"]); ?>">
                            <input type="hidden" name="name[]" value="<?= htmlspecialchars($item["name"]); ?>">
                            <input type="hidden" name="main_image[]" value="<?= htmlspecialchars($item["main_image"]); ?>">
                            <input type="hidden" name="price[]" value="<?= htmlspecialchars($item["price"]); ?>">
                            <input type="hidden" name="size[]" value="<?= htmlspecialchars($item["size"]); ?>">
                            <td><a href="product-details.php?id=<?= $item["serial_id"]; ?>"><img src="img/products/<?= $item['main_image']; ?>" alt="Product Image"></a></td>
                            <td><a href="product-details.php?id=<?= $item["serial_id"]; ?>"><?= $item['name']; ?></a></td>
                            <td><?= $item['size']; ?></td>
                            <td><input type="number" name="Quantity[]" min="1" id="quantity" required></td>
                            <td><span id="price" style="color: green">$<?= number_format($item["price"], 2, '.', ','); ?></span></td>
                            <td><button><a href="remove-from-cart.php?id=<?= $item["cart_id"]; ?>">REMOVE</a></button></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </table>
            <br>
            <h1><?php echo $message; ?></h1>
            <div class="billing" style="background-color: lightgrey; padding: 10px; width: 30%; text-align: right;" id="billing">
                <h3 align="center">ORDER SUMMARY</h3>
                <p>Sub Total:<span id="subTotal">$0.00</span></p>
                <p>Total Items:<span id="totalItems">0</span></p>
                <center><button align="center" type="submit">Check Out</button></center>
            </div>
        </form>
    </div>
  </center>
</main>




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

window.addEventListener("scroll", function() {
  var element = document.getElementById("billing");
  var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
  var viewportHeight = window.innerHeight; // Height of the viewport
  var contentHeight = document.body.clientHeight; // Height of the content

  // Calculate the position based on the scroll distance and viewport height
  var position = Math.max(250, scrollTop + (viewportHeight / 2));

  if (contentHeight > viewportHeight) {
    // If content height exceeds viewport height, use absolute positioning
    element.style.transition = "top 0.3s ease";
    element.style.position = "absolute";
    element.style.top = "calc(" + position + "px - 85px)";
  } else {
    // If content height is less than viewport height, use fixed positioning
    element.style.transition = "top 0.3s ease";
    element.style.position = "fixed";
    element.style.top = "calc(" + position + "px - 85px)";
  }
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
 


$conn->close();

?>
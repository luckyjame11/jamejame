<?php
// Establish database connection 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dimefootwear";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$selectedBrand = "jordan";
// Fetch product data
$sql = "SELECT * FROM product WHERE classification = 'sports'";
$result = $conn->query($sql);

// Generate product cards
while ($row = $result->fetch_assoc()) {
    // Format the price with commas
    $formattedPrice = number_format($row["price"], 2, '.', ',');
?>
    <div class="product-card">
          <div class="product-tumb">
            <img src="img/products/<?php echo $row["main_image"]; ?>" alt="<?php echo $row["name"]; ?>"> 
        </div>
        <div class="product-details">
            <span class="product-catagory"><?php echo $row["classification"]; ?>&nbsp  —  &nbsp<?php echo $row["brand"]; ?> </span> 
            <h4><a href="product-details.php?id=<?php echo $row["serial_id"]; ?>"><?php echo $row["name"]; ?></a></h4>      
            <div class="product-bottom-details">
                <div class="product-price">₱<?php echo $formattedPrice; ?></div>
                <div class="product-links">
                    <a href="#"><i class="fa fa-heart"></i></a>
                    <a href="#"><i class="fa fa-shopping-cart"></i></a>
                </div>
            </div>
        </div>
    </div>
<?php
}

$conn->close();
?>

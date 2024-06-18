<?php
// Initialize variables
$serial_id = $_GET['serial_id'] ?? '';
$brand = $_GET['brand'] ?? '';
$name = $_GET['name'] ?? '';

// Include your database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dimefootwear";

try {
    // Create a PDO instance
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}

// Fetch product data based on serial_id
if (!empty($serial_id)) {
    $query = "SELECT * FROM product WHERE serial_id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$serial_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        $serial_id = $product['serial_id'];
        $name = $product['name'];
        $brand = $product['brand'];
        $product_details = $product['product_details'];
        $classification = $product['classification'];
        $price = $product['price'];
    } else {
        echo "Product not found.";
        exit();
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from POST request
    $serial_id = $_POST['serial_id'];
    $name = $_POST['name'];
    $brand = $_POST['brand'];
    $product_details = $_POST['product_details'];
    $classification = $_POST['classification'];
    $price = $_POST['price'];

    // Update query using PDO
    $update_query = "UPDATE product SET name=?, brand=?, product_details=?, classification=?, price=? WHERE serial_id=?";
    $stmt = $pdo->prepare($update_query);

    if ($stmt->execute([$name, $brand, $product_details, $classification, $price, $serial_id])) {
        echo "<script>
                    alert('Product Updated Successfully!');
                    window.location.href = 'admin-all-product.php'; // Redirect to add product page
                    </script>";
    } else {
        echo "Error updating product.";
    }
} else {
    echo "No product specified.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
     <link rel="stylesheet" type="text/css" href="admin.css">
    <style>
        /* Your CSS styles */
        i { color: white; }
        span { color: white; }
        i:hover, span:hover, a:hover { color: #443f38; }
        .nav-pills .nav-link { width: 200px; }
        .nav-pills .nav-link:hover { background-color: #6c757d; transition: background-color 0.3s ease, padding 0.3s ease; }
        .nav-link.active { background-color: #6c757d; }
        .main { padding: 20px; }
        .panel { border: 1px solid #ccc; border-radius: 5px; padding: 20px; margin-bottom: 20px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { font-weight: bold; }
        .form-control-file { width: 100%; }
        .preview-image { max-width: 200px; margin-top: 10px; margin-left:10px }
        .btn-add { margin-top: 10px; }
        .sub-images-preview { margin-top: 5px; }
        .sub-images-label, .sub-image-label { font-weight: bold; }
        .sub-image-container { margin-bottom: 10px; }
        .log-button {
            position: fixed;
            bottom: 20px;
            left: 20px;
            z-index: 9999; /* Ensure it's on top of other elements */
        }
       .log-button {
            position: absolute;
            bottom: 20px;
            left: 20px;
            z-index: 9999; /* Ensure it's on top of other elements */
        }

        .log-out {
            background-color: #dc3545; /* Red color */
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .log-out:hover {
            background-color: #c82333; /* Darker red on hover */
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0" style="background-color: #443f38;">
    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
        <a href="#" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-5 d-none d-sm-inline"></span>
        </a>
        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
            <!-- <li class="nav-item">
                <a href="#" class="nav-link align-middle px-0">
                    <i class="fs-4 bi-house" name="logo"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                </a>
            </li> -->
            <li>
                <a href="dashboard.php" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                    <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#submenu" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                    <i class="fs-4 bi bi-box-seam"></i> <span class="ms-1 d-none d-sm-inline">Orders</span>
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start collapse" id="submenu">
                    <li class="w-100">
                        <a href="delivered-orders.php" class="nav-link px-0"> <i class="bi bi-check-square-fill"></i> <span class="d-none d-sm-inline">Delivered</span> </a>
                    </li>
                    <li>
                        <a href="pending-orders.php" class="nav-link px-0"> <i class="bi bi-clock-history"></i> <span class="d-none d-sm-inline">Pending</span> </a>
                    </li>
                    <li>
                        <a href="returned-orders.php" class="nav-link px-0"><i class="bi bi-arrow-return-left"></i> <span class="d-none d-sm-inline">Returns</span> </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                    <i class="fs-4 bi bi-receipt"></i> <span class="ms-1 d-none d-sm-inline">Invoice Report</span>
                </a>
                <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                    <li class="w-100">
                        <a href="individual-receipts.php" class="nav-link px-0"> <i class="bi bi-receipt-cutoff"></i> <span class="d-none d-sm-inline">Individual Receipts</span> </a>
                    </li>
                    <li>
                        <a href="overall-report.php" class="nav-link px-0"><i class="bi bi-file-earmark-bar-graph"></i> <span class="d-none d-sm-inline">Overall Reports</span> </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                    <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">Products</span>
                </a>
                <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                    <li class="w-100">
                        <a href="admin-add-product.php" class="nav-link px-0"> <i class="bi bi-plus"></i> <span class="d-none d-sm-inline">Add Product</span> </a>
                    </li>
                    <li class="w-100">
                        <a href="no-stocks-orders.php" class="nav-link px-0"> <i class="bi bi-x"></i> <span class="d-none d-sm-inline">No Stocks</span> </a>
                    </li>
                    <li>
                        <a href="high-stocks.php" class="nav-link px-0"> <i class="bi bi-arrow-up-circle"></i> <span class="d-none d-sm-inline">High Stocks</span> </a>
                    </li>
                    <li>
                        <a href="admin-all-product.php" class="nav-link px-0"> <i class="bi bi-list"></i> <span class="d-none d-sm-inline">All Stocks</span> </a>
                    </li>
                </ul>
            </li>
        </ul>
        <hr>
        <div class="log-button">
            <button class="log-out"><a href="log_out.php" style="text-decoration:none; color: white;">Log Out</a></button>
        </div>
    </div>
</div>
            <div class="col py-3">
                <div class="main">
                    <div class="container">
                        <h1>Edit Product</h1>
                        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                            <div class="mb-3">
                                <label for="serial_id" class="form-label">Serial ID</label>
                                <input type="text" class="form-control" id="serial_id" name="serial_id" value="<?php echo htmlspecialchars($serial_id); ?>" readonly >
                            </div>
                            <div class="mb-3 row">
                                <div class="col">
                                    <label for="current_name" class="form-label">Product Name</label>
                                    <input type="text" class="form-control" id="current_name" name="current_name" value="<?php echo htmlspecialchars($name); ?>" disabled>
                                </div>
                                <div class="col">
                                    <label for="new_name" class="form-label">New Product Name</label>
                                    <input type="text" class="form-control" id="new_name" name="name">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col">
                                     <label for="current_brand" class="form-label">Brand</label>
                                      <input type="text" class="form-control" id="current_brand" name="current_brand" value="<?php echo htmlspecialchars($brand); ?>" disabled>
                                </div>
                                <div class="col">
                                    <label for="brand" class="form-label">New Brand</label>
                                    <select class="form-control" id="brand" name="brand" required>
                                        <option value="" disabled selected>Select a brand</option>
                                        <option value="Nike">Nike</option>
                                        <option value="Adidas">Adidas</option>
                                        <option value="Puma">Puma</option>
                                        <option value="Anta">Anta</option>
                                        <option value="New Balance">New Balance</option>
                                        <option value="Under Armour">Under Armour</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col">
                                     <label for="current_product_details" class="form-label">Product Details</label>
                                     <textarea class="form-control" id="current_product_details" name="current_product_details" disabled><?php echo htmlspecialchars($product_details); ?></textarea>
                                </div>
                                <div class="col">
                                    <label for="product_details" class="form-label">New Product Details</label>
                                    <textarea class="form-control" id="product_details" name="product_details"></textarea>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col">
                                     <label for="current_classification" class="form-label">Classification</label>
                                    <input type="text" class="form-control" id="current_classification" name="current_classification" value="<?php echo htmlspecialchars($classification); ?>" disabled>
                                </div>
                                <div class="col">
                                     <label for="classification" class="form-label">New Classification</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="classification" id="Lifestyle" value="Lifestyle" required>
                                            <label class="form-check-label" for="Lifestyle">Lifestyle</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="classification" id="Sports" value="Sports" required>
                                            <label class="form-check-label" for="Sports">Sports</label>
                                        </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col">
                                     <label for="current_price" class="form-label">Price</label>
                                      <input type="text" class="form-control" id="current_price" name="current_price" value="<?php echo htmlspecialchars($price); ?>" disabled>
                                </div>
                                <div class="col">
                                    <label for="price" class="form-label">New Price</label>
                                   <input type="text" class="form-control" id="price" name="price">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" style="float: right" name="submit">Update Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer style="text-align: center; background: lightgray; padding: 10px;">
        <p style="margin-bottom: 0px;">Disclaimer for School Purposes</p>
    </footer>
    <script>
       // Your JavaScript code
       document.querySelectorAll('.nav-link[data-bs-toggle="collapse"]').forEach(item => {
            item.addEventListener('click', function(event) {
                const submenuId = this.getAttribute('href');
                const submenu = document.querySelector(submenuId);
                if (submenu.classList.contains('show')) {
                    submenu.classList.remove('show');
                } else {
                    // Hide other open submenus
                    document.querySelectorAll('.collapse.show').forEach(openSubmenu => {
                        openSubmenu.classList.remove('show');
                    });
                    submenu.classList.add('show');
                }
            });
        });
    </script>
</body>
</html>

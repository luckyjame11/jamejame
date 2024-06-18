  
<?php 

// session_start();
// $_SESSION['userID'];
// $_SESSION['loggedUser'];

// if(empty($_SESSION['loggedUser'])){
//     header('Location: Log-in-Form.php');
//     exit;
// }
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
  ?><!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>All Products</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <style>
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
             .collapse {
            transition: height 0.3s ease;
        }
            .table-container {
                max-height: 650px; /* Adjust the height as needed */
                overflow-y: auto;
            }
                 .about-section {
                background-color: #f8f9fa;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            .order-item-box {
                background-color: #fff;
                border: 1px solid #ddd;
                border-radius: 5px;
                padding: 15px;
                margin-bottom: 10px;
                box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            }
            .order-item-box img {
                max-width: 100px;
                margin-right: 10px;
                float: left;
            }
            .order-item-box p {
                margin: 0;
                padding: 0;
            }
             .Update-Order-btn input[type="submit"] {
            background-color: #4CAF50; /* Green background */
            color: white; /* White text */
            border: none; /* No border */
            padding: 10px 20px; /* Padding */
            border-radius: 5px; /* Rounded corners */
            cursor: pointer; /* Pointer cursor on hover */
            font-size: 16px; /* Font size */
            transition: background-color 0.3s ease, transform 0.3s ease; /* Smooth transition */
        }

        .Update-Order-btn input[type="submit"]:hover {
            background-color: #45a049; /* Darker green background on hover */
            transform: scale(1.05); /* Slightly enlarge on hover */
        }
         /* Style for select element */
        #searchStatusSelect {
            width: auto; /* Auto width */
            padding: 10px; /* Padding */
            border: 1px solid #ccc; /* Border */
            border-radius: 5px; /* Rounded corners */
            font-size: 16px; /* Font size */
            appearance: none; /* Remove default appearance */
            background-color: #f9f9f9; /* Light background */
            transition: border-color 0.3s ease; /* Smooth transition for border color */
        }

        #searchStatusSelect:focus {
            border-color: #4CAF50; /* Green border on focus */
            outline: none; /* Remove outline */
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
                        <div class="about-section">
                            <div class="container">
                              <div class="row">
                                <div align="center">
                                    <form action="update-order.php" method="POST">
                                        <div style="display: inline-block;" align="center">
                                            <h4>Select Order Status:</h4>
                                            <input type="hidden" name="orderID" value="<?php echo $orderID ?>">
                                            <select class="form-control me-2" id="searchStatusSelect" style="width:auto;" name="searchStatusSelect" required>
                                                <option value="">Select Status</option>
                                                <option value="Pending">Pending</option>
                                                <option value="Packing the Item/s">Packing the Item/s</option>
                                                <option value="Ready to be Shipped">Ready to be Shipped</option>
                                                <option value="Handed to the Courrier">Handed to the Courrier</option>
                                                <option value="Already been Shipped">Already been Shipped</option>
                                                <option value="Ready To Be Delivered">Ready To Be Delivered</option>
                                                <option value="Delivered">Delivered</option>
                                                <option value="Canceled">Canceled</option>
                                                <option value="Returned">Returned</option>
                                            </select>
                                        </div>
                                        <div style="display: inline-block;" class="Update-Order-btn">
                                            <input type="submit" name="submit" value="Update Order">
                                        </div>
                                    </form>
                                    <br>
                                </div>
                                <button class="btn btn-primary mb-3" onclick="window.location.href='generate_pdf.php?order_id=<?= $orderID ?>'">Print Order Slip</button>
              
                                <div class="col-md-6">
                                  <h2>Order Details</h2>
                                  <div class="address-box" align="left">
                                    <h4>Order #<?= $order['order_id']; ?></h4>
                                    <p><strong>Order Date:</strong> <?= date('F j, Y', strtotime($order['order_date'])); ?></p>
                                    <p><strong>Total Amount:</strong> <?= '$' . number_format($order['total_amount'], 2); ?></p>
                                    <p><strong>Status:</strong> <?= htmlspecialchars($order['status']); ?></p>
                                    <p><strong>Delivered Date:</strong> <?= $order['date_delivered'] == '0000-00-00 00:00:00' ? 'Not Yet' : date('F j, Y', strtotime($order['date_delivered'])); ?></p>

                                    <h2><strong>Delivery Address:</strong></h2>
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
                                        <img src="img/products/<?= htmlspecialchars($item['main_image']); ?>" alt="<?= htmlspecialchars($item['product_name']); ?>" style="width: 45%;" class="product-image">
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
                    </div>
                </div>
            </div>
            </div>
        </div>
        <footer style="text-align: center; background: lightgray; padding: 10px;">
            <p style="margin-bottom: 0px;">Disclaimer for School Purposes</p>
        </footer>
        <script>
    // Corrected section for adding event listeners to the "View Details" buttons
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

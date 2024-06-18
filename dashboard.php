 <?php

// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$database = "dimefootwear";

// Create a new database connection
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data for orders, pending, delivered, returned
$sql_orders = "SELECT COUNT(*) AS total_orders FROM orders";
$result_orders = $conn->query($sql_orders);
$total_orders = ($result_orders && $result_orders->num_rows > 0) ? $result_orders->fetch_assoc()['total_orders'] : 0;

$sql_pending = "SELECT COUNT(*) AS total_pending FROM orders WHERE status = 'Pending'";
$result_pending = $conn->query($sql_pending);
$total_pending = ($result_pending && $result_pending->num_rows > 0) ? $result_pending->fetch_assoc()['total_pending'] : 0;

$sql_delivered = "SELECT COUNT(*) AS total_delivered FROM orders WHERE status = 'Delivered'";
$result_delivered = $conn->query($sql_delivered);
$total_delivered = ($result_delivered && $result_delivered->num_rows > 0) ? $result_delivered->fetch_assoc()['total_delivered'] : 0;

$sql_returned = "SELECT COUNT(*) AS total_returned FROM orders WHERE status = 'Returned'";
$result_returned = $conn->query($sql_returned);
$total_returned = ($result_returned && $result_returned->num_rows > 0) ? $result_returned->fetch_assoc()['total_returned'] : 0;

// Fetch product information
$sql_products = "SELECT * FROM product";
$result_products = $conn->query($sql_products);
$products = ($result_products && $result_products->num_rows > 0) ? $result_products->fetch_all(MYSQLI_ASSOC) : [];

// Close the database connection

?>


    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>DashBoard</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
/* Container styling */
.main {
  text-align: center; /* Center the content horizontally */
}

/* Dropdown container styling */
.date-select {
  display: flex;
  flex-direction: column;
  align-items: center; /* Center items horizontally */
  gap: 20px; /* Adjust the gap between dropdowns */
}

/* Dropdown styling */
.date-select select {
  padding: 12px 20px;
  border: 2px solid #ced4da;
  border-radius: 8px;
  background-color: #f8f9fa;
  color: #495057;
  cursor: pointer;
  width: 200px; /* Adjust the width of dropdowns */
  font-size: 16px; /* Adjust font size */
  transition: border-color 0.3s ease, background-color 0.3s ease;
}

/* Hover effect */
.date-select select:hover {
  border-color: #6c757d;
}

/* Focus effect */
.date-select select:focus {
  outline: none;
  border-color: #6c757d;
  box-shadow: 0 0 0 0.25rem rgba(108, 117, 125, 0.25);
}

/* Styling for the dropdown arrow */
.date-select select::-ms-expand {
  display: none;
}

/* Button styling */
.date-select input[type="submit"] {
  padding: 10px 20px;
  border: none;
  border-radius: 8px;
  background-color: #007bff;
  color: #fff;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

/* Button hover effect */
.date-select input[type="submit"]:hover {
  background-color: #0056b3;
}
/* Card container styling */
.card-container {
  display: inline-block; /* Change display to inline-block */
  margin: 20px;
  width: 300px;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  background-color: #fff;
}
/* Chart container styling */
.chart-container {
  margin-top: 20px;
}

.card {
    border: 1px solid #e5e5e5;
    border-radius: 10px;
    margin-bottom: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.card-body {
    padding: 20px;
}

.card h3 {
    margin-bottom: 20px;
    font-size: 20px;
    color: #333;
}

canvas {
    width: 100%;
    height: auto;
}




        </style>
    </head>
    <body>
        <div class="container-fluid" tyle="padding-left: 0px;padding-right: 0px;">
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
        <div class="Dashboard-Panel">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h3>Total Orders: <?php echo $total_orders; ?></h3>
                    <canvas id="ordersChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
        
    </div>
<?php

// Fetch demand for brand
$sql_brand_demand = "SELECT brand, COUNT(*) AS demand FROM product GROUP BY brand";
$result_brand_demand = $conn->query($sql_brand_demand);
$brand_demand = ($result_brand_demand && $result_brand_demand->num_rows > 0) ? $result_brand_demand->fetch_all(MYSQLI_ASSOC) : [];

// Fetch demand for size
$sql_size_demand = "SELECT size, COUNT(*) AS demand FROM shoe_stocks GROUP BY size";
$result_size_demand = $conn->query($sql_size_demand);
$size_demand = ($result_size_demand && $result_size_demand->num_rows > 0) ? $result_size_demand->fetch_all(MYSQLI_ASSOC) : [];

// Close the database connection
$conn->close();

 ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h3>Brand On Stocks</h3>
                    <canvas id="brandDemandChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h3>Size on Stocks</h3>
                    <canvas id="sizeDemandChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>


            </div>
        </div>
        <footer style="text-align: center; background: lightgray; padding: 10px;">
            <p style="margin-bottom: 0px;">Copyright All Reserved - 2024</p>
        </footer>
        <script>
            // Function to generate random colors
function generateRandomColor() {
    return '#' + Math.floor(Math.random() * 16777215).toString(16);
}

// Function to draw charts
function drawChart(id, labels, data, backgroundColor) {
    var ctx = document.getElementById(id).getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: '',
                data: data,
                backgroundColor: backgroundColor,
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

// Data for charts
var brandLabels = [];
var brandData = [];
var brandColors = [];
<?php foreach ($brand_demand as $brand) : ?>
    brandLabels.push('<?php echo $brand['brand']; ?>');
    brandData.push('<?php echo $brand['demand']; ?>');
    brandColors.push(generateRandomColor());
<?php endforeach; ?>

var sizeLabels = [];
var sizeData = [];
var sizeColors = [];
<?php foreach ($size_demand as $size) : ?>
    sizeLabels.push('<?php echo $size['size']; ?>');
    sizeData.push('<?php echo $size['demand']; ?>');
    sizeColors.push(generateRandomColor());
<?php endforeach; ?>

// Draw charts
drawChart('brandDemandChart', brandLabels, brandData, brandColors);
drawChart('sizeDemandChart', sizeLabels, sizeData, sizeColors);

      function drawBarChart(id, labels, data, backgroundColor) {
            var ctx = document.getElementById(id).getContext('2d');
            var chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Orders',
                        data: data,
                        backgroundColor: backgroundColor,
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        // Data for total orders bar chart
        var ordersData = [<?php echo $total_orders; ?>, <?php echo $total_pending; ?>, <?php echo $total_delivered; ?>, <?php echo $total_returned; ?>];
        var ordersLabels = ['Total Orders', 'Pending Orders', 'Delivered Orders', 'Returned Orders'];
        var ordersBackgroundColor = ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0'];

        // Draw total orders bar chart
        drawBarChart('ordersChart', ordersLabels, ordersData, ordersBackgroundColor);       

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

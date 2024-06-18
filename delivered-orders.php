<!DOCTYPE html>
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
            <a href="dashboard.php" class="nav-link px-0 align-middle">
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
                    <h2>Delivered Products</h2>
                    <!-- Search Form -->
                    <form class="d-flex mb-3" method="GET" action="">
                           <input class="form-control me-2" type="search" placeholder="Search by Order ID" id="searchOrderIdInput">
                   
                        <button class="btn btn-outline-success" type="button" id="searchButton">Search</button>

                    </form>
                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ORDER ID:</th>
                                    <th>RECEIVER'S NAME:</th>
                                    <th>STATUS:</th>
                                    <th>ACTION:</th>
                                </tr>
                            </thead>
                            <tbody id="orderTableBody">
                                <!-- Order rows will be populated here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer style="text-align: center; background: lightgray; padding: 10px;">
        <p style="margin-bottom: 0px;">Copyright All Reserved - 2024</p>
    </footer>
    <script>
       document.addEventListener('DOMContentLoaded', function() {
    fetchDeliveredOrders();
});

function fetchDeliveredOrders() {
    fetch('search-for-orders.php')
        .then(response => response.json())
        .then(data => {
            const deliveredOrders = data.filter(order => order.status === 'Delivered');
            renderOrders(deliveredOrders);
            addViewDetailsEventListeners();
        })
        .catch(error => console.error('Error fetching delivered orders:', error));
}

function renderOrders(orders) {
    const orderTableBody = document.getElementById('orderTableBody');
    orderTableBody.innerHTML = '';
    orders.forEach(order => {
        const row = document.createElement('tr');
        row.innerHTML = `<td>${order.order_id}</td><td>${order.first_name}&nbsp;${order.last_name}</td><td>${order.status}</td><td><button class="btn btn-secondary edit-btn" data-order_id="${order.order_id}">View Details</button></td>`;
        orderTableBody.appendChild(row);
    });
}
  function addViewDetailsEventListeners() {
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                const order_id = this.dataset.order_id;
                window.location.href = `delivered-order-details-admin.php?order_id=${order_id}`;
            });
        });
    }

function handleSearch() {
    const orderId = document.getElementById('searchOrderIdInput').value.trim().toLowerCase();
    const status = document.getElementById('searchStatusInput').value.trim().toLowerCase();

    fetch('search-for-orders.php')
        .then(response => response.json())
        .then(data => {
            const filteredOrders = data.filter(order => {
                const orderIdMatch = order.order_id.toString().toLowerCase().includes(orderId);
                const statusMatch = order.status.toLowerCase().includes(status);
                return orderIdMatch && statusMatch;
            });
            renderOrders(filteredOrders);
            addViewDetailsEventListeners();
            })
        .catch(error => console.error('Error fetching orders:', error));
}

document.getElementById('searchOrderIdInput').addEventListener('input', handleSearch);
document.getElementById('searchButton').addEventListener('click', handleSearch);

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

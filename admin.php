Disclaimer for School Purposes<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <link  href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <!-- Bootstrap Font Icon CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <style type="text/css">
        
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
                        
                        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                            <li class="nav-item">
                                <a href="#" class="nav-link align-middle px-0">
                                    <i class="fs-4 bi-house" name="logo"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                                </a>
                            </li>
                            <li>
                                <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                    <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="#submenu4" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                    <i class="fs-4 bi bi-box-seam"></i> <span class="ms-1 d-none d-sm-inline">Orders</span>
                                </a>
                                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                                    <li class="w-100">
                                        <a href="#" class="nav-link px-0"> <i class="bi bi-check-square-fill"></i> <span class="d-none d-sm-inline">Delivered</span> </a>
                                    </li>
                                    <li>
                                        <a href="#" class="nav-link px-0 active"> <i class="bi bi-clock-history"></i> <span class="d-none d-sm-inline">Pending</span> </a>
                                    </li>
                                    <li>
                                        <a href="#" class="nav-link px-0"><i class="bi bi-arrow-return-left"></i> <span class="d-none d-sm-inline">Returns</span> </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                    <i class="fs-4 bi bi-receipt"></i> <span class="ms-1 d-none d-sm-inline">Invoice Report</span>
                                </a>
                                <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                                    <li class="w-100">
                                        <a href="#" class="nav-link px-0"> <i class="bi bi-receipt-cutoff"></i> <span class="d-none d-sm-inline">Individual Receipts</span> </a>
                                    </li>
                                    <li>
                                        <a href="#" class="nav-link px-0"><i class="bi bi-file-earmark-bar-graph"></i> <span class="d-none d-sm-inline">Overall Reports</span> </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                    <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">Products</span>
                                </a>
                                <ul class="collapse nav flex-column ms-1 " id="submenu3" data-bs-parent="#menu">
                                    <li class="w-100">
                                        <a href="admin-add-product.php" class="nav-link
                                            px-0"> <i class="bi bi-plus"></i> <span class="d-none d-sm-inline">Add Product</span> </a>
                                    </li>
                                    <li class="w-100">
                                        <a href="#" class="nav-link px-0"> <i class="bi bi-x"></i> <span class="d-none d-sm-inline">No Stocks</span> </a>
                                    </li>
                                    <li>
                                        <a href="#" class="nav-link px-0"> <i class="bi bi-arrow-up-circle"></i> <span class="d-none d-sm-inline">High Stocks</span> </a>
                                    </li>
                                    <li>
                                        <a href="#" class="nav-link px-0"> <i class="bi bi-clock"></i> <span class="d-none d-sm-inline">On Demands</span> </a>
                                    </li>
                                    <li>
                                        <a href="#" class="nav-link px-0    "> <i class="bi bi-list"></i> <span class="d-none d-sm-inline">All Stocks</span> </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="nav-link px-0 align-middle">
                                    <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Customers</span>
                                </a>
                            </li>
                        </ul>
                        <hr>
                        <div class="log-button">                        
                            <button class="log-out"><a href="log_out.php" style="text-decoration:none; color: white;">Log Out</a></button>
                        </div>
                    </div>
                </div>
            <div class="col py-3">
                <h3>Left Sidebar with Submenus</h3>
                <p class="lead">
                    An example 2-level sidebar with collasible menu items. The menu functions like an "accordion" where only a single 
                    menu is be open at a time. While the sidebar itself is not toggle-able, it does responsively shrink in width on smaller screens.</p>
                <ul class="list-unstyled">
                    <li><h5>Responsive</h5> shrinks in width, hides text labels and collapses to icons only on mobile</li>
                </ul>
            </div>
        </div>
    </div>
    <footer style="text-align: center; background: lightgray; padding: 10px; ">
        <p style="margin-bottom: 0px;">Disclaimer for School Purposes</p>
    </footer>

    <script>
        // Prevent submenu collapse on click
        document.querySelectorAll('.collapse .nav-link').forEach(item => {
            item.addEventListener('click', function (event) {
                event.stopPropagation();
            });
        });
    </script>
</body>
</html>

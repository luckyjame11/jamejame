<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="admin.css">
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
     .serial-number-notification {
            color: red;
            display: none;
            margin-top: 5px;
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel">
                                 <form action="insert-product-handler.php" method="POST" enctype="multipart/form-data">
                                <h2>Insert Image</h2>
                               
                                    <div class="images-insert">
                                        <div class="form-group">
                                            <label for="mainImage">Main Image</label>
                                            <input type="file" class="form-control-file" id="mainImage" name="mainImage" accept="image/*" required>
                                            <img class="preview-image" id="mainImagePreview" src="#" alt="Main Image Preview" style="display: none;">
                                        </div>
                                        <div class="form-group">
                                            <label for="subImages">Sub Images</label>
                                            <input type="file" class="form-control-file" id="subImages" name="subImages[]" accept="image/*" multiple required>
                                        </div>
                                        <div class="form-group">
                                            <label for="subImage2">Sub Image 2</label>
                                            <input type="file" class="form-control-file" id="subImage2" name="subImages[]" accept="image/*">
                                        </div>
                                        <div class="form-group">
                                            <label for="subImage3">Sub Image 3</label>
                                            <input type="file" class="form-control-file" id="subImage3" name="subImages[]" accept="image/*">
                                        </div>
                                        <div class="form-group">
                                            <label for="subImage4">Sub Image 4</label>
                                            <input type="file" class="form-control-file" id="subImage4" name="subImages[]" accept="image/*">
                                        </div>
                                        <div class="form-group">
                                            <label for="subImage5">Sub Image 5</label>
                                            <input type="file" class="form-control-file" id="subImage5" name="subImages[]" accept="image/*">
                                        </div>
                                        <div class="sub-images-preview">
                                            <label class="sub-images-label">Sub Images Preview</label>
                                            <div id="subImagesPreview" class="sub-images-container"></div>
                                        </div>
                                    </div>
                              
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel">
                                <h2>Product Details</h2>
                                <div class="details-insert">
                                    <div class="form-group">
                                        <label for="productNumber">Serial Number</label>
                                        <input type="text" class="form-control" id="productNumber" name="productNumber" required onblur="checkSerialAvailability()">
                                         <p id="serial-feedback" style="margin-top: 0px;margin-bottom: 0px;" ></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="productName">Product Name</label>
                                        <input type="text" class="form-control" id="productName" name="productName" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="brand">Product Details</label>
                                        <input type="text" class="form-control" id="brand" name="product-details" required>
                                    </div>
                                  <div class="form-group">
                                        <label for="brand">Brand</label>
                                        <select class="form-control" id="brand" name="brand" required>
                                            <option value="" disabled selected>Select a brand</option>
                                            <option value="Nike">Nike</option>
                                            <option value="Adidas">Adidas</option>
                                            <option value="Puma">Puma</option>
                                            <option value="Anta">Anta</option>
                                            <option value="New Balance">New Balance</option>
                                            <option value="Under Armour">Under Armour</option>
                                             <option value="Jordan">Jordan</option>
                                        </select>
                                    </div>
                                   <div class="form-group">
                                        <label>Classification</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="classification" id="Lifestyle" value="Lifestyle" required>
                                            <label class="form-check-label" for="lifestyle">Lifestyle</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="classification" id="sports" value="Sports" required>
                                            <label class="form-check-label" for="sports">Sports</label>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="text" class="form-control" id="price" name="price" required>
                                    </div>
                                    <input type="submit" class="btn btn-primary btn-add" name="submit" value="Add Product">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div>
    </div>
    <footer style="text-align: center; background: lightgray; padding: 10px;">
        <p style="margin-bottom: 0px;">Copyright All Reserved - 2024</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
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
        document.getElementById('mainImage').addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('mainImagePreview').src = e.target.result;
                    document.getElementById('mainImagePreview').style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });
        const subImageInputs = document.querySelectorAll('input[name="subImages[]"]');
        subImageInputs.forEach(input => {
            input.addEventListener('change', function() {
                const files = this.files;
                if (files) {
                    const previewContainer = document.getElementById('subImagesPreview');
                    [...files].forEach(file => {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const img = document.createElement('img');
                            img.classList.add('preview-image');
                            img.src = e.target.result;
                            previewContainer.appendChild(img);
                        }
                        reader.readAsDataURL(file);
                    });
                }
            });
        });
  function checkSerialAvailability() {
    var serial_id = document.getElementById('productNumber').value;
    if (serial_id.trim() !== '') {
        $.ajax({
            type: 'POST',
            url: 'check-serial-number.php',
            data: {serial_id: serial_id},
            success: function(response) {
                $('#serial-feedback').html(response);
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ', status, error);
            }
        });
    } else {
        $('#serial-feedback').html('');
    }
}


    </script>
</body>
</html>

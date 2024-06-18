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
                    <div class="main" align="center">
                        <h2>Over All Reports</h2>
                        <div align="center" class="card-container">
                            <form action="sales-date.php" method="POST">
                               <div class="date-select" align="center">
                                <h3>Reports by Date:</h3>
                                      <select class="day" name="day">
                                        <!-- Options for days will be generated dynamically -->
                                      </select>
                                      <select class="month" name="month">
                                        <!-- Options for months -->
                                        <option value="January">January</option>
                                        <option value="February">February</option>
                                        <option value="March">March</option>
                                        <option value="April">April</option>
                                        <option value="May">May</option>
                                        <option value="June">June</option>
                                        <option value="July">July</option>
                                        <option value="August">August</option>
                                        <option value="September">September</option>
                                        <option value="October">October</option>
                                        <option value="November">November</option>
                                        <option value="December">December</option>
                                      </select>
                                      <select class="year" name="year">
                                        <!-- Options for years -->
                                        <!-- Starting from 2015 -->
                                        <option value="2015">2015</option>
                                        <option value="2016">2016</option>
                                        <option value="2017">2017</option>
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <!-- Add more options for years -->
                                      </select>
                                      <br>
                                      <input type="submit" name="submit" value="Print">
                                    </div>
                            </form>
                        </div>
                        <div align="center"class="card-container">
                            <form action="sales-month.php" method="POST">
                               <div class="date-select" align="center" >
                                <h3>Reports by Month:</h3>
                                      <select class="month" name="month">
                                        <!-- Options for months -->
                                        <option value="January">January</option>
                                        <option value="February">February</option>
                                        <option value="March">March</option>
                                        <option value="April">April</option>
                                        <option value="May">May</option>
                                        <option value="June">June</option>
                                        <option value="July">July</option>
                                        <option value="August">August</option>
                                        <option value="September">September</option>
                                        <option value="October">October</option>
                                        <option value="November">November</option>
                                        <option value="December">December</option>
                                      </select>
                                      <select class="year" name="year">
                                        <!-- Options for years -->
                                        <!-- Starting from 2015 -->
                                        <option value="2015">2015</option>
                                        <option value="2016">2016</option>
                                        <option value="2017">2017</option>
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <!-- Add more options for years -->
                                      </select>
                                      <br>
                                      <input type="submit" name="submit" value="Print">
                                    </div>
                            </form>
                        </div>
                        <div align="center" class="card-container">
                            <form action="sales-yearly.php" method="POST">
                               <div class="date-select" align="center" >
                                <h3>Reports by Year:</h3>
                                        <select name="year">
                                        <!-- Options for years -->
                                        <!-- Starting from 2015 -->
                                        <option value="2015">2015</option>
                                        <option value="2016">2016</option>
                                        <option value="2017">2017</option>
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <!-- Add more options for years -->
                                      </select>
                                      <br>
                                      <input type="submit" name="submit" value="Print">
                                    </div>
                            </form>
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
        document.addEventListener('DOMContentLoaded', function() {
  const daySelect = document.querySelector('.day');
  const monthSelect = document.querySelector('.month');
  const yearSelect = document.querySelector('.year');

  // Function to populate days based on the selected month
  function populateDays() {
    const selectedMonth = monthSelect.value;
    const daysInMonth = new Date(yearSelect.value, monthSelect.selectedIndex + 1, 0).getDate();
    daySelect.innerHTML = '';
    for (let i = 1; i <= daysInMonth; i++) {
      const option = document.createElement('option');
      option.value = i;
      option.textContent = i;
      daySelect.appendChild(option);
    }
  }

  // Initial population of days based on the current month
  populateDays();

  // Event listener for changes in the selected month
  monthSelect.addEventListener('change', populateDays);
});

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
